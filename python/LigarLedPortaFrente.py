import time
import requests
import RPi.GPIO as GPIO
from post2api import post2API

# Set the GPIO channel
channel = 5
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)


while True:
    try:
        Porta = requests.get('http://iot.dei.estg.ipleiria.pt/EI-TI-g130/smart-surveillance-service/api/api.php?nome=PortaPrincipal')
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        if Porta.status_code == 200:
            PortaValor = Porta.text.strip()
            if int(PortaValor) == 1:
                print("Porta aberta")
                post2API("LedPortaPrincipal", 1)
                GPIO.output(channel, 1)
            else:
                print("Porta fechada")
                post2API("LedPortaPrincipal", 0)
                GPIO.output(channel, 0)
        else:
            print(f"Erro ao realizar solicitacao: {Porta.status_code}")
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
