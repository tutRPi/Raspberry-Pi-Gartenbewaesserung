#!/usr/bin/python3
# -*- coding: UTF-8 -*-

import time
from sys import exit
import pymysql
import datetime
from miflora.miflora_poller import MiFloraPoller
from btlewrap.bluepy import BluepyBackend
from rpi_rf import RFDevice



# Steckdosenparameter anpassen 
# In diesem Fall verwenden wir den GPIO Port 17

gp=17
an = 5510417
aus = 5510420
proto = 1
puls1 = 303
puls2 = 302


# Hier wird angegeben an welcher Tageszeit das Script laufen soll
# Beispiel: Start 06:00 Uhr | Ende 22:00 Uhr
# Zeitparameter in welchem Zeitram soll geprüft werden
startTime = 6
endTime = 22


# Steuer Zeiten

# Hier wird definiert wie lange die Pumpe laufen soll
#1800s = 30min
pumpendauer = 1800

# Hier wird definiert wie lange das Script warten soll bis es wieder von vorne losgeht
#5400s = 1.5 Stunden
wartennachpumpe = 7200

# Hier wird definiert wie lange das Script warten soll wenn die Bodenfeuchte noch genügend feucht ist
#7200s = 2 Stunden
warten = 7200

# Hier wird definiert wie lange die Nachtpause sein soll
#28800s = 8 Stunden
nachtwarten = 28800


# Das komplette Script läuft in einer Endlosschleife
while True:
    # Die akuelle Zeit (Stunde) auslesen
    hourNow = int(time.strftime('%H'))
    
    # Die Start- und Endzeit in eine Zahl umwandeln
    startZeit = int(startTime)
    endZeit = int(endTime)
    
    # A1        | Als erstes fragen wir ab, ob die aktuelle Zeit in unserem Zeitraum ist
    # A1-WAHR   | Die aktuelle Zeit liegt zwischen 06:00 Uhr und 22:00 Uhr = es ist Tag
    if (hourNow >= startZeit) and (hourNow < endZeit):
        # Datum und Zeit holen für die Datenbank
        Datum = time.strftime("%d.%m.%Y", time.localtime())
        Zeit = time.strftime("%H:%M", time.localtime())

        # Sensor1 verbinden
        sensor1 = MiFloraPoller("80:EA:CA:89:20:6A", BluepyBackend)
        time.sleep(2)

        # Daten von Sensor1 holen
        battery1 = sensor1.parameter_value('battery')
        temp1 = sensor1.parameter_value('temperature')
        light1 = sensor1.parameter_value('light')
        feucht1 = sensor1.parameter_value('moisture')
        leit1 = sensor1.parameter_value('conductivity')

        time.sleep(2)
        
        # -- Falls mehrere Sensoren verwendet werden möchten kann dieser Teil hier mehrfach wiederholt werden.
        # -- Dabei muss jeweils die Sensorbezeichnung herufgezählt werden und natürlich die MAC-Adresse angepasst werden.
        
        # Sensor2 verbinden
        # sensor2 = MiFloraPoller("neue MAC-Adresse", BluepyBackend)
        # time.sleep(2)

        # Daten von Sensor2 holen
        # -- Auch zum auslesen der Parameter muss die Zahl hochgezählt werden. 
        # battery2 = sensor1.parameter_value('battery')
        # temp2 = sensor1.parameter_value('temperature')
        # light2 = sensor1.parameter_value('light')
        # feucht2 = sensor1.parameter_value('moisture')
        # leit2 = sensor1.parameter_value('conductivity')

        # time.sleep(2)

        # Zum Testen kann man den auskommentierten unteren print aktiv setzten = # vor dem print("..") entfernen
        # print("Datum:", Datum, "Zeit:", Zeit,"Batterie1:",battery1, "Temp1:",temp1,"Licht1:",light1,"Feucht1:",feucht1,"Leit1:",leit1)

        # Verbindung zur DB herstellen.
        # Die Verbindung wird folgendermassen aufgebaut:
        #   Link:       z.B. Localhost  |   wenn die Datenbank auf dem Raspi läuft
        #   Benutzer:   z.B. pi         |   hier den vorhin erstellen Benutzer angeben
        #   Passwort:   z.B. raspberry  |   hier das vorhin erstellte Passwort angeben
        #   Datenbank:                  |   hier den DB Name angeben
        
        db = pymysql.connect("localhost","MySQL-Benutzername","MySQL-Passwort","MySQL-DB-Name")

        # Cursorfunktion in Variable schreiben
        cur = db.cursor()

        # Daten in DB schreiben für Sensor 1
        sql = "INSERT INTO bewaesserung (datum, zeit, battery, temp, light, feucht, leit) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (Datum, Zeit, battery1, temp1, light1, feucht1, leit1)
        cur.execute(sql, val)
        cur.close()
        db.commit()
        db.close
        
        # -- Falls mehrere Sensoren verwendet werden möchten kann dieser Teil hier mehrfach wiederholt werden.
        # -- Dabei muss jeweils die Sensorbezeichnung herufgezählt werden und wie vorhin die Parameter hochgezählt werden.
        
        # Daten in DB schreiben für Sensor 2
        # sql = "INSERT INTO bewaesserung (datum, zeit, battery, temp, light, feucht, leit) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        # val = (Datum, Zeit, battery2, temp2, light2, feucht2, leit2)
        # cur.execute(sql, val)
        # cur.close()
        # db.commit()
        # db.close

        # -- Falls mehrere Sensoren verwendet werden, müssen wir nun die Feuchtigkeit durch die Anzahl Sensoren teilen.
        # -- mit 2 Sensoren        |   feucht = (feucht1 + feucht2)/2
        # -- oder mit 3 Sensoren   |   feucht = (feucht1 + feucht2 + feucht3)/3
        feucht = feucht1


        # A2        | Jetzt wird abgefrage, ob die Bodenfeuchtigkeit zu trocken ist. 
        #             Bei dem Wert "35" muss man in jedem Beet/Garten selbst testen welchen Wert einem am besten ersscheint.
        
        # A2-WAHR   | Die Bodenfeuchtigkeit ist unter dem Wert "35"
        if (feucht < 35):
        
            # Steckdose anschalten
            rfdevice = RFDevice(gp)
            rfdevice.enable_tx()
            rfdevice.tx_code(an, proto, puls1)
            rfdevice.tx_code(an, proto, puls2)
            rfdevice.tx_code(an, proto, puls1)
            rfdevice.tx_code(an, proto, puls2)
            rfdevice.cleanup()
            
            # Hier wird die Pumpendauer in Minuten umgerechten. Wird nur für den unteren Print benötigt.
            pumpendauerinmin = pumpendauer/60
            # Zum Testen kann man den auskommentierten unteren Print aktiv setzten = # vor dem print("..") entfernen
            # print("Pumpe an - Dauer:", pumpendauerinmin,"min")
            
            # nun läuft die Pumpe mit der oben definierten Dauer
            time.sleep(pumpendauer)

            # Danach die Steckdose auschalten
            rfdevice = RFDevice(gp)
            rfdevice.enable_tx()
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.cleanup()
            
            # Zum Testen kann man den auskommentierten unteren print aktiv setzten = # vor dem print("..") entfernen
            # print("Pumpe ausschalten")
            
            # Jetzt wartet das Script mit der oben definierten Dauer
            time.sleep(wartennachpumpe)
        
        # A2-FALSCH | Die Bodenfeuchtigkeit ist über dem Wert "35"
        else:
            # Zur Sicherheit Steckdose nochmals auschalten
            rfdevice = RFDevice(gp)
            rfdevice.enable_tx()
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.tx_code(aus, proto, puls1)
            rfdevice.tx_code(aus, proto, puls2)
            rfdevice.cleanup()

            # Zum Testen kann man den auskommentierten unteren print aktiv setzten = # vor dem print("..") entfernen
            # print("es muss nicht bewässert werden")
            
            time.sleep(warten)
            
    # A1-FALSCH | Die aktuelle Zeit liegt nicht zwischen 06:00 Uhr und 22:00 Uhr = es ist Nacht
    else:
        time.sleep(nachtwarten)
        