

void setup()  { 
  // declare pin 3 to be an output:
  pinMode(9, OUTPUT);
} 

void loop()  { 
  // set the speed of pin 3:
  analogWrite(9, 0);    
  delay(1000);   
  analogWrite(9, 255); 
  delay(1000);                             
}

