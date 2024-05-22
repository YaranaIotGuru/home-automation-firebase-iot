<?php
session_start(); // Start the session

// Check if user is not logged in, redirect to index.php
if (!isset($_SESSION['user']) || !isset($_SESSION['password'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LED Toggle</title>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
     <link rel="stylesheet" href="style.css">
   <meta property="og:image" content="logo.png" /> <!-- Add your OG image URL here -->
    <link rel="shortcut icon" type="image/png" href="logo.png"/> <!-- Add your favicon image URL here -->
</head>
<body>

<center>
    <h1>Yarana Smart Home</h1>
    
</center>

<!-- Toggle switches for LEDs -->
<div class="checkbox-wrapper">
    <div class="check">
        <input id="led1" type="checkbox" onchange="toggleLED('LED1', this.checked)">
        <label for="led1"></label>
    </div>
 <p id="statusLED1">LED1 is OFF</p>
    <div class="check">
        <input id="led2" type="checkbox" onchange="toggleLED('LED2', this.checked)">
        <label for="led2"></label>
    </div>
    <p id="statusLED2">LED2 is OFF</p>
    <div class="check">
        <input id="led3" type="checkbox" onchange="toggleLED('LED3', this.checked)">
        <label for="led3"></label>
    </div>
     <p id="statusLED3">LED3 is OFF</p>
    <div class="check">
        <input id="led4" type="checkbox" onchange="toggleLED('LED4', this.checked)">
        <label for="led4"></label>
    </div>
     <p id="statusLED4">LED4 is OFF</p>
</div>
 

<div class="youtube-subscriber" style="margin-top: 100px;">
    <div  class="g-ytsubscribe" data-channelid="UColOAMvdtSuwGFHAIF3cnnQ" data-layout="full" data-theme="dark" data-count="default"></div>
 <script src="https://apis.google.com/js/platform.js"></script>

<script src="script.js"></script>
</body>
</html>
