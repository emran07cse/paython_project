from random import *
import os
from datetime import datetime
current_time = datetime.now()

print("Start Time:", current_time)
u_pwd=input("Enter you password:")

pwd=['a','b','c','d','e','f','g','h','i','j','k','l','m','1','2','3','4','5','6']
pw=""

while(pw!=u_pwd):
    pw=''
    for letter in range(len(u_pwd)):
        guess_pwd=pwd[randint(0,17)]
        pw=str(guess_pwd)+str(pw)
        print(pw)
        print("Cracking Password.....Please wait..")
        os.system("cls")

print("Your Password Is:",pw)
print("End Time:", current_time)




