#include <SoftwareSerial.h>
#include <Adafruit_SSD1306.h>
#include "MAX30100_PulseOximeter.h"
  

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
  Serial.println("Setup Complete!\r\n"); 
  config_sms_call(); delay(1000); Serial.println("SMS Complete!\r\n");
  config_http();delay(500); Serial.println("HTTP Complete!\r\n");
//  up_data(30); delay(20000); up_data(70);
//  send_sms("Hello Duy","0984095710");
//  delay(5000); Serial.println("Config BMP...\r\n");
//  set_up_BMP(); delay(2000);  Serial.println("BMP Complete!\r\n");
//   Serial.println("Set up BMP");
    
    
//     set_up_BMP(); delay(2000);
//   Serial.println("Set up BMP");

   Timer1.initialize(1000000);
  Timer1.attachInterrupt(Blink);  
   setup_max30100(); 
      
    

}
 
void loop()
{
  heartbeat();
  
  if(flag_up==1){
    digitalWrite(led,0);    
    up_data(heart_int,sp02);
    if(heart_int > OverBeat) send_sms("Over beat","0984095710");
    setup_max30100();
    count =0; flag_up=0;
  }
}


void Blink()
{  
  count++;
  if(count == 5) digitalWrite(led,1);
  if(count == 20)
  {
    flag_up=1;
  }
}

/********--- Module Sim ************************
***********************************************************/

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

void up_data(int value,int oxi)
{
  char buf_data[100], buf_value[100];
  char request[] = "phuocdang.esy.es/cambien.php?cb1=%d&cb2=%d&cb3=0";
  sprintf(buf_value,request,value,oxi);
  sprintf(buf_data,"AT+HTTPPARA=\"URL\",\"%s\"\r\n",buf_value);
  answer = sendATcommand(buf_data,"OK",10000);
  if(answer ==1)
  {
    Serial.println("Upload success");
    sendATcommand("AT+HTTPACTION=0","OK",10000);
    answer =0;
  }
}
void send_sms(char* sms_text,char* phone_number)
{
  sendATcommand("AT+CMGF=1\r\n","OK",2000);
  char buffer_sms[50];
  sprintf(buffer_sms,"AT+CMGS="%s"\r\n", phone_number);
  serialSIM800.println(buffer_sms); delay(1000); Serial.println("Sending SMS...");
  serialSIM800.println(sms_text); delay(1000); Serial.println(sms_text); 
}
void config_sms_call(void)
{
  sendATcommand("AT+CMGF=1\r\n","OK",2000);         /* Config SMS text */
  sendATcommand("AT+CNMI=2,2\r\n","OK",2000);    /* Config SMS memory */
//  sendATcommand("AT+CMGDA=\"DEL ALL\"\r\n","OK",2000);
  serialSIM800.println("AT+CMGDA=\"DEL ALL\"\r\n");
  sendATcommand("AT+CLIP=1\r\n","OK",2000);   
}
void config_http(void)
{
  sendATcommand("AT+SAPBR=3,1,\"Contype\",\"GPRS\"\r\n","OK",2000); delay(1000);
  sendATcommand("AT+SAPBR=3,1,\"APN\",\"m_wap\"\r\n","OK",2000);  delay(1000);  
  sendATcommand("AT+HTTPINIT\r\n","OK",2000); delay(1000); 
  sendATcommand("AT+HTTPPARA=\"CID\",1\r\n","OK",2000); Serial.println("DOneeeee");
  
  
}

/********--- Heart Beat Sensor ************************
***********************************************************/
//void set_up_BMP()
//{
//  oled.begin(SSD1306_SWITCHCAPVCC, OLED_Address);
//  oled.clearDisplay();
//  oled.setTextSize(2);
//}
//void draw_BMP()
//{ 
//  char buf_bmp[20];
//  sprintf(buf_bmp,"%d",heart_int);
// oled.clearDisplay();
//  oled.setTextColor(WHITE);
//  oled.setCursor(0,0);
//  oled.println("Hello");
//  oled.display();
//
//}




void setup_max30100(void)
{
  Serial.print("Initializing pulse oximeter..");

    // Initialize the PulseOximeter instance
    // Failures are generally due to an improper I2C wiring, missing power supply
    // or wrong target chip
    if (!pox.begin()) {
        Serial.println("FAILED");
        for(;;);
    } else {
        Serial.println("SUCCESS");
    }

    // The default current for the IR LED is 50mA and it could be changed
    //   by uncommenting the following line. Check MAX30100_Registers.h for all the
    //   available options.
    // pox.setIRLedCurrent(MAX30100_LED_CURR_7_6MA);

    // Register a callback for the beat detection
    pox.setOnBeatDetectedCallback(onBeatDetected);
}

void heartbeat(void)
{
   // Make sure to call update as fast as possible
    pox.update();

    // Asynchronously dump heart rate and oxidation levels to the serial
    // For both, a value of 0 means "invalid"
    if (millis() - tsLastReport > REPORTING_PERIOD_MS) {
        Serial.print("Heart rate:");
        heart = pox.getHeartRate();        
        sampling +=1;
         heart_int = (int) heart;
        sum_heart += heart_int;
        if(sampling == 10)
        {
           heart_avr = sum_heart;
           heart_avr = heart_avr/10;
           sampling =0;          
        }
       
        Serial.print(heart);
        Serial.print("bpm / SpO2:");
        sp02 = pox.getSpO2();
        Serial.print(sp02);
        Serial.println("%");

        tsLastReport = millis();
    }
}

