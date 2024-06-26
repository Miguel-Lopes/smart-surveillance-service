import time
import requests
import RPi.GPIO as GPIO
import post2api as post2API

# Set the GPIO pins for the external LEDs 
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
        response = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=SensorTemperatura', timeout=5)
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        
        if response.status_code == 200:
            temp = int(response.text)
            print(f"Temperatura atual: {temp}ºC")
            
            if temp >= 25:
                print("Temperatura demasiado elevada")
                GPIO.output(channel_red, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 1)

            elif temp <= 5:
                print("Risco de temperatura ficar demasiado baixa")
                GPIO.output(channel_blue, 1)
                GPIO.output(channel_green, 0)
                GPIO.output(channel_red, 0)
                post2API("Buzzer", 0)
                
            elif temp <= 10:
                print("Temperatura demasiado baixa")
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                GPIO.output(channel_red, 1)
                post2API("Buzzer", 1)

            elif temp >= 20:
                print("Risco de temperatura ficar demasiado alta")
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 1)
                GPIO.output(channel_red, 0)
                post2API("Buzzer", 0)

            elif temp > 45 and temp < 55:
                print("Temperatura aceitável")
                GPIO.output(channel_red, 0)
                GPIO.output(channel_green, 1)
                GPIO.output(channel_blue, 0)
                post2API("Buzzer", 0)

            else:
                print("Vou desligar o LED")
                GPIO.output(channel_green, 0)
                GPIO.output(channel_blue, 0)
                GPIO.output(channel_red, 0)
                post2API("Buzzer", 0)
        else:
            print(f"Erro ao realizar solicitacao: {response.status_code}")
        
        time.sleep(5)
        
    except KeyboardInterrupt:
        print('\n O programa foi interrompido pelo utilizador.')
        break
        
    except Exception as e:
        print('Erro inesperado:', e)
        print("Tenta outra vez")

# Clean up GPIO settings
GPIO.cleanup()