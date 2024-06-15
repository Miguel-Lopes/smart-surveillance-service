import time 
import requests
import RPi.GPIO as GPIO 


channel_buzzer = 3
GPIO.setmode(GPIO.BCM)
GPIO.setup(channel_buzzer, GPIO.OUT)

def ativar_buzzer(channel):
    GPIO.output(channel, GPIO.HIGH)

def desativar_buzzer(channel):
    GPIO.output(channel, GPIO.LOW)

while True:
    try:
        buzzer = requests.get('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=Buzzer')
        if buzzer.status_code == 200:
            som = buzzer.text
            print(f"Estado atual do atuador:  {som}--> 1=Ligado,0=Desligado")
            if int(som) == 1:
                print("Vou ligar a campainha")
                ativar_buzzer(channel_buzzer)
                
            else:
                print("Vou desligar a campainha")
                desativar_buzzer(channel_buzzer)
                
        else:
            print(f"Erro ao realizar solicitacao: {buzzer.status_code}")
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
