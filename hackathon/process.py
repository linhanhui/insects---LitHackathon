import json
from bs4 import BeautifulSoup
import csv

def find_all_heading(fulltext):
    returnArray = []
    begin = 0
    while(fulltext.find("<Heading",begin)!=-1):
        returnArray.append(fulltext.find("<Heading",begin))
        begin = fulltext.find("<Heading",begin)+1
    return returnArray

jsonDict = {}
for i in range(1,1693):
    with open('case'+str(i)+'.txt','r') as tempFile:	
        newFile = BeautifulSoup(tempFile,'lxml')
        try:
            title = newFile.find('casetitle').text
        except:
            title = ""

        try:
            caseNumber = newFile.find('casenumber').text
        except:
            caseNumber = ""

        try:
            decisionDate = newFile.find('decisiondate').text[:10]
        except:
            decisionDate = ""

        try:
            tribunalCourt = newFile.find('indexcourt').text
        except:
            tribunalCourt = ""
        
        try:
            coram = newFile.find('coram').text
        except:
            coram = ""

        try:
            counselNames = newFile.find('counsel').text
        except:
            counselNames = ""
        try:
            parties = newFile.find('parties').text
        except:
            parties = ""
        
        jsonDict["title"] = title
        jsonDict["caseNumber"] = caseNumber
        jsonDict["decisionDate"] = decisionDate
        jsonDict["tribunalCourt"] = tribunalCourt
        jsonDict["coram"] = coram
        jsonDict["counselNames"] = counselNames
        jsonDict["parties"] = parties
        
        tempFile.close()

    with open('case2000.txt','r') as tempFile:	
        stringFile = tempFile.read()

        indexOfHeading = find_all_heading(stringFile)

        stringArr = []
        if(len(indexOfHeading) >0):
            for j in range(len(indexOfHeading)-1):
                stringArr.append(stringFile[indexOfHeading[j]:indexOfHeading[j+1]])
            stringArr.append(stringFile[indexOfHeading[-1]:])
            counter = 1

            for string in stringArr:
                tempString = BeautifulSoup(string,'lxml')

                tempHeading = tempString.find('heading')
                try:
                    paraStringArr = ""
                    paraArr = tempString.find_all('para')
                    for para in paraArr:
                        paraStringArr += para.text + " "
                except:
                    paraStringArr = ""
                tempDict = {'title':tempHeading.text,'content':paraStringArr}
                jsonDict["content"+str(counter)] = tempDict
                counter+=1
        else:
            tempString = BeautifulSoup(stringFile,'lxml')
            try:
                paraStringArr = ""
                paraArr = tempString.find_all('para')
                for para in paraArr:
                    paraStringArr += para.text + " "
            except:
                paraStringArr = ""
            tempDict = {'title':"",'content':paraStringArr}  
            jsonDict["content1"] = tempDict

                
        tempFile.close()

    with open('documentId.csv','r') as csvFile:
        reader = csv.reader(csvFile)
        rows=[r for r in reader]
        jsonDict['following'] = rows[i][1]
        jsonDict['referring'] = rows[i][2]
        jsonDict['snippets'] = rows[i][3]
        csvFile.close()

    with open('json'+str(i)+'.txt', 'w') as fp:
        json.dump(jsonDict, fp)        
        fp.close()
    
    



        



