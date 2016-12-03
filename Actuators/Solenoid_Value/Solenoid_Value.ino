int solenoidPin = 13;    //This is the output pin on the Arduino we are using
//TIP120 or TC31C Transistor needed as well as 220 ohm resistor
//Used 
void setup() {
  // put your setup code here, to run once:
  pinMode(solenoidPin, OUTPUT);           //Sets the pin as an output
}

void loop() {
  // put your main code here, to run repeatedly:  
  digitalWrite(solenoidPin, HIGH);    //Switch Solenoid ON
  delay(1000);                      //Wait 1 Second
  digitalWrite(solenoidPin, LOW);     //Switch Solenoid OFF
  delay(1000);                      //Wait 1 Second
}
