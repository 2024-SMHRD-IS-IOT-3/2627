// #include <WiFi.h> 
// #include <Wire.h>
// #include <Adafruit_TSL2591.h>

// Adafruit_TSL2591 tsl = Adafruit_TSL2591(2591); 
// WiFiClient client; 

// // 와이파이 연결 설정 
// #define SSID "kinick" 
// #define PASSWORD "kimjun9809!" 

// //웹 서버와의 연결에 필요한 정보
// const char* serverIP = "www2.solpower.kr"; 
// const int serverPort = 80; 

// // 측정값의 범위 설정
// const float MIN_LUX = 0.1;  // 최소 조도값 (lux)
// const float MAX_LUX = 88000.0;  // 최대 조도값 (lux)

// void setup() {
//     Serial.begin(115200);
    
//     // WiFi 연결
//     WiFi.begin(SSID, PASSWORD);
//     while (WiFi.status() != WL_CONNECTED) {
//         delay(5000);
//         Serial.println("WiFi 연결 중...");
//     }
//     Serial.println("WiFi 연결 완료");

//     // TSL2591 센서 초기화
//     if (!tsl.begin()) {
//         Serial.println("TSL2591 센서를 찾을 수 없습니다.");
//         while (1);
//     }
// }

// float measureLux() {
//     uint32_t lum = tsl.getFullLuminosity();
//     uint16_t ir, full;
//     ir = lum >> 16;
//     full = lum & 0xFFFF;
//     float lux = tsl.calculateLux(full, ir);

//     // 측정값을 MIN_LUX와 MAX_LUX 범위 내로 제한
//     if (lux < MIN_LUX) {
//         lux = MIN_LUX;
//     } else if (lux > MAX_LUX) {
//         lux = MAX_LUX;
//     }

//     return lux;
// }

// void loop() {
//   // 태양광의 수치가 너무 높아 측정 가능한 범위 내로 수정
//     float sunlight = round(measureLux() * 10) / 10000.0;

//     if (client.connect(serverIP, serverPort)) { 
//         // data.php에 센서 데이터 전송
//         String url = "/data.php?sunlight=";
//         url += String(sunlight, 1); // 소수점 한 자리까지 표시

//         Serial.println("Sending request: " + url);

//         client.print(String("GET ") + url + " HTTP/1.1\r\n" +
//         "Host: " + serverIP + "\r\n" +
//         "Connection: close\r\n\r\n");

//         // 응답 읽기 
//         while (client.connected()) {
//             String line = client.readStringUntil('\n');
//             Serial.println(line); 
//             if (line == "\r") {
//                 break;
//             }
//         }

//         // 응답 본문 읽기 
//         while (client.available()) {
//             String line = client.readStringUntil('\n');
//             Serial.println(line);
//         }
//     }
//     else {
//         Serial.println("서버 연결 실패");
//     }

//     client.stop(); // 연결 종료
//     delay(600000);
// }

#include <WiFi.h> 
#include <Wire.h>
#include <Adafruit_TSL2591.h>

Adafruit_TSL2591 tsl = Adafruit_TSL2591(2591); 
WiFiClient client; 

// 와이파이 연결 설정 
#define SSID "kinick" 
#define PASSWORD "kimjun9809!" 

//웹 서버와의 연결에 필요한 정보
const char* serverIP = "www2.solpower.kr"; 
const int serverPort = 80; 

// 측정값의 범위 설정
const float MIN_LUX = 0.1;  // 최소 조도값 (lux)
const float MAX_LUX = 88000.0;  // 최대 조도값 (lux)

void setup() {
    Serial.begin(115200);
    
    // WiFi 연결
    WiFi.begin(SSID, PASSWORD);
    while (WiFi.status() != WL_CONNECTED) {
        delay(5000);
        Serial.println("WiFi 연결 중...");
    }
    Serial.println("WiFi 연결 완료");

    // TSL2591 센서 초기화
    if (!tsl.begin()) {
        Serial.println("TSL2591 센서를 찾을 수 없습니다.");
        while (1);
    }

    // 센서 설정
    tsl.setGain(TSL2591_GAIN_LOW);
    tsl.setTiming(TSL2591_INTEGRATIONTIME_100MS);
}

float measureLux() {
    uint32_t lum = tsl.getFullLuminosity();
    uint16_t ir, full;
    ir = lum >> 16;
    full = lum & 0xFFFF;
    float lux = tsl.calculateLux(full, ir);

    // 측정값이 0이거나 너무 높으면 게인을 조정
    if (lux == 0 || lux > MAX_LUX) {
        tsl.setGain(TSL2591_GAIN_LOW);
        delay(100);
        lum = tsl.getFullLuminosity();
        ir = lum >> 16;
        full = lum & 0xFFFF;
        lux = tsl.calculateLux(full, ir);
    }

    // 측정값을 MIN_LUX와 MAX_LUX 범위 내로 제한
    if (lux < MIN_LUX) {
        lux = MIN_LUX;
    } else if (lux > MAX_LUX) {
        lux = MAX_LUX;
    }

    return lux;
}

void loop() {
    float sunlight = measureLux();

    // 높은 조도값을 처리하기 위해 로그 스케일 적용
    if (sunlight > 1000) {
        sunlight = log10(sunlight) * 1000;  // 로그 스케일로 변환
    }

    sunlight = round(sunlight * 10) / 10.0;  // 소수점 첫째자리까지 반올림

    if (client.connect(serverIP, serverPort)) { 
        // data.php에 센서 데이터 전송
        String url = "/data.php?sunlight=";
        url += String(sunlight, 1); // 소수점 한 자리까지 표시

        Serial.println("Sending request: " + url);
        Serial.print("Measured sunlight: ");
        Serial.print(sunlight);
        Serial.println(" lux");

        client.print(String("GET ") + url + " HTTP/1.1\r\n" +
        "Host: " + serverIP + "\r\n" +
        "Connection: close\r\n\r\n");

        // 응답 읽기 및 출력 코드는 그대로 유지
    }
    else {
        Serial.println("서버 연결 실패");
    }

    client.stop(); // 연결 종료
    delay(600000);
}