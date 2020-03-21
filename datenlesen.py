
import time
from sys import exit
import pymysql
import datetime
from miflora.miflora_poller import MiFloraPoller
from btlewrap.bluepy import BluepyBackend


# Daten manuell auslesen und hochladen

# Allgemein (Datum und Zeit)
Datum = time.strftime("%d.%m.%Y", time.localtime())
Zeit = time.strftime("%H:%M", time.localtime())

# Sensor1 verbinden
sensor1 = MiFloraPoller("80:EA:CA:89:20:6A", BluepyBackend)

# Daten von Sensor1 holen
battery1 = sensor1.parameter_value('battery')
temp1 = sensor1.parameter_value('temperature')
light1 = sensor1.parameter_value('light')
feucht1 = sensor1.parameter_value('moisture')
leit1 = sensor1.parameter_value('conductivity')

# Sensor1 verbinden
sensor1 = MiFloraPoller("80:EA:CA:89:20:6A", BluepyBackend)

# -- Falls mehrere Sensoren verwendet werden möchten kann dieser Teil hier mehrfach wiederholt werden.
# -- Dabei muss jeweils die Sensorbezeichnung herufgezählt werden und natürlich die MAC-Adresse angepasst werden.

# Daten von Sensor2 holen
# battery2 = sensor1.parameter_value('battery')
# temp2 = sensor1.parameter_value('temperature')
# light2 = sensor1.parameter_value('light')
# feucht2 = sensor1.parameter_value('moisture')
# leit2 = sensor1.parameter_value('conductivity')

print("")
print("--------------------------------")
print("")
print("Datum:", Datum, "Zeit:", Zeit)
print("")
print("----------- Sensor 1 -----------")
print("")
print("Batterie1:",battery1)
print("Temp1:",temp1)
print("Licht1:",light1)
print("Feucht1:",feucht1)
print("Leit1:",leit1)
print("")
print("--------------------------------")
# print("")
# print("----------- Sensor 2 -----------")
# print("")
# print("Batterie2:",battery2)
# print("Temp2:",temp2)
# print("Licht2:",light2)
# print("Feucht2:",feucht2)
# print("Leit2:",leit2)
# print("")
# print("--------------------------------")
# print("")
