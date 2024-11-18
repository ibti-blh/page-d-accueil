<?php
include "db_conn.php";
if (isset($_POST['submit'])) {
   // Récupérer les données du formulaire
   $Nom = mysqli_real_escape_string($conn, $_POST['Nom']);
   $Référence = mysqli_real_escape_string($conn, $_POST['Référence']);
   $Catégorie = mysqli_real_escape_string($conn, $_POST['Catégorie']);
   $Description = mysqli_real_escape_string($conn, $_POST['Description']);
   $MarqueFournisseur = mysqli_real_escape_string($conn, $_POST['MarqueFournisseur']);
   $Quantité = (int)$_POST['Quantité']; // Conversion en entier
   $Prix = (float)$_POST['Prix']; // Conversion en nombre flottant
   $DateExp = $_POST['DateExp'];

   // Afficher les valeurs pour vérifier qu'elles sont récupérées correctement
   var_dump($Nom, $Référence, $Catégorie, $Description, $MarqueFournisseur, $Quantité, $Prix, $DateExp);
      
        $sql ="INSERT INTO `crud`(`id`, `prénom`, `nom`, `email`, `tel`, `sexe`) VALUES (NULL,'$prénom','$nom','$email','$tel','$sexe')";
      
       
      

    // Afficher les valeurs pour vérifier qu'elles sont récupérées correctement
    var_dump($Nom, $Référence, $Catégorie, $Description, $MarqueFournisseur, $Quantité, $Prix, $DateExp);

    // Préparer la requête SQL
    $sql = "INSERT INTO crud (Nom, Référence, Catégorie, Description, MarqueFournisseur, Quantité, Prix, DateExp)
            VALUES ('$Nom', '$Référence', '$Catégorie', '$Description', '$MarqueFournisseur', '$Quantité', '$Prix', '$DateExp')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Nouvel enregistrement créé avec succès");
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>






<!DOCTYPE html>
<html>
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
          <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header class="header fixed-top">
    <div class="h-bar">
      <div class="logo">
        <img src="./images/tooth.png" alt="Logo">
        <a href="index.php" style="text-decoration:none;"><h1>Cabinet<span class="highlight">Plus</span></h1></a>
      </div>
      <nav class="nav-q">
        <a href="#">Accueil</a>
        <a href="#">Patients</a>
        <a href="#">Prothèses</a>
        <a href="#">Calendrier</a>
        <div class="dropdown">
          <a href="#suivre" class="suivre" aria-haspopup="true">Suivre</a>
          <ul class="suivre-menu">
            <li><a href="#suivi-produits">Suivi des Produits</a></li>
            <li><a href="#suivi-achats">Suivi des Achats</a></li>
            <li><a href="#suivi-protheses">Suivi des Prothèses</a></li>
          </ul>
        </div>
      </nav>
      <button class="profile-circle">Connexion</button>

    </div>
  </header>
<main>
  <div class="side-nav">
    <div class="user">
      <img src="images/midune.jpg" class="user-img">
      <div>
        <h2>midune</h2>
        <p>midune@gmail.com</p>
        </div>
    </div>
    <ul>
      <a href="index.php"><li><img src="image/dashboard.png">
        <p>Dashboard</p>
      </li></a>
      <a href="#"><li><img src="image/members.png">
        <p>Page de clients</p>
      </li></a>
      <a href="#"><li><img src="image/rewards.png">
        <p>Pages de produits</p>
      </li></a>
      <a href="#"><li><img src="image/projects.png">
        <p>Bon d'achat</p>
      </li></a>
      <a href="#"><li><img src="image/setting.png">
        <p>Fournisseur</p>
      </li></a>
    </ul>

    <ul>
      <li><img src="image/logout.png">
        <p>Deconnexion</p>
      </li>
    </ul>
  </div>
   
    <!-- Form Section -->
    <div class="container">
        <div class="text-center mb-4">
            <h3>Ajouter un nouveau Produit</h3>
            <p class="text-muted">Saisissez le formulaire ci-dessous pour ajouter un nouveau produit</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
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
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="submit" style="background-color: blue;">Sauvegarder</button>
                    <a href="index.php" class="btn btn-danger">Annuler</a>
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
</html>