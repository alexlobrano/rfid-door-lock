#!/bin/bash

export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/local/games:/usr/games"
export DISPLAY=:0.0
export XAUTHORITY=~/.Xauthority

if ps aux | awk '/huskycard/' | pgrep python > /dev/null
then
	echo "Program already running. Exiting..."
	exit 1
fi
echo "Program not running. Launching..."
sudo /usr/bin/gnome-terminal -e "/home/pi/huskycard.py"
