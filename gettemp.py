 from datetime import datetime

device = 'foldername of the ds18b20'

file = open('/sys/bus/w1/devices/' + device + '/w1_slave')
content = file.read()
file.close()

pos = content.rfind('t=') + 2
temperature_string = content[pos:]
temperature = float(temperature_string) / 1000

now = datetime.now()
dt_string = now.strftime("%H:%M")

color = "#ffffff"

if temperature < 20:
    #violet
    color = "#8A2BE2"
elif temperature >= 20 and temperature < 22:
    #dark blue
    color = "#00008B"
elif temperature >= 22 and temperature < 24:
    #light blue
    color = "#ADD8E6"
elif temperature >= 24 and temperature < 26:
    #green
    color = "#00FF00"
elif temperature >= 26 and temperature < 28:
    #yellow
    color = "#FFFF00"
elif temperature >= 28 and temperature < 30:
    #orange
    color = "#FFA500"
elif temperature >= 30:
    #red
    color = "#FF0000"
elif temperature >= 40:
    color = "#000000"


datei = open('/home/user/temperature/data.json','w')
datei.write('{"temperature": "' + str(temperature) + '","time": "' + dt_string + '","color": "' + color + '"}')
datei.close()
