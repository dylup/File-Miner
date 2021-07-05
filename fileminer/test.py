#!/usr/bin/python3

import os
import argparse
import re
from datetime import date
import socket
import requests

s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect(('8.8.8.8', 1))
ip = str(s.getsockname()[0])

print("ip: " + ip)



url = 'http://127.0.0.1/add-host.php'
params = {'ip': ip}

result = requests.post(url, data=params)

print(result.text)