
from rpi_rf import RFDevice
import RPi.GPIO as GPIO

# Funksteckdose mit diesem Script anschalten

# Steckdosenparameter
gp=17
an = 5510417
proto = 1
puls1 = 303
puls2 = 302

# Steckdose anschalten
rfdevice = RFDevice(gp)
rfdevice.enable_tx()
rfdevice.tx_code(an, proto, puls1)
rfdevice.tx_code(an, proto, puls2)
rfdevice.tx_code(an, proto, puls1)
rfdevice.tx_code(an, proto, puls2)
rfdevice.cleanup()


