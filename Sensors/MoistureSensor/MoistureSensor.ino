/*
 
 All the resources for this project:
 http://randomnerdtutorials.com/
 
*/

int rainPin = A0;

// you can adjust the threshold value
int thresholdValue = 800;

void setup(){
  pinMode(rainPin, INPUT);
  Serial.begin(9600);
}

void loop() {
  // read the input on analog pin 0:
  int sensorValue = analogRead(rainPin);
  Serial.print(sensorValue);
  if(sensorValue < thresholdValue){
    Serial.println(" - Doesn't need watering");
  }
  else {
    Serial.println(" - Time to water your plant");
  }
  delay(500);
}
