#include <WiFi.h>
#include <WebServer.h>
#include <ArduinoJson.h>
#include <Bounce2.h>
#include <FirebaseESP32.h>

const char* ssid = "YaranaFiber";
const char* password = "12112001";
#define FIREBASE_HOST "yarana-smart-home-default-rtdb.firebaseio.com"
#define FIREBASE_AUTH "AIzaSyASlxbE-mAJpeIf4Lv3BRCYQjCZ-zH5H-Y"

WebServer server(80);

// Define LED pins
const int LED1_PIN = 2;
const int LED2_PIN = 15;
const int LED3_PIN = 4;
const int LED4_PIN = 5;

// Define switch pins
#define SwitchPin1 17
#define SwitchPin2 14
#define SwitchPin3 27
#define SwitchPin4 12

FirebaseData firebaseData;
FirebaseAuth auth;
FirebaseConfig config;

// HTML code stored in PROGMEM
const char index_html[] PROGMEM = R"rawliteral(
<!DOCTYPE html>
<html>
<head>
  <title>Firebase Real-time Data Listener</title>
  <!-- Use compat version to avoid modular issues -->
  <script src="https://www.gstatic.com/firebasejs/9.8.1/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.8.1/firebase-database-compat.js"></script>
</head>
<body>
  <h1>Firebase Real-time Data Listener</h1>
  <div id="statusLED1">LED1 status: </div>
  <div id="statusLED2">LED2 status: </div>
  <div id="statusLED3">LED3 status: </div>
  <div id="statusLED4">LED4 status: </div>

 <script>
const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_ PROJECT_NAME.firebaseapp.com",
  projectId: "YOUR_PROJECT_NAME",
  storageBucket: "YOUR_PROJECT_NAME.appspot.com",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "1:YOUR_APP_ID:web:RANDOM_STRING",
  measurementId: "G-YOUR_MEASUREMENT_ID",
  databaseURL: "https://YOUR_PROJECT_NAME-default-rtdb.firebaseio.com"
};
   firebase.initializeApp(firebaseConfig)

  const database = firebase.database()

  function handleSnapshot(snapshot) {
    const data = snapshot.val();
    const led1Status = data.LED1;
    const led2Status = data.LED2;
    const led3Status = data.LED3;
    const led4Status = data.LED4;

    updateLEDStatus("statusLED1", "LED1", led1Status);
    updateLEDStatus("statusLED2", "LED2", led2Status);
    updateLEDStatus("statusLED3", "LED3", led3Status);
    updateLEDStatus("statusLED4", "LED4", led4Status);

    // Send LED statuses to ESP32
    fetch('/updateLEDStatuses', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        led1Status: led1Status,
        led2Status: led2Status,
        led3Status: led3Status,
        led4Status: led4Status
      })
    })
    .then(response => response.text())
    .then(data => console.log('Response from ESP32:', data))
    .catch(error => console.error('Error:', error));
  }

  function updateLEDStatus(elementId, ledName, status) {
    var statusText = document.getElementById(elementId);
    statusText.textContent = ledName + " is " + (status ? "ON" : "OFF");
  }

  database.ref().on('value', handleSnapshot);
</script>
 
</body>
</html>
)rawliteral";

void handleRoot() {
  server.send(200, "text/html", index_html);
}

// Function to update LED state in Firebase
void updateLED(const char* tag, bool state) {
  int value = state ? 1 : 0;  // Convert state to 1 (ON) or 0 (OFF)
  if (!Firebase.setInt(firebaseData, tag, value)) {
    Serial.print("Error sending data to Firebase: ");
    Serial.println(firebaseData.errorReason());
  }
}

Bounce debouncer1 = Bounce(); // Debouncer objects for each button
Bounce debouncer2 = Bounce();
Bounce debouncer3 = Bounce();
Bounce debouncer4 = Bounce();

void handleButtonEvent(Bounce* button, int ledPin, const char* firebaseTag, bool& ledState) {
  if (button->fell() || button->rose()) {
    ledState = !ledState;  // Toggle LED state
    digitalWrite(ledPin, ledState ? HIGH : LOW); // Update the physical LED
    updateLED(firebaseTag, ledState); // Update Firebase with new state
  }
}

// Endpoint to receive LED statuses from HTML/JavaScript
void handleUpdateLEDStatuses() {
  if (server.hasArg("plain")) {
    String body = server.arg("plain");

    // Deserialize JSON data
    DynamicJsonDocument doc(200);
    DeserializationError error = deserializeJson(doc, body);

    if (!error) {
      int led1Status = doc["led1Status"];
      int led2Status = doc["led2Status"];
      int led3Status = doc["led3Status"];
      int led4Status = doc["led4Status"];

      // Update LED statuses based on received values
      digitalWrite(LED1_PIN, led1Status ? HIGH : LOW);
      digitalWrite(LED2_PIN, led2Status ? HIGH : LOW);
      digitalWrite(LED3_PIN, led3Status ? HIGH : LOW);
      digitalWrite(LED4_PIN, led4Status ? HIGH : LOW);

      // Print LED statuses to Serial Monitor
      Serial.print("LED1 status: ");
      Serial.println(led1Status);
      Serial.print("LED2 status: ");
      Serial.println(led2Status);
      Serial.print("LED3 status: ");
      Serial.println(led3Status);
      Serial.print("LED4 status: ");
      Serial.println(led4Status);

      server.send(200, "text/plain", "LED statuses received successfully");
    } else {
      server.send(400, "text/plain", "Error parsing JSON data");
    }
  } else {
    server.send(400, "text/plain", "No JSON data received");
  }
}

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to ");
  Serial.print(ssid);

  unsigned long startAttemptTime = millis();

  while (WiFi.status() != WL_CONNECTED && millis() - startAttemptTime < 10000) {
    delay(500);
    Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println();
    Serial.print("Connected to ");
    Serial.println(ssid);
    Serial.print("IP Address: ");
    Serial.println(WiFi.localIP());
    Serial.println("Hello Abhishek");

    // Register endpoints
    server.on("/", handleRoot);
    server.on("/updateLEDStatuses", handleUpdateLEDStatuses);

    // Initialize LED pins
    pinMode(LED1_PIN, OUTPUT);
    pinMode(LED2_PIN, OUTPUT);
    pinMode(LED3_PIN, OUTPUT);
    pinMode(LED4_PIN, OUTPUT);

    pinMode(SwitchPin1, INPUT_PULLUP); // Setting pins as input with pull-up resistors
    pinMode(SwitchPin2, INPUT_PULLUP);
    pinMode(SwitchPin3, INPUT_PULLUP);
    pinMode(SwitchPin4, INPUT_PULLUP);

    // Set up debouncers for each button
    debouncer1.attach(SwitchPin1);
    debouncer1.interval(20); // Interval in milliseconds
    debouncer2.attach(SwitchPin2);
    debouncer2.interval(20);
    debouncer3.attach(SwitchPin3);
    debouncer3.interval(20);
    debouncer4.attach(SwitchPin4);
    debouncer4.interval(20);

    config.host = FIREBASE_HOST;
    config.signer.tokens.legacy_token = FIREBASE_AUTH;
    Firebase.begin(&config, &auth);
    Firebase.reconnectWiFi(true);
    server.begin();
  } else {
    Serial.println();
    Serial.println("Failed to connect to WiFi");
  }
}

void loop() {
  debouncer1.update();
  debouncer2.update();
  debouncer3.update();
  debouncer4.update();

  static bool led1State = LOW;
  static bool led2State = LOW;
  static bool led3State = LOW;
  static bool led4State = LOW;

  // Handle button events
  handleButtonEvent(&debouncer1, LED1_PIN, "LED1", led1State);
  handleButtonEvent(&debouncer2, LED2_PIN, "LED2", led2State);
  handleButtonEvent(&debouncer3, LED3_PIN, "LED3", led3State);
  handleButtonEvent(&debouncer4, LED4_PIN, "LED4", led4State);

  // Handle web server requests
  server.handleClient();
}
