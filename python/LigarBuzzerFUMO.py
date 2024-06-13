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
        Fumo = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=SensorFumo')
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        if Fumo.status_code == 200:
            Fumo = Fumo.text.strip()
            if int(Fumo) == 1:
                print("Fumo detetado")
                post2API("Buzzer", 1)
                GPIO.output(channel, 1)
            else:
                print("Fumo não detetado")
                post2API("Buzzer", 0)
                GPIO.output(channel, 0)
        else:
            print(f"Erro ao realizar solicitacao: {Fumo.status_code}")
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
