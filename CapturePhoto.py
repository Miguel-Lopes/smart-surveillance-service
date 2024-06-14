import cv2
import requests
import time
from datetime import datetime
import sys
from threading import Thread, Lock

camera_lock = Lock()

def sendImage():
    urlPOST = 'http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/upload.php'  # URL da API

    # Specify the file path
    file_path = 'api/images/imgProvisoria.jpg'  # Caminho da imagem provisória que será enviada para a API

    with open(file_path, 'rb') as file:
        # Preparação do POST
        # payload = {'key': 'value'}  # Caso seja necessário algo com o ficheiro .jpg podemos colocar na payload
        files = {'imagem': file} # Indicação do ficheiro que irá ser enviado no POST

        # Envio do ficheiro via POST
        response = requests.post(urlPOST, files=files)

    # Verifica se o código de resposta HTTP foi 200 (OK), caso sim então é mostrado no terminal a 
    # mensagem "Imagem enviada com sucesso!", se não é mostrada a mensagem "Erro ao enviar a imagem. Código de resposta: "
    if response.status_code == 200:
        print('Imagem enviada com sucesso!')
    else:
        print('Erro ao enviar a imagem. Código de resposta:', response.status_code)


def captureImage():
    urlGET = 'http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php?nome=Buzzer'  # URL da API para o pedido GET

    # Pedido GET
    response = requests.get(urlGET)

    # Verificação do Código de resposta HTTP
    if response.status_code == 200:
        status = response.text  # response ".text" guarda o response body em texto, ".json" guarda em formato json se a resposta for em json e o ".content" guarda o response body todo na variável
        
        data = datetime.now() # Guarda a data em uma variável
        dataFormatada = data.strftime('%d/%m/%Y %H:%M:%S') # Coloca a data guardada no formato DD/MM/YYYY H:M:S
        print("Data: ", dataFormatada)

        # Se a resposta da API para o estado do buzzer for "on" é feita a captura de imagem e chamada a função sendImage() para enviar a imagem para a API.
        if status == "1":
            print("A captura de imagens ativa! A tirar a fotografia...")
            # Liga a câmara (0 é a predefinida do PC)
            cap = cv2.VideoCapture(0)
            
            # Verifica se a câmara está aberta, caso contrário mostra uma mensagem de erro.
            if not cap.isOpened():
                print("Não foi possível aceder à webcam.")
                return
            
            # Faz a captura da imagem
            ret, frame = cap.read()
            
            # Verifica se a imagem foi capturada, se não mostra uma mensagem de erro
            if not ret:
                print("Não foi possível capturar a imagem.")
                return
            
            # Guarda a imagem na pasta de imagem com o nome "imgProvisoria.jpg"
            cv2.imwrite("api/images/imgProvisoria.jpg", frame)
            
            # Dá release (liberta) a câmara
            cap.release()
            
            print("Imagem capturada com sucesso.")
            sendImage()
        elif status == "off": # Caso a resposta da API seja "off" é mostrada uma mensagem a indicar que a captura de imagens está inativa
            print("A captura de imagens não está ativa")
        elif status == "stop": # Caso a resposta da API seja "stop" é mostrada uma mensagem no terminal a indiciar que o script será terminado a pedido da API. O "stop" é utilizado por um botão no dashboard que termina o script a captura de imagens 
            print("Valor na API: ", status, "\nO script será encerrado a pedido da API")
            countdown(5)
            sys.exit()
        else: # Caso a resposta da API não seja "on", "off" ou "stop" é mostrada no terminal a mensagem de erro "Erro: Estado desconhecido".
            print("Erro: Estado desconhecido")
    else: # Caso não seja possível fazer o pedido à API ou se o código de resposta HTTP não for 200 (OK) é mostrado no terminal uma mensagem de erro
        print('Não foi possível determinar se a captura de imagens está ativa ou inativa. Código de resposta HTTP:', response.status_code)
    print() 

def countdown(t):
    
    while t:
        mins, secs = divmod(t, 60)
        timer = '{:02d}:{:02d}'.format(mins, secs)
        print(timer, end="\r")
        time.sleep(1)
        t -= 1
    print()


def main():
    while True:
        try:
            print()
            # Correção: Passar a função como referência sem chamá-la imediatamente
            t1 = Thread(target=captureImage)  
            t1.start()  # Inicia a thread

            print("--------------------------------------------------------------------------------------------------------------")
            print("Tempo até a próxima tentativa:")
            countdown(10)
            time.sleep(5)  # Dá um delay de 5 segundos

        except KeyboardInterrupt: #Usar  ctrl + C para interromper manualmente o programa
            print('\nO programa foi interrompido pelo usuário.')
            break  # Sai do loop
