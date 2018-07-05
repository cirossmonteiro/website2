import sys
import urllib.request as url
from bs4 import BeautifulSoup as bs
import json

#Url = sys.argv[1]
Url = "http://www.catarinadocesesalgados.com.br/"
page = url.urlopen(Url).read().decode('utf-8')
soup = bs(page,"html5lib")

l = [x['src'] for x in soup.findAll('img')]

formats = [".png",".jpg",".jpeg"]

for form in formats:
    ind2 = 0
    while True:
        ind2 = page.find(form,ind2);
        if ind2 == -1:
            break
        ind1 = ind2-1
        while page[ind1] not in "\"'(),;":
            ind1 -= 1
        ind1 += 1
        temp = page[ind1:ind2+len(form)]
        if temp not in l:
            if "http" not in temp:
                temp = Url+temp
            l.append(temp)
        ind2 += 1

print(json.dumps(l))
