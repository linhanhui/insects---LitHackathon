from bs4 import BeautifulSoup
import requests
import csv


csv_file = open('documentId.csv','w')
csv_writer = csv.writer(csv_file)
keywordArr = ['r1c1sc17','r1c1sc2','r1c1sc118','r1c1sc11','r1c1sc7','r1c1sc10','r1c1sc5','r1c1sc6','r1c1sc119','r1c1sc13','r1c1sc1','r1c1sc8','r1c1sc16','r1c1sc15','r1c1sc4','r1c1sc14','r1c1sc12','r1c1sc3','r1c1sc9']

csv_writer.writerow(["documentId","following","referring","snippets","keyword"])

resultDocumentIdArr = []
resultFollowingArr = []
resultReferringArr = []
resultSnippets = []
resultKeywordArr = []


for keyword in keywordArr:
    searchterms = ['a','b']

    for searchterm in searchterms:
        headers = {'user-agent': 'my-app/0.0.1','cache-control':'no-cache','x-api-key':'q3yxNeOfWrazociOXwfvX59YomC5yfY87JicaiGL'}

        payload = {'apikey':'q3yxNeOfWrazociOXwfvX59YomC5yfY87JicaiGL','cats':'r1','l2cats':'r1c1','l3cats':keyword,'searchTerm':searchterm,'page':'1','maxperpage':'100000'}

        url = 'https://test-legalresearch.api.sal.sg/v1-search/search'

        r = requests.post(url, headers=headers,params=payload)

        #convert into html
        soup = BeautifulSoup(r.text,'lxml')

        #get the documentid element in to an array
        documentIdArray = soup.find_all('documentid')

        followingArray = soup.find_all('following')

        referringArray = soup.find_all('referring')

        snippetsArray = soup.find_all('snippets')

        #writing the documentId into csv file

        for i in range(len(documentIdArray)):
            if(documentIdArray[i] not in resultDocumentIdArr):
                resultDocumentIdArr.append(documentIdArray[i])
                resultFollowingArr.append(followingArray[i])
                resultReferringArr.append(referringArray[i])
                resultSnippets.append(snippetsArray[i])    
                resultKeywordArr.append(keyword)   
                    

for i in range(len(resultDocumentIdArr)):
        tempDocumentId = resultDocumentIdArr[i].text
        tempFollowing = resultFollowingArr[i].text
        tempReferring = resultReferringArr[i].text
        
        tempSnippets = resultSnippets[i].text
        tempSnippets.replace("<snippet>", "")
        tempSnippets.replace("</snippet>", "")
        tempSnippets.replace("<b>", "")
        tempSnippets.replace("</b>", "")
        csv_writer.writerow([tempDocumentId,tempFollowing,tempReferring,tempSnippets,resultKeywordArr[i]])
print(resultDocumentIdArr)

csv_file.close()


