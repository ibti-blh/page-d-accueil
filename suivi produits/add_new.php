<?php
include "db_conn.php";

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {

    // Récupérer les données du formulaire
    $Nom = mysqli_real_escape_string($conn, $_POST['Nom']);
    $Reference = mysqli_real_escape_string($conn, $_POST['Référence']);
    $Categorie = mysqli_real_escape_string($conn, $_POST['Catégorie']);
    $Description = mysqli_real_escape_string($conn, $_POST['Description']);
    $MarqueFournisseur = mysqli_real_escape_string($conn, $_POST['MarqueFournisseur']);
    $Quantite = mysqli_real_escape_string($conn, $_POST['Quantité']);
    $Prix = mysqli_real_escape_string($conn, $_POST['Prix']);
    $DateExp = mysqli_real_escape_string($conn, $_POST['DateExp']);

    $Photo = $_FILES['Photo']['name']; 
    $Photo_tmp_name = $_FILES['Photo']['tmp_name'];  
    $upload_dir = "uploads/";  

    // Vérifier l'extension du fichier pour s'assurer qu'il s'agit d'une image valide
    $validExtensions = ['jpg', 'jpeg', 'png'];
    $Photo_extension = strtolower(pathinfo($Photo, PATHINFO_EXTENSION));

    if (in_array($Photo_extension, $validExtensions)) {
        // Générer un nouveau nom pour éviter les conflits de noms
        $new_Photo_name = time() . "_" . $Photo;  // Utiliser un timestamp pour le nom

        // Déplacer le fichier du répertoire temporaire vers le dossier final
        if (move_uploaded_file($Photo_tmp_name, $upload_dir . $new_Photo_name)) {
            echo "Fichier téléchargé avec succès.";

            // Préparer la requête SQL pour l'insertion dans la base de données
            $sql = "INSERT INTO crud (Nom, Référence, Catégorie, Description, Marque_Fournisseur, Quantité, Prix, DateExp, Photo)
                    VALUES ('$Nom', '$Reference', '$Categorie', '$Description', '$MarqueFournisseur', '$Quantite', '$Prix', '$DateExp', '$new_Photo_name')";

            // Exécuter la requête SQL
            if (mysqli_query($conn, $sql)) {
                echo "Produit ajouté avec succès.";
                header("Location: index.php?msg=New record created successfully");
                exit();
            } else {
                echo "Erreur lors de l'insertion : " . mysqli_error($conn);
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    } else {
        echo "Extension de fichier non valide. Seuls les fichiers jpg, jpeg et png sont autorisés.";
    }
}

mysqli_close($conn);
?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
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
            <h3>Ajouter un nouveau Produit</h3>
            <p class="text-muted">Saisissez le formulaire ci-dessous pour ajouter un nouveau produit</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="add.php" method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="productName" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="Nom" name="Nom" placeholder="Nom du produit" required>
                    </div> 
                    <div class="col">
                        <label for="reference" class="form-label">Référence:</label>
                        <input type="text" class="form-control" id="Référence" name="Référence" placeholder="Référence" required>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="category" class="form-label">Catégorie:</label>
                        <input type="text" class="form-control" id="Catégorie" name="Catégorie" placeholder="Catégorie" required>
                    </div>
                    <div class="col">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3" placeholder="Description" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="marqueF" class="form-label">Marque Fournisseur:</label>
                        <input type="text" class="form-control" id="MarqueFournisseur" name="MarqueFournisseur" placeholder="Marque Fournisseur" required>
                    </div>
                    <div class="col">
                        <label for="quantity" class="form-label">Quantité:</label>
                        <input type="number" class="form-control" id="Quantité" name="Quantité" placeholder="Quantité" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="price" class="form-label">Prix:</label>
                        <input type="number" class="form-control" id="Prix" name="Prix" placeholder="Prix" step="0.01" required>
                    </div>
                    <div class="col">
                        <label for="date" class="form-label">Date d'Expiration:</label>
                        <input type="date" class="form-control" id="DateExp" name="DateExp" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo:</label>
                    <input type="file" class="form-control" id="Photo" name="Photo" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="submit">Sauvegarder</button>
                    <a href="index.html" class="btn btn-danger">Annuler</a>
                </div>
            </form>
        </div>
    </div>
                    
                    

            



       



</div>
    <!--Bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
     crossorigin="anonymous"></script>

</body>