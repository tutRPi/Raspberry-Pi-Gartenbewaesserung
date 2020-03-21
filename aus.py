
from rpi_rf import RFDevice
import RPi.GPIO as GPIO

# Funksteckdose mit diesem Script ausschalten

# Steckdosenparameter
gp=17
aus = 5510420
proto = 1
puls1 = 303
puls2 = 302

# Steckdose auschalten
rfdevice = RFDevice(gp)
rfdevice.enable_tx()
rfdevice.tx_code(aus, proto, puls1)
rfdevice.tx_code(aus, proto, puls2)
rfdevice.tx_code(aus, proto, puls1)
rfdevice.tx_code(aus, proto, puls2)
rfdevice.cleanup()