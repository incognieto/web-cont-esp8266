#include <ESP8266HTTPClient.h> 
#include <ESP8266WiFi.h>
#include <WiFiClient.h>

const char* ssid = "<ssid hotspot/wifi>"; 
const char* pass = "<pass hotspot/wifi>";

const char* host = "<ip host>";

//#define pin_relay 5 //setup GPIO5 or D1
#define pin_lampu 4 //setup GPIO4 or D2

const int bright = 0;

void setup() {
  Serial.begin(115200);

  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid,pass);

  while(WiFi.status() != WL_CONNECTED){ //if not connected loading
    Serial.print(".");
    delay(500);
  }

  Serial.println("connected!");//if connected

  //pinMode(pin_relay, OUTPUT);
  pinMode(pin_lampu, OUTPUT);

  //digitalWrite(pin_relay, LOW);
  digitalWrite(pin_lampu, LOW);
  
}

void loop() {
  WiFiClient client; //try to connect webserver
  const int port = 80;
  
  if(!client.connect(host,port)){
    Serial.println("Failed Connect to Web Server");//if not connected
    return;
  }

  //Serial.println("Successfull Connect to Web Server");//if connected

  //String linkRelay; //read Relay Status
  //HTTPClient httpRelay;
  //linkRelay = "http://"+String(host)+"/control/readrelay.php";
  //httpRelay.begin(client, linkRelay);
  //httpRelay.GET(); //get value of linkRelay
  //String responseRelay = httpRelay.getString();
  //Serial.println(responseRelay);
  //httpRelay.end();

  //digitalWrite(pin_relay, responseRelay.toInt());//change relay status in esp8266

  String linkLampu; //read Relay Lampu
  HTTPClient httpLampu;
  linkLampu = "http://"+String(host)+"/control/readlampu.php";
  httpLampu.begin(client, linkLampu);
  httpLampu.GET(); //get value of linkRelay
  String responseLampu = httpLampu.getString();
  Serial.println(responseLampu);
  httpLampu.end();

  if(responseLampu=="20"){
    analogWrite(pin_lampu,1);
    delay(100);
  }
  else if(responseLampu=="40"){
    analogWrite(pin_lampu,2);
    delay(100);
  }
  else if(responseLampu=="60"){
    analogWrite(pin_lampu,3);
    delay(100);
  }
  else if(responseLampu=="80"){
    analogWrite(pin_lampu,4);
    delay(100);
  }
  else if(responseLampu=="100"){
    analogWrite(pin_lampu,5);
    delay(100);    
  }
  else{
    Serial.print("ups maaf ada kesalahan!");
    analogWrite(pin_lampu,LOW);
    delay(100);   
  }
}
