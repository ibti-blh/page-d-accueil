<?php
include "db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `crud` where id=$id";
$result= mysqli_query($conn,$sql);
if ($result){
  header ("Location: index.php?msg=Enregistrement supprimé avec succés");
}
else {
  echo "Échoué: ". mysqli_error($conn);}
// Fermer la connexion à la base de données
$conn->close();
?>