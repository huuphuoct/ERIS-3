#include <SoftwareSerial.h>
#include <Adafruit_SSD1306.h>
#include "MAX30100_PulseOximeter.h"
#include "TimerOne.h" 

#define SIM800_TX_PIN 10   
#define SIM800_RX_PIN 11    
#define OLED_Address 0x3C
#define REPORTING_PERIOD_MS     1000
#define OverBeat 120
#define LowBeat 0
SoftwareSerial serialSIM800(SIM800_TX_PIN,SIM800_RX_PIN); //Create software serial object to communicate with SIM800
//Adafruit_SSD1306 oled(1); // config Oled
PulseOximeter pox;

uint32_t tsLastReport = 0;
const int led =  13;  int answer=0;                         
float heart =0;
int heart_int;  int count; int flag_up=0; 
int sp02 = 0; 
int heart_avr=0 , sampling=0 , sum_heart=0;
int8_t sendATcommand(char* ATcommand, char* expected_answer, unsigned int timeout){

  uint8_t x=0,answer=0;
  uint8_t ch;
  char response[100];

  memset(response, '\0', 100);    // Initialice the string

  delay(100);

  while( serialSIM800.available() > 0) serialSIM800.read();    // Clean the input buffer

  serialSIM800.Write(ATcommand);    // Send the AT command 
    x = 0;
    
  // this loop waits for the answer
  do{
    // if there are data in the UART input buffer, reads it and checks for the answer
      delay(1);
      ch =  serialSIM800.read(); Serial.write(ch);
      if(ch !=0)
      {
         response[x] = ch;
         x++;
         if (strstr(response, expected_answer) != NULL)  answer = 1;  
      }  
    }
    // Waits for the answer with time out
  while((answer == 0) && (--timeout>0));    
  ch=0;
  return answer;
}

void onBeatDetected()
{
    Serial.println("Beat!");
}

void TICK(void)
{
  
}
 
void setup() {
  pinMode(led,OUTPUT);
  Serial.begin(9600);                 //Begin serial comunication with Arduino and Arduino IDE (Serial Monitor)
//Serial.begin(115200); 
  serialSIM800.begin(9600); delay(2000);                         //Being serial communication witj Arduino and SIM800
  Serial.println("S
