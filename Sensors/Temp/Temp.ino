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

byte mac[] = {0x20, 0x16, 0x20, 0x16, 0x20, 0x16};  //EthernetSHIELD
byte ip[] = {192, 168, 1, 20};                      //EthernetSHIELD

char server[] = "192.168.1.21"; // IP Adres (or name) of server to dump data to (localhost)
EthernetClient client;

int  interval = 5000; // Wait between dumps

void setup() {
  Serial.begin(9600);

  // disable SD SPI
  pinMode(4, OUTPUT);
  digitalWrite(4, HIGH);

  //enable dht sensor
  Serial.println("begin dht");
  dht.begin();
  Serial.println("dht started");

  //enable ethernet
  Ethernet.begin(mac);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // no point in carrying on, so do nothing forevermore:
    //while(true);
  }

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
  // Wait a few seconds between measurements.
  delay(2000);

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)

  float h = dht.readHumidity();

  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();

  // Read temperature as Fahrenheit (isFahrenheit = true)
  //float f = dht.readTemperature(true);
  int m = 1000;     //Used without moisture sensor
  // Check if any reads failed and exit early (to try again).
  if ( isnan(t) || isnan(h)) {
    Serial.println("Failed to read from DHT sensor!");
    //Log info to Server
    /*example
        client.print("t = NAN");
        Sensor reads once again
        client.print("POST /../../errors.php");
        (NAN)client.print(t);
         client.print("NAN value");
    */
    return;
  }

  // Compute heat index in Fahrenheit (the default)
  //float hif = dht.computeHeatIndex(f, h);
  // Compute heat index in Celsius (isFahreheit = false)
  //float hic = dht.computeHeatIndex(t, h, false);

  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");

  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C \t");

  Serial.print("Moisture: ");
  Serial.print(m);
  Serial.println();

  //Connecting to server
  Serial.println("connecting");
  if (client.connect(server, 80) == 1) {
    Serial.println("Connected");
    //Make a HTTP request -> add_data.php
    client.print("GET /greenhouse2016/add_data.php?temp=");
    client.print( t );
    client.print("&&");
    client.print("hum=");
    client.print( h );
    client.print("&&");
    client.print("mos=");
    client.print( m );
    client.println(" HTTP/1.1");
    client.print( "Host: " );
    client.println(server);
    client.println("Connection: close");
    client.println();

    Serial.println();
  }
  else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }

  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }


  // if the server's disconnected, stop the client:
  while (client.connected() )
  {
    client.stop();
    Serial.println('stopping the connection... ');
  }
}




