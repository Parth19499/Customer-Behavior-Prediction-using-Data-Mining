import sys
import pyfpgrowth
import pandas as pd
transactions = pd.read_csv('store_data.csv',header = None,keep_default_na = False)
# transactions.head()



#creates dictionary
df = transactions
df.head()
st={""}
for i,j in df.iterrows():
    ls=list(j)
    for k in ls:
        st.add(k)
dict1={}
dict2={}
cnt=0
for i in st:
    dict1[i]=cnt
    dict2[cnt]=i
    cnt=cnt+1




#creates dataframe of numbers
import numpy as np
h=[0]*501
cnt=0
sz=df.shape[0]
ls1=[]
for i,j in df.iterrows():
    ls=list(j)
    ls2=[]
    for k in ls:
      x=dict1[k]
      if x==0:
        break
      h[x]+=1;
      ls2.append(x)
    ls1.append([ls2])
    cnt=cnt+1
df1=pd.DataFrame(ls1,columns=['Item ID'])
# df1.head()



#finding patterns and rules using pyfpgrowth
# Params : 10, 0.7
patterns = pyfpgrowth.find_frequent_patterns(df1['Item ID'],10)
rules = pyfpgrowth.generate_association_rules(patterns,0.7)
# print(patterns)
# print(rules)
# print("Number of  patterns is : %d" % len(patterns))
# print("Number of  rules is : %d" % len(rules))




# Establish a connection with Database
# Fetch the purchase history of the user
# Store the items in a list

rules2={}
for i in rules:
  s=""
  for j in i:
    s=s+str(j)+","
  rules2[s] = rules[i]


  
lstring=sys.argv[1]
lstring.replace('"','')
l = lstring.split(',')

# l=["meatballs","avocado","milk","pancakes","bacon"]
# l=["salad","mineral water","salmon","antioxydant juice","frozen smoothie","spinach"]
# l=["honey","avocado","yams","cottage cheese","turkey"]
# l=["ground beef","mineral water","cereals"]
x=2**len(l)
it=[0]*501
rec=[]
conf={}
for i in range(1,x):
  num=i
  bin=[]
  l2=[]
  while num!=0:
    bin.append(num%2)
    num=num//2
    
  y=len(bin)
  for i in range(1,len(l)-y+1):
    bin.append(0)
    
  bin.reverse()
  
  cnt=0
  for j in bin:
    if j==1:
        l2.append(dict1[l[cnt]])
    cnt=cnt+1
  
  l2.sort()
  s=""
  for j in l2:
    s=s+str(j)+","
  
  
#   print(s)
#   if s in rules2:
#     print(rules2[s])
  
  
  if s in rules2:
    first=True
#     print(s)
#     print(rules2[s][1])
#     print(type(rules2[s][0]))
    for j in rules2[s]:
      if first:
        if it[j[0]]==1:
          continue
        else:
          it[j[0]]=1
        first=False
        rec.append(dict2[j[0]])
#         print(j[0])
        conf[j[0]]=rules2[s][1]
#         print(dict2[j[0]])








# print(len(rec))
m1=-1;m2=-1;m3=-1;m4=-1
mi1=0;mi2=0;mi3=0;mi4=0
for i in range(1,121):
  if len(rec)==1:
    if rec[0]==dict2[i]:
      continue
  if len(rec)==2:
    if rec[0]==dict2[i] or rec[1]==dict2[i]:
      continue
  if len(rec)==3:
    if rec[0]==dict2[i] or rec[1]==dict2[i] or rec[2]==dict2[i]:
      continue
    
    
  if h[i]>m1:
    m4=m3;mi4=mi3
    m3=m2;mi3=mi2
    m2=m1;mi2=mi1
    m1=h[i];mi1=i
  elif h[i]>m2:
    m4=m3;mi4=mi3
    m3=m2;mi3=mi2
    m2=h[i];mi2=i
  elif h[i]>m3:
    m4=m3;mi4=mi3
    m3=h[i];mi3=i
  elif h[i]>m4:
    m4=h[i];mi4=i
    
    
if len(rec)==0:
  rec.append(dict2[mi1])
  rec.append(dict2[mi2])
  rec.append(dict2[mi3])
  rec.append(dict2[mi4])
elif len(rec)==1:
  rec.append(dict2[mi1])
  rec.append(dict2[mi2])
  rec.append(dict2[mi3])
elif len(rec)==2:
  rec.append(dict2[mi1])
  rec.append(dict2[mi2])
elif len(rec)==3:
  rec.append(dict2[mi1])
elif len(rec)>4:
  m1=-1;m2=-1;m3=-1;m4=-1
  mi1=0;mi2=0;mi3=0;mi4=0
  for i in conf:
    if conf[i]>m1:
      m4=m3;mi4=mi3
      m3=m2;mi3=mi2
      m2=m1;mi2=mi1
      m1=conf[i],mi1=i
    elif conf[i]>m2:
      m4=m3;mi4=mi3
      m3=m2;mi3=mi2
      m2=conf[i];mi2=i
    elif conf[i]>m3:
      m4=m3;mi4=mi3
      m3=conf[i];mi3=i
    elif conf[i]>m4:
      m4=conf[i];mi4=i
  rec.clear()
  rec.append(mi1)
  rec.append(mi2)
  rec.append(mi3)
  rec.append(mi4)


  
print("<b>Recommendations are : </b><br><br>")
print("<ol>")
for i in rec:
  print('<li>' + i + '</li>')
print("</ol>")
  
  
  
