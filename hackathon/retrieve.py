from bs4 import BeautifulSoup
import csv 
import requests
import time 


url = 'https://test-legalresearch.api.sal.sg/v1-content/content'

jsonArr = []

counter = 0
with open('documentId.csv','r') as csvFile:
    reader = csv.reader(csvFile)
    for row in reader:
        if(row[0]!= 'documentId'):
            headers = {'user-agent': 'my-app/0.0.1','cache-control':'no-cache','x-api-key':'q3yxNeOfWrazociOXwfvX59YomC5yfY87JicaiGL'}
            payload = {'apikey':'q3yxNeOfWrazociOXwfvX59YomC5yfY87JicaiGL','cats':'r1','l2cats':'r1c1','l3cats':row[-1],'docUrl':row[0]}
            r = requests.post(url, headers=headers,params=payload)
            with open("case"+str(counter)+".txt",'w') as txtFile:
                txtFile.write(r.text)
            time.sleep(3)
        counter +=1






 