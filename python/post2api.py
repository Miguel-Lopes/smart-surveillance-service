import requests
import datetime


def post2API(nome, valor):
    agora = datetime.datetime.now()
    dados = {'nome': nome, 'valor': valor, 'hora': agora.strftime("%Y-%m-%d %H:%M:%S")}
    try:
        r = requests.post('http://iot.dei.estg.ipleiria.pt/ti/g130/smart-surveillance-service/api/api.php', data=dados)
        if r.status_code == 200:
            print(f"Data posted successfully: {dados}")
        else:
            print(f"Failed to post data: {r.status_code}")
    except Exception as e:
        print(f"Error posting data: {e}")