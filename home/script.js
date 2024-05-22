  var firebaseConfig = {
        apiKey: "AIzaSyASlxbE-mAJpeIf4Lv3BRCYQjCZ-zH5H-Y",
        authDomain: "yarana-smart-home.firebaseapp.com",
        projectId: "yarana-smart-home",
        storageBucket: "yarana-smart-home.appspot.com",
        messagingSenderId: "304442933421",
        appId: "1:304442933421:web:bc8c5472cdba380a7fc624",
        measurementId: "G-421VM0K8YG"
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