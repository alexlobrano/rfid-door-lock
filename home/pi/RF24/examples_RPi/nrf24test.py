#!/usr/bin/env python 

import time
from RF24 import *

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
radio.printDetails()
radio.startListening()

while (inp_role !='send'):
	inp_role = raw_input('Type send to transmit packet (CTRL+C to exit) ')

        # First, stop listening so we can talk.
        radio.stopListening()

        # Take the time, and send it.  This will block until complete
        print 'Now sending payload', send_payload, '... ',
        radio.write(send_payload)

        # Now, continue listening
        radio.startListening()

        # Wait here until we get a response, or timeout
        started_waiting_at = millis()
        timeout = False
        while (not radio.available()) and (not timeout):
            if (millis() - started_waiting_at) > 750:
                timeout = True

        # Describe the results
        if timeout:
            print 'failed, response timed out.'
        else:
            # Grab the response, compare, and send to debugging spew
            len = radio.getDynamicPayloadSize()
            receive_payload = radio.read(len)
	    if(receive_payload != send_payload):
		print "error"
	    else:
           	 # Spew it
           	 print 'got response size=', len, ' value="', receive_payload, '"'

        time.sleep(0.1)

	inp_role = 'reset'
