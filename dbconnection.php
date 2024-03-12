<?php 

// connection to the database "artbox"
$connectDB = mysqli_connect("localhost", "root", "", "artbox");

// Verifica della correttezza della connessione
if (!$connectDB) {
    die("Connection failed: " . mysqli_connect_error());
}