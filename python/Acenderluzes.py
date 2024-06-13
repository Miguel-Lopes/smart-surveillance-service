import time 
import requests
import RPi.GPIO as GPIO 
from post2api.py import post2API

channel_led = 5 
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel_led, GPIO.OUT)

def acender_led(channel):
    GPIO.output(channel, GPIO.HIGH)

def apagar_led(channel):
    GPIO.output(channel, GPIO.LOW)

while True:
    try:
        luzes = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=LedTemperatura')
        current_time = time.strftime("%Y-%m-%d %H:%M:%S")
        if luzes.status_code == 200:
            luz = luzes.text
            print(f"Estado atual das luzes:  {luz}--> 1=Ligado,0=Desligado")
            if int(luz) == 1:
                #print("Vou ligar o LED do rpi")
                print("Vou ligar as luzes de temperatura")
                acender_led(channel_led)
                #post2API("Sensor1",1)
            else:
                print("Vou desligar as luzes de temperatura")
                apagar_led(channel_led)
                #post2API("Sensor1",0)
        else:
            print(f"Erro ao realizar solicitacao: {luzes.status_code}")
        time.sleep(5)
    except ValueError:
        print("Oops !")
    except KeyboardInterrupt:
    # captura excecao CTRL + C
        print('\n O programa foi interrompido.')
        break # sai do ciclo while
    except Exception as e:
    # captura todos os erros
        print('Erro inesperado:', e)
        print("Tenta outra vez")
