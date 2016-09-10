#!/usr/bin/env python

import MySQLdb, argparse, string, time, datetime
import RPi.GPIO as GPIO
from RF24 import *
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(7,GPIO.OUT)
GPIO.setup(12,GPIO.OUT)
GPIO.output(7,False)
GPIO.output(12,True)

# Setup for GPIO 22 CE and CE0 CSN for RPi B+ with SPI Speed @ 8Mhz
radio = RF24(RPI_V2_GPIO_P1_15, RPI_V2_GPIO_P1_24, BCM2835_SPI_SPEED_8MHZ);
pipes = [0xEEFDFDFDECAB,0xEEFDFDF0DFCD]
max_payload_size = 4
inp_role = 'none'
send_payload = 'open'
millis = lambda: int(round(time.time() * 1000))

radio.begin()
radio.enableDynamicPayloads()
radio.setRetries(15,15)
radio.setPALevel(RF24_PA_HIGH)
radio.openWritingPipe(pipes[0])
radio.openReadingPipe(1,pipes[1])
radio.startListening()

#query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked)" \
#	"VALUES (%s, %s, %s, %s, %s)"
#args = (datetime.date.today(), datetime.datetime.now().time(), '00001111', 'Alex', 1)

#query = "UPDATE users SET id='046443d2' WHERE name='Alex'"
#args = () 

#db = MySQLdb.connect("localhost", "alex", "password", "door_db")
#curs = db.cursor()

#with db:
#	curs.execute(query, args)
		
valid_days = { 0 : ('monday_s', 'monday_e'),
		1 : ('tuesday_s', 'tuesday_e'),
		2 : ('wednesday_s', 'wednesday_e'),
		3 : ('thursday_s', 'thursday_e'),
		4 : ('friday_s', 'friday_e'),
		5 : ('saturday_s', 'saturday_e'),
		6 : ('sunday_s', 'sunday_e')
}			

def insertAttempt(id, name, door_status):
	query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked) VALUES (%s, %s, %s, %s, %s)"
	args = (time.strftime("%Y-%m-%d"), datetime.datetime.now().time(), id, name, door_status)
	curs.execute(query, args)

def sendOpen(id, name, usergroup):
	radio.stopListening()
        radio.write(send_payload)
        radio.startListening()

        # Wait here until we get a response, or timeout
        started_waiting_at = millis()
        timeout = False
        while (not radio.available()) and (not timeout):
		if (millis() - started_waiting_at) > 750:
			timeout = True

        if timeout:
		print 'Failed, response timed out\n'
		insertAttempt(id, name, 5)
        else:
		# Grab the response, compare, and send to debugging spew
		len = radio.getDynamicPayloadSize()
		receive_payload = radio.read(len)
		if(receive_payload != send_payload):	
			print "Error, bad ack from arduino\n"
			insertAttempt(id, name, 6)
		else:
			print "Unlock successful\n"
			if(usergroup != 'resident'):
				insertAttempt(id, name, 1)
			else:
				insertAttempt(id, name, 0)

while(True):
	key = raw_input("Husky Card ID: ")
	query = "SELECT (1) FROM users WHERE id=%s"
	args = (key)
	db = MySQLdb.connect("localhost", "alex", "password", "door_db")
	curs = db.cursor()
	with db:
		if curs.execute(query, args):
			query = "SELECT user_group FROM users WHERE id=%s limit 1"
			args = (key)
			curs.execute(query, args)
			permission = curs.fetchone()[0]
			query = "SELECT name FROM users WHERE id=%s limit 1"			
			args = (key)
			curs.execute(query, args)
			attempt_name = curs.fetchone()[0]
			if(permission == 'resident'): 
				print "Resident access\nDoor unlocked"
				GPIO.output(7,True)
				GPIO.output(12,False)
				sendOpen(key, attempt_name, 'resident')
			elif(permission != 'resident'):
				day = datetime.datetime.today().weekday()
				query = "SELECT " + valid_days[day][0] + ", " + valid_days[day][1] + "  FROM users WHERE id=%s limit 1"
				args = (key)
				curs.execute(query, args)
				time_s, time_e = curs.fetchone()
				if(not time_s or not time_e):
					print "Invalid time entries for this ID\nDoor locked"
					GPIO.output(7,False)
					GPIO.output(12,True)
					insertAttempt(key, attempt_name, 3)
				else:
					time_s = datetime.datetime.strptime(time_s, '%H:%M:%S').time()
					time_e = datetime.datetime.strptime(time_e, '%H:%M:%S').time()
					current_time = datetime.datetime.now().time()
					if(time_s < current_time < time_e):
						print "Non-resident access allowed at this time\nDoor unlocked"
						GPIO.output(7,True)
	                                	GPIO.output(12,False)
						sendOpen(key, attempt_name, 'guest')
					else:
						print "Non-resident access not allowed at this time\nDock locked"
						GPIO.output(7,False)
	                               		GPIO.output(12,True)
						insertAttempt(key, attempt_name, 2)

		else:
			print "Invalid ID\nDoor locked\n"
			GPIO.output(7,False)
			GPIO.output(12,True)
			insertAttempt(key, 'Unknown', 4)

	db.close()
		
