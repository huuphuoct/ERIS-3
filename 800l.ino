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
 // delay(20000);
  Serial.begin(9600); while(!Serial);                //Begin serial comunication with Arduino and Arduino IDE (Serial Monitor)
  pinMode(led, OUTPUT);
  digitalWrite(led,1); delay(1000); digitalWrite(led,0);
  serialSIM800.begin(9600); //Being serial communication witj Arduino and SIM800
  delay(1000);
  Serial.println("Setup Complete!");
//  serialSIM800.println("ATD01234510995;\r\n");
  config_sms_call(); delay(1000);
  config_http();delay(500);
        
  up_data(64);
  answer = sendATcommand("AT\r\n", "OK", 10000);   delay(1000);
  
//  send_sms("Practice makes perfect","0984095710"); delay (5000);  
//  answer = sendATcommand("ATD0984095710;\r\n", "OK", 2000);  delay(3000);
  if(answer==0)  Serial.println("error ");
  else {Serial.println("Success ");}  
  delay(2000);
//  set_up_BMP();
}
 
void loop()
{
//  digitalWrite(led,1); delay(1000); digitalWrite(led,0);delay(1000);
//  receive_sms();

//  serialEvent();
//  delay(1000);
  Serial.println("Diabetes, overweight,obesity,hear attack");
  delay(1000);
  Serial.println("Recreation");
  delay(1000);
//  draw_BMP();
}
void serialEvent(){
    uint8_t data; char responseSms[100];
    uint8_t x=0;  int temp=0;
    while(serialSIM800.available())
    {
      data=0;
      delay(1);
      data =serialSIM800.read();
      Serial.write(data);
      if(data !=0)
      {
        responseSms[x] = data;      
        x++;
         if (strstr(responseSms,"Duy") != NULL) {Serial.println("OK"); digitalWrite(led,1); temp=1;}
               else if (strstr(responseSms,"BYEDUY") != NULL) {Serial.println("NO"); digitalWrite(led,0); temp=1;}
               if(temp==1){
                memset(responseSms, '\0', 100);    // Initialice the string
                delay(100);
                temp=0;                    
              }                                          
      }
    }
}

void up_data(int value)
{
  char buf_data[100], buf_value[100];
  char request[] = "api.thingspeak.com/update?api_key=1S9BBY02QEAYG2LT&field1=%d";
//  char request[] = "phuoc.esy.es/cambien.php?cb1=%d&cb2=0&cb3=0";
  sendATcommand("AT+HTTPPARA=\"CID\",1\r\n","OK",2000);
  sprintf(buf_value,request,value);
  sprintf(buf_data,"AT+HTTPPARA=\"URL\",\"%s\"\r\n",buf_value);
  answer = sendATcommand(buf_data,"OK",10000);
  if(answer ==1)
  {
    Serial.println("Upload success");
    sendATcommand("AT+HTTPACTION=0","OK",10000);
    answer =0;
  }
}
void config_sms_call(void)
{
  sendATcommand("AT+CMGF=1\r\n","OK",2000);         /* Config SMS text */
  sendATcommand("AT+CNMI=2,2\r\n","OK",2000);    /* Config SMS memory */
  sendATcommand("AT+CMGDA=\"DEL ALL\"\r\n","OK",2000);
  sendATcommand("AT+CLIP=1\r\n","OK",2000);   
}
void config_http(void)
{
  sendATcommand("AT+SAPBR=3,1,\"Contype\",\"GPRS\"\r\n","OK",2000); delay(1000);
  sendATcommand("AT+SAPBR=3,1,\"APN\",\"m_wap\"\r\n","OK",2000);  delay(1000);
  serialSIM800.println("AT+SAPBR=1,1\r\n"); delay(5000); Serial.println("DOneeeee");
//  sendATcommand("AT+SAPBR=1,1\r\n","OK",2000);  delay(1000);
//  sendATcommand("AT+HTTPINIT\r\n","OK",2000); delay(1000);
  serialSIM800.println("AT+HTTPINIT\r\n"); delay(2000); Serial.println("DO");
//  sendATcommand("AT+HTTPPARA=\"CID\",1\r\n","OK",2000); Serial.println("DOneeeee");
  serialSIM800.println("AT+HTTPPARA=\"CID\",1\r\n"); delay(3000); Serial.println("DOne");
  
}

void set_up_BMP()
{
  oled.begin(SSD1306_SWITCHCAPVCC, OLED_Address);
  oled.clearDisplay();
  oled.setTextSize(2);
}

void draw_BMP()
{
  if(x>127)  
  {
    oled.clearDisplay();
    x=0;
    lastx=x;
  }

  ThisTime=millis();
  int value=analogRead(0);
  oled.setTextColor(WHITE);
  int y=60-(value/16);
  oled.writeLine(lastx,lasty,x,y,WHITE);
  lasty=y;
  lastx=x;
  // calc bpm

  if(value>UpperThreshold)
  {
    if(BeatComplete)
    {
      BPM=ThisTime-LastTime;
      BPM=int(60/(float(BPM)/1000));
      BPMTiming=false;
      BeatComplete=false;
      tone(8,1000,250);
    }
    if(BPMTiming==false)
    {
      LastTime=millis();
      BPMTiming=true;
    }
  }
  if((value<LowerThreshold)&(BPMTiming))
    BeatComplete=true;
    
    // display bpm
  oled.writeFillRect(0,50,128,16,BLACK);
  oled.setCursor(0,50);
  oled.print(BPM);
  oled.print(" BPM");
  oled.display();
  x++;
}
