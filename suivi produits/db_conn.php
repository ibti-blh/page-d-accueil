<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "produit";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
echo "Connexion réussie à la base de données.";
?>
