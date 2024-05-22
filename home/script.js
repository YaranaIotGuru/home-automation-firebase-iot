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

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Reference to Firebase database
    var database = firebase.database();

    // Function to toggle LED status
    function toggleLED(led, status) {
        var ledRef = database.ref(led);
        ledRef.set(status ? 1 : 0); // Convert boolean to 1 or 0
    }

    // Listen for changes in LED status
    database.ref().on('value', function(snapshot) {
        var led1Status = snapshot.val().LED1;
        var led2Status = snapshot.val().LED2;
        var led3Status = snapshot.val().LED3;
        var led4Status = snapshot.val().LED4;

        updateToggleSwitch("led1", led1Status);
        updateToggleSwitch("led2", led2Status);
        updateToggleSwitch("led3", led3Status);
        updateToggleSwitch("led4", led4Status);

        updateLEDStatus("statusLED1", "LED1", led1Status);
        updateLEDStatus("statusLED2", "LED2", led2Status);
        updateLEDStatus("statusLED3", "LED3", led3Status);
        updateLEDStatus("statusLED4", "LED4", led4Status);
    });

    // Function to update toggle switch based on LED status
    function updateToggleSwitch(led, status) {
        var toggleSwitch = document.getElementById(led);
        toggleSwitch.checked = (status === 1); // Convert 1 to true, 0 to false
    }

    // Function to update LED status text
    function updateLEDStatus(elementId, ledName, status) {
        var statusText = document.getElementById(elementId);
        statusText.textContent = ledName + " is " + (status ? "ON" : "OFF");
    }
