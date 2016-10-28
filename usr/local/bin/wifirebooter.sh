#!/bin/bash

export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/local/games:/usr/games"

# IP of test server
SERVER=8.8.8.8

# Send 2 pings
sudo ping -c2 ${SERVER} > /dev/null

# If return is not 0 (error)
if [ $? != 0 ]
then
	#restart usb
	echo "$(date) Disconnected from wifi. Attempting to reboot wifi USB adapter..."
	sudo /home/pi/rebootwifi
else
	exit 1
fi
