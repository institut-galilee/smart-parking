#include <WiFi.h>
#include <WiFiMulti.h>
#include <HTTPClient.h>
#include "ArduinoJson.h"


// utlrasonic pinout


//#define ULTRASONIC_TRIG_PIN     2 // pin TRIG 
//#define ULTRASONIC_ECHO_PIN     4// pin ECHO 

#define echoPin1 4 // Echo Pin for sonar 1
#define trigPin1 2 // Trigger Pin for sonar 1
#define echoPin2  18// Echo Pin for sonar 2 
#define trigPin2 5 // Trigger Pin for sonar 2

// measure distance 
  //long duration, distance;
  long duration1, distance1; // Duration used to calculate distance
long duration2, distance2;

int count=0;
int freeSlot =0;

int etat1= 0;
int etat2= 0;


WiFiMulti WiFiMulti;
HTTPClient ask;
// TODO: user config
const char* ssid     = ""; //Wifi SSID
const char* password = ""; //Wifi Password
const char* host = "http://192.168.0.22/";  // host
const int httpPort = 80;      // port
  

void setup() {


  // open serial
  Serial.begin(9600);
  Serial.println("*****************************************************");
  Serial.println("********** Program Start : Connect ESP32 to park-here.");
  Serial.println("Wait for WiFi... ");

  // connecting to the WiFi network
  WiFiMulti.addAP(ssid, password);
  while (WiFiMulti.run() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  // connected
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  
 //Serial.begin (9600); // initiate serial communication to raspberry pi
 // ultraonic setup 
  //pinMode(ULTRASONIC_TRIG_PIN, OUTPUT);
  //pinMode(ULTRASONIC_ECHO_PIN, INPUT);


 //Serial.begin (9600); // initiate serial communication to raspberry pi
 pinMode(trigPin1, OUTPUT); // trigger pin as output
 pinMode(echoPin1, INPUT);  // echo pin as input
 pinMode(trigPin2, OUTPUT);
 pinMode(echoPin2, INPUT);
}



void loop(){
  
  
  

  // Use WiFiClient class to create TCP connections
  WiFiClient client;

digitalWrite(trigPin1, LOW); 
 delayMicroseconds(2); 
 digitalWrite(trigPin1, HIGH);
 delayMicroseconds(10); 
 digitalWrite(trigPin1, LOW);
 // pulseIn( ) function determines a pulse width in time
 // duration of pulse is proportional to distance of obstacle
 duration1 = pulseIn(echoPin1, HIGH);

 digitalWrite(trigPin2, LOW);
 delayMicroseconds(2); 
 digitalWrite(trigPin2, HIGH);
 delayMicroseconds(10); 
 digitalWrite(trigPin2, LOW);
 duration2 = pulseIn(echoPin2, HIGH);



distance1 = duration1 /58.2;
distance2 = duration2 /58.2;

Serial.print("********** Ultrasonic Distance 1: ");
  Serial.print(distance1);
  Serial.println(" cm *********");
  Serial.print("********** Ultrasonic Distance 2: ");
  Serial.print(distance2);
  Serial.println(" cm *********");

  
 if(distance1<10){
   distance1 = 1;
   etat1 = 1;
   Serial.println("la place numero 1 est occupé");
   
   
 }
 else { distance1 = 0;
      etat1 = 0;
 Serial.println("la place  numero 1 est libre");
 }
  if(distance2<10){
   distance2 = 1;
   etat2 = 1; 
   Serial.println("la place numero 2 est occupé");
 }
 else { distance2 = 0;
      etat2 = 0;
 Serial.println("la place  numero 2 est libre");
 }


// add the result from all sensor to count total car
count = distance1 + distance2 ;

 // free slot = total slot - total car
 freeSlot = 2 - count;
 // number of total slot is
 
 Serial.print("number de place libre: "); 
 Serial.println(freeSlot);


StaticJsonDocument<100> testDocument;
   
  testDocument["id1"] = 15;
  testDocument["value1"] = etat1;
   testDocument["id2"] = 16;
   testDocument["value2"] = etat2;
 
  char buffer[100];
 
  serializeJson(testDocument, buffer);
 
  Serial.println(buffer);
   
  

ask.begin("http://192.168.0.22/iot/api/slot/update.php"); //Specify request destination
ask.addHeader("Content-Type", "application/json"); //Specify content-type header
  
    //Check for the returning code
    int httpCode = ask.POST(buffer);          
 
    if (httpCode > 0) { 
 
        String payload = ask.getString();
        Serial.println(httpCode);
        Serial.println(payload);
      } else {
      Serial.println("Error on HTTP request");
    }
 
    ask.end(); //End 
    Serial.println("********** End ");
    Serial.println("*****************************************************");

  

  client.stop();  // stop client
 //// update every 30s
 delay(30000);
 freeSlot = 0;
 distance1 = 0;
 distance2 = 0;
 

 }
