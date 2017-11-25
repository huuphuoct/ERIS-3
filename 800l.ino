#include <SoftwareSerial.h>
#include <Adafruit_SSD1306.h>


 /*PINOUT: 
 *        _____________________________
 *       |  ARDUINO UNO >>>   SIM800L  |         ARDUINO UNO >>>   HEARTBEAT        ARDUINO UNO >>>   OLED I2C
 *        -----------------------------
 *        GND      >>>   GND                        S >>> AO                            SCK >>>> A5
 *        RX  10   >>>   TX                                                             SDL >>>> A4
 *        TX  11   >>>   RX                                                             VCC >>>> 3.3v
 *       RESET 2   >>>   RST 
 */     

#define SIM800_TX_PIN 10    //SIM800 TX is connected to Arduino D10
#define SIM800_RX_PIN 11    //SIM800 RX is connected to Arduino D11

SoftwareSerial serialSIM800(SIM800_TX_PIN,SIM800_RX_PIN); //Create software serial object to communicate with SIM800

const int led =  13;  int answer=0;                         
int x=0, lastx=0,lasty=0, LastTime=0,ThisTime, BPM=0;
bool BPMTiming=false, BeatComplete=false;

int8_t sendATcommand(char* ATcommand, char* expected_answer, unsigned int timeout){

  uint8_t x=0,answer=0;
  uint8_t ch;
  char response[100];

  memset(response, '\0', 100);    // Initialice the string

  delay(100);

  while( serialSIM800.available() > 0) serialSIM800.read();    // Clean the input buffer

  serialSIM800.println(ATcommand);    // Send the AT command 
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
 
void setup() {

  Serial.begin(9600); while(!Serial);                //Begin serial comunication with Arduino and Arduino IDE (Serial Monitor)
  pinMode(led, OUTPUT);
  digitalWrite(led,1); delay(1000); digitalWrite(led,0);
  serialSIM800.begin(9600); //Being serial communication witj Arduino and SIM800
  delay(1000);
  Serial.println("Setup Complete!");
  up_data();
//  config_sms_call(); delay(1000);
//  config_http();delay(1000);
//  answer = sendATcommand("AT\r\n", "OK", 10000);   delay(1000);
//  if(answer==0)  Serial.println("error ");
//  else {Serial.println("Success ");}  
//  delay(2000);
//  send_sms("Practice makes perfect","0984095710"); delay (5000);  
//  answer = sendATcommand("ATD0984095710;\r\n", "OK", 2000);  
//  set_up_BMP();
}
 
void loop()
{
//  digitalWrite(led,1); delay(1000); digitalWrite(led,0);delay(1000);
//  receive_sms();

//  serialEvent();
  delay(1000);
  Serial.println("Diabetes, overweight,obesity,hear attack");
  delay(1000);
  Serial.println("Recreation");
  delay(1000);
//  draw_BMP();
}
void up_data()
{
  char buf_data[100];
  char data[] = "api.thingspeak.com/update?api_key=1S9BBY02QEAYG2LT&field1=47";
  sprintf(buf_data,"AT+HTTPPARA=\"URL\",\"%s\"\r\n",data);
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
  sendATcommand("AT+SAPBR=3,1,\"Contype\",\"GPRS\"\r\n","OK",2000);
  sendATcommand("AT+SAPBR=3,1,\"APN\",\"m_wap\"\r\n","OK",2000);
  sendATcommand("AT+SAPBR =1,1\r\n","OK",2000);
  sendATcommand("AT+HTTPINIT\r\n","OK",2000);
  sendATcommand("AT+HTTPPARA=\"CID\",1\r\n","OK",2000);
}




