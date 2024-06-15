import time
import requests
import RPi.GPIO as GPIO
from post2api import post2API

# Set the GPIO pin for the external LED
channel_green = 5
channel_blue = 4
channel_red = 3


# GPIO setup
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel_green, GPIO.OUT)
GPIO.setup(channel_blue, GPIO.OUT)
GPIO.setup(channel_red, GPIO.OUT)

while True:
    try:
        # Fetch temperature data
        response = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=SensorHumidade', timeout=5)
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        
        if response.status_code == 200:
            humidade = int(response.text)
            print(f"Humidade atual: {humidade}%")

            if humidade >= 60:
                print("Humidade demasiado elevada")
                GPIO.output(channel_red, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)

            elif humidade <= 45:
                print("Risco de Humidade ficar demasiado baixa")
                GPIO.output(channel_red, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)
               
            elif humidade <= 40:
                print("Humidade demasiado baixa")
                GPIO.output(channel_red, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)

            elif humidade >= 55:
                print("Risco de Humidade ficar demasiado alta")
                GPIO.output(channel_red, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)

            elif humidade > 45 and humidade < 55:
                print("Humidade aceitável")
                GPIO.output(channel_red, 0)
                GPIO.output(channel_green, 1)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 0)
            
            else:
                print("Vou desligar o LED")
                GPIO.output(channel_red, 0)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)

        else:
            print(f"Erro ao realizar solicitacao: {response.status_code}")
        
        time.sleep(5)
        
    except KeyboardInterrupt:

        print('\n O programa foi interrompido pelo utilizador.') #Usar ctrl + C para interromper o programa
        break
        
    except Exception as e:
        print('Erro inesperado:', e)
        print("Tenta outra vez")

# Clean up GPIO settings
GPIO.cleanup()