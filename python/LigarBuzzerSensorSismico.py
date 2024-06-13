import time 
import requests
import RPi.GPIO as GPIO 
import datetime
from post2api import post2API

channel = 5 #?????????????????????????
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

while True:
    try:
        Sismo = requests.get('http://iot.dei.estg.ipleiria.pt/EI-TI-g130/smart-surveillance-service/api/api.php?nome=SensorSismicoNorte')
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        if Sismo.status_code == 200:
            SismoValor = Sismo.text.strip()
            if int(SismoValor) == 1:
                print("Movimento detetado")
                post2API("Buzzer", 1)
                GPIO.output(channel, 1)
            else:
                print("Movimento não detetado")
                post2API("Buzzer", 0)
                GPIO.output(channel, 0)
        else:
            print(f"Erro ao realizar solicitacao: {Sismo.status_code}")
        time.sleep(5)
    except ValueError:
        print("ERRO !")
    except KeyboardInterrupt:
        # Capture exception for CTRL + C
        print('\nO programa foi interrompido pelo utilizador.')
        GPIO.cleanup()  # Clean up GPIO settings
        break  # Exit the while loop
    except Exception as e:
        # Capture all other errors
        print('Erro inesperado:', e)
        print("Tenta outra vez")
        time.sleep(5)
