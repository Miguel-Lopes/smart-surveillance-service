import time
import requests
import RPi.GPIO as GPIO

# Set the GPIO pin for the external LED
channel = 5

# GPIO setup
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

while True:
    try:
        # Fetch temperature data
        response = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=SensorTemperatura', timeout=5)
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        
        if response.status_code == 200:
            temp = int(response.text)
            print(f"Temperatura atual: {temp}")
            
            if temp >= 25:
                print("Temperatura demasiado elevada")
                GPIO.output(channel, 1)
                
            elif temp <= 5:
                print("Risco de temperatura ficar demasiado baixa")
                GPIO.output(channel, 1)
                
            elif temp <= 10:
                print("Temperatura demasiado baixa")
                GPIO.output(channel, 1)
                
            elif temp >= 20:
                print("Risco de temperatura ficar demasiado alta")
                GPIO.output(channel, 1)
                
            else:
                print("Vou desligar o LED")
                GPIO.output(channel, 0)
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