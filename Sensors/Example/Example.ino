//Arduino Libraries
#include <DHT.h>
#include <SPI.h>
#include <Ethernet.h>

#define DHTPIN 2     // what digital pin we're connected to
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321

// Connect pin 1 (on the left) of the sensor to +5V
// NOTE: If using a board with 3.3V logic like an Arduino Due connect pin 1
// to 3.3V instead of 5V!
// Connect pin 2 of the sensor to whatever your DHTPIN is
// Connect pin 4 (on the right) of the sensor to GROUND
// Connect a 10K resistor from pin 2 (data) to pin 1 (power) of the sensor

// Initialize DHT sensor.
// Note that older versions of this library took an optional third parameter to
// tweak the timings for faster processors.  This parameter is no longer needed
// as the current DHT reading algorithm adjusts itself to work on faster procs.
DHT dht(DHTPIN, DHTTYPE);

byte mac[] = {0x20, 0x16, 0x20, 0x16, 0x20, 0x16};
byte ip [] = {192,168,1,20};
//IPAddress server = (127, 0, 0, 1);
byte server[] = {10,109,69,98}; // IP Address (or name) of server to dump data
EthernetClient client;

int  interval = 5000; // Wait between dumps

void setup() {

  Serial.begin(9600);
  
  // disable SD SPI
  pinMode(4,OUTPUT);
  
  digitalWrite(4,HIGH);
  
  Ethernet.begin(mac);

  Serial.print("IP Address        : ");
  Serial.println(Ethernet.localIP());
  Serial.print("Subnet Mask       : ");
  Serial.println(Ethernet.subnetMask());
  Serial.print("Default Gateway IP: ");
  Serial.println(Ethernet.gatewayIP());
  Serial.print("DNS Server IP     : ");
  Serial.println(Ethernet.dnsServerIP());
}

void loop() {
  delay(1000);    //Keeps the connection from freezing
  // if you get a connection, report back via serial:
  if (client.connect(server, 80) == 1) {
    Serial.println("-> Connected");
    // Make a HTTP request:
    client.print( "GET /Example/add_data.php?serial=288884820500006X&&temperature=58.00 HTTP/1.1\r\n");
    client.print("Host: localhost\r\n");
    client.print("Connection: close\r\n\r\n");

    client.println();
    client.println();
    
    Serial.println();

    // and add this
    while (client.connected()) {
      while (client.available()) {
        Serial.write(client.read());
      }

    }
    client.stop();
  }
  else {
    // you didn't get a connection to the server:
    Serial.println("--> connection failed");
  }

  delay(interval);
}
