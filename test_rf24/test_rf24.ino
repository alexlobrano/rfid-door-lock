#include <SPI.h>
#include "RF24.h"
#include "printf.h"

const int relay_pin = 8;

RF24 radio(9,10);
const uint64_t addresses[2] = { 0xEEFDFDFDECAB, 0xEEFDFDF0DFCD }; // radio pipe addresses for the 2 nodes to communicate.
const int max_payload_size = 4;
char receive_payload[max_payload_size+1]; // +1 to allow room for a terminating NULL char

void setup(void)
{
  pinMode(relay_pin, OUTPUT);
  digitalWrite(relay_pin, HIGH);

  Serial.begin(57600);
  printf_begin();

  radio.begin();
  radio.setCRCLength( RF24_CRC_16 ) ;
  radio.enableDynamicPayloads();
  radio.setAutoAck( true ) ;
  radio.setPALevel( RF24_PA_HIGH ) ;
  radio.setDataRate( RF24_250KBPS ) ;
  radio.setRetries(15,15);
  radio.openWritingPipe(addresses[1]); // open second pipe (rpi reading pipe) for writing
  radio.openReadingPipe(1,addresses[0]); // open first pipe (rpi writing pipe) for reading

  radio.startListening();

  radio.printDetails();
}

void loop(void)
{
  while (radio.available())
  {
    uint8_t len = radio.getDynamicPayloadSize(); // fetch payload
	  radio.read( receive_payload, len );
	  printf("Got payload size=%i value=%s\n\r",len,receive_payload);

    radio.stopListening(); // stop listening so we can talk

    delay(150); // delay to allow rpi enough time to listen
    
    radio.write( receive_payload, len ); // send the payload back as confirmation
    printf("Sent response.\n\r");

    radio.startListening(); // resume listening so we catch the next packets.
      
    if(strcmp(receive_payload,"open") == 0) // confirm we received the message correctly
    {
      digitalWrite(relay_pin, LOW); // engage relay 
      delay(2000); // leave relay closed for 3 seconds
      digitalWrite(relay_pin, HIGH); // disengage relay
    }
  } 
}
