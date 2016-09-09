#!/usr/bin/env python

import MySQLdb, argparse, string, time, datetime

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
				print "Resident access\nDoor unlocked\n"
				query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked) VALUES (%s, %s, %s, %s, %s)"
				args = (time.strftime("%Y-%m-%d"), datetime.datetime.now().time(), key, attempt_name, 1)
				curs.execute(query, args)
			elif(permission != 'resident'):
				day = datetime.datetime.today().weekday()
				query = "SELECT " + valid_days[day][0] + ", " + valid_days[day][1] + "  FROM users WHERE id=%s limit 1"
				args = (key)
				curs.execute(query, args)
				time_s, time_e = curs.fetchone()
				#check if time_s or time_e are empty, throw error if so
				time_s = datetime.datetime.strptime(time_s, '%H:%M:%S').time()
				time_e = datetime.datetime.strptime(time_e, '%H:%M:%S').time()
				current_time = datetime.datetime.now().time()
				if(time_s < current_time < time_e):
					print "Brother and guest access allowed at this time\nDoor unlocked\n"
					query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked) VALUES (%s, %s, %s, %s, %s)"
					args = (time.strftime("%Y-%m-%d"), datetime.datetime.now().time(), key, attempt_name, 1)
					curs.execute(query, args)
				else:
					print "Non-resident access not allowed at this time\nDock locked\n"
					query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked) VALUES (%s, %s, %s, %s, %s)"
					args = (time.strftime("%Y-%m-%d"), datetime.datetime.now().time(), key, attempt_name, 0)
					curs.execute(query, args)

		else:
			print "Invalid ID\nDoor locked\n"
			query = "INSERT INTO attempt_log(tdate, ttime, id, name, door_unlocked) VALUES (%s, %s, %s, %s, %s)"			
			args = (time.strftime("%Y-%m-%d"), datetime.datetime.now().time(), key, 'Unknown', 0)
			curs.execute(query, args)

	db.close()
		
