#include <WiFi.h> //와이파이 연결에 필요한 라이브러리
#include "DHT.h"  //dht-22센서 라이브러리
#include <SoftwareSerial.h> //미세먼지 측정에 필요한 라이브러리
#include "Adafruit_PM25AQI.h" //미세먼지 라이브러리
#include <Adafruit_INA219.h>
#include <Wire.h> // Wire 라이브러리 추가

// dth-22 핀번호 세팅
#define DHTPIN 4
#define DHTTYPE DHT22
//================

// 와이파이 연결 설정 
// #define SSID "U+ 7B" 
// #define PASSWORD "smhrd77777!" 

#define SSID "kinick" 
#define PASSWORD "kimjun9809!" 

// #define SSID "지니" 
// #define PASSWORD "wldus6775" 
//===================

//웹 서버와의 연결에 필요한 정보
// const char* serverIP = "192.168.219.50"; // 서버 IP 주소
// const int serverPort = 80; // 서버 포트

const char* serverIP = "www2.solpower.kr"; // 서버 IP 주소
const int serverPort = 80; // 서버 포트
//==============================


SoftwareSerial pmsSerial(16, 17); //미세먼지
Adafruit_PM25AQI aqi = Adafruit_PM25AQI();  //미세먼지
DHT dht(DHTPIN, DHTTYPE); //온습도 변수
WiFiClient client;  //와이파이 연결 변수
Adafruit_INA219 ina219;

void setup() {
  Serial.begin(115200);
  pmsSerial.begin(9600); // PMS5003 센서의 통신 속도에 맞춰 설정
  delay(10);

  dht.begin();
  Wire.begin(); // Wire 초기화 추가

  if (! aqi.begin_UART(&pmsSerial)) { // begin_PM25AQI 대신 begin_UART 사용
    Serial.println("Could not find PM 2.5 sensor!");

  }
  Serial.println("PM25 AQI sensor is OK"); 

  if (!ina219.begin()) {
    Serial.println("INA219를 찾을 수 없습니다.");
  }
  ina219.setCalibration_32V_2A(); // 최대 32V, 2A 측정

  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(5000);
    Serial.println("WiFi 연결 중...");
  }
  Serial.println("WiFi 연결 완료");
}

void loop() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  PM25_AQI_Data data;
  float pm10=0;
  float generation = 0;
  generation= ina219.getPower_mW();


  if (isnan(h) || isnan(t)) {
    Serial.println("dht-22 error!");
    return;
  }

  //미세먼지
  if (! aqi.read(&data)) { // 센서 데이터 읽기
    Serial.println("data Error");
  } else {
      pm10 = data.pm100_standard; // 센서 데이터 읽은 후 pm10 값 할당
  }

  if (client.connect(serverIP, serverPort)) { // 서버 연결
    // URL에 조도 데이터 추가
    String url = "/data.php?&temperature=";
    url += t; 
    url += "&humidity=";
    url += h;
    url += "&pm10=";
    url += pm10;
    url += "&generation=";
    url += generation;

    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
    "Host: " + serverIP + "\r\n" +
    "Connection: close\r\n\r\n");

    // 응답 읽기 (변경 없음)
    while (client.connected()) {
      String line = client.readStringUntil('\n');
      Serial.println(line); 
      if (line == "\r") {
        break;
      }
    }

    // 응답 본문 읽기 (변경 없음)
    while (client.available()) {
      String line = client.readStringUntil('\n');
      Serial.println(line);
    }
  }
  else {
    Serial.println("서버 연결 실패");
  }
  client.stop(); // 연결 종료
  delay(600000);
}
