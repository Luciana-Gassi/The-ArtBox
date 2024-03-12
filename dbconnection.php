<?php

// Connection a la base de données
$connectDB = mysqli_connect("localhost", "root", "", "artbox");

// Verification de la connection
if (!$connectDB) {
    die("Connection failed: " . mysqli_connect_error());
}
