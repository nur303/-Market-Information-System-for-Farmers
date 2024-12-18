<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FarmerConnect";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection) {
    echo" okk";
} 
else{
    echo "Fuck";
}
?>
