<?php
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD", "root");
define("DB_NAME","db_university");
define("DB_PORT",3306); // la porta di MySQL, la vedi nelle preferences -> port

// di solito in produzione non si entra con utente root ma con un utente con permessi più ristretti

// COONNECTION
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

//var_dump($conn);


//CHECK CONNECTION
if ($conn && $conn->connect_error) {
  echo "Connection failed: " . $conn->connect_error;
  die();
}
?>