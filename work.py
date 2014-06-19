import urllib2
import json 
import sys
import time 
print("enter language")

sys.stdout.flush()
language = raw_input()
print(language,"enter function name\n")
sys.stdout.flush()
func_name = raw_input()
print (func_name,"enter function parameters\n")
sys.stdout.flush()
func_param = raw_input() 
print(func_param,"enter function return type\n")
sys.stdout.flush()
func_ret = raw_input()
#file_out = open("/home/quicksilver/brahma/out.txt",'w').write(language+func_name+func_param+func_ret)

#print ("python received language\n",language)
#time.sleep(5)

url = "http://api.interviewstreet.org/brahma/template.json?"
url = url + "language="+str(language)+"&"
url = url + "returntype="+str(func_ret)+"&"
url = url + "functionname="+str(func_name)
print url


sys.stdout.flush()
response = urllib2.urlopen(url)
html = response.read()

data = json.loads(html)

head = data["data"][language]["head"]
body = data["data"][language]["body"]
tail = data["data"][language]["tail"]
print head+body+tail
sys.stdout.flush()
