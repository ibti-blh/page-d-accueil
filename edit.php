<?php
include "db_conn.php";

$id= $_GET['id'];

if(isset($_POST['submit'])){
    $Nom = mysqli_real_escape_string($conn, $_POST['Nom']);
   $Référence = mysqli_real_escape_string($conn, $_POST['Référence']);
   $Catégorie = mysqli_real_escape_string($conn, $_POST['Catégorie']);
   $Description = mysqli_real_escape_string($conn, $_POST['Description']);
   $MarqueFournisseur = mysqli_real_escape_string($conn, $_POST['MarqueFournisseur']);
   $Quantité = (int)$_POST['Quantité']; // Conversion en entier
   $Prix = (float)$_POST['Prix']; // Conversion en nombre flottant
   $DateExp = $_POST['DateExp'];

  $sql ="UPDATE `crud` SET `Nom`='$Nom', `Référence`='$Référence', `Catégorie`='$Catégorie', `Description`='$Description', `MarqueFournisseur`='$MarqueFournisseur',`Quantité`='$Quantité',`Prix`='$Prix',`DateExp`='$DateExp' WHERE id=$id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Données mises à jour avec succés");
 } else {
    echo "Échoué: " . mysqli_error($conn);
 }
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: blue; color: white;">
        PHP Complete CRUD Application
    </nav>

    <!-- Form Section -->
    <div class="container">
        <div class="text-center mb-4">
            <h3>Modifier les informations du produit</h3>
            <p class="text-muted">Cliquez sur "Mettre à jour" après avoir modifié les informations</p>
        </div>
        
    <?php
    $sql = "SELECT * FROM `crud` WHERE id =$id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="Nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="Nom" name="Nom" 
                        value="<?php echo htmlspecialchars($row['Nom']); ?>" required>

                    </div> 
                    <div class="col">
                        <label for="Référence" class="form-label">Référence :</label>
                        <input type="text" class="form-control" id="Référence" name="Référence" 
                               value="<?php echo htmlspecialchars($row['Référence']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="Catégorie" class="form-label">Catégorie :</label>
                        <input type="text" class="form-control" id="Catégorie" name="Catégorie" 
                               value="<?php echo htmlspecialchars($row['Catégorie']); ?>" required>
                    </div>
                    <div class="col">
                        <label for="Description" class="form-label">Description :</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3" required><?php echo htmlspecialchars($row['Description']); ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="MarqueFournisseur" class="form-label">Marque Fournisseur :</label>
                        <input type="text" class="form-control" id="MarqueFournisseur" name="MarqueFournisseur" 
                               value="<?php echo htmlspecialchars($row['MarqueFournisseur']); ?>" required>
                    </div>
                    <div class="col">
                        <label for="Quantité" class="form-label">Quantité :</label>
                        <input type="number" class="form-control" id="Quantité" name="Quantité" 
                               value="<?php echo htmlspecialchars($row['Quantité']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="Prix" class="form-label">Prix :</label>
                        <input type="number" class="form-control" id="Prix" name="Prix" step="0.01" 
                               value="<?php echo htmlspecialchars($row['Prix']); ?>" required>
                    </div>
                    <div class="col">
                        <label for="DateExp" class="form-label">Date d'Expiration :</label>
                        <input type="date" class="form-control" id="DateExp" name="DateExp" 
                               value="<?php echo htmlspecialchars($row['DateExp']); ?>" required>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="submit">Mettre à jour</button>
                    <a href="index.php" class="btn btn-danger">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
</body>
</html>