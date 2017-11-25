#include <SoftwareSerial.h>
#include <Adafruit_SSD1306.h>
 /*PINOUT: 
 *        _____________________________
 *       |  ARDUINO UNO >>>   SIM800L  |         ARDUINO UNO >>>   HEARTBEAT        ARDUINO UNO >>>   OLED I2C
 *        -----------------------------
 *        GND      >>>   GND                        S >>> AO                            SCL> A5
 *        RX  10   >>>   TX                                                             SDA >>>> A4
 *        TX  11   >>>   RX                                                             VCC >>>> 3.3v
 *       RESET 2   >>>   RST 
 */     

#define SIM800_TX_PIN 10    //SIM800 TX is connected to Arduino D10
#define SIM800_RX_PIN 11    //SIM800 RX is connected to Arduino D11
#define OLED_Address 0x3C

#define UpperThreshold 560  // Heart beat
#define LowerThreshold 500
SoftwareSerial serialSIM800(SIM800_TX_PIN,SIM800_RX_PIN); //Create software serial object to communicate with SIM800


 
void loop()
{

}
void serialEvent(){
    
}

void up_data(int value)
{
  
}
void config_sms_call(void)
{
  
}
void config_http(void)
{
  
  
}





