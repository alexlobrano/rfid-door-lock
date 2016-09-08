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
	echo "Problem with wifi. Rebooting now..."
	sudo /home/pi/rebootwifi
else
	echo "Wifi is okay."
fi
