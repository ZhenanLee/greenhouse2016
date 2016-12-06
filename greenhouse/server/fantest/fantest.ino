void setup()
{
Serial.begin(9600);
pinMode(7, OUTPUT);
}

unsigned char speed;
unsigned int low = 1;
unsigned int high = 10;
unsigned int baseTime = 10;

void loop()
{

digitalWrite(7,LOW);
delayMicroseconds(low*10);
digitalWrite(7,HIGH);
delayMicroseconds(high*10);

if (Serial.available())
{
speed = Serial.read() - 48;
low = speed;
high = baseTime - speed;
}


}
