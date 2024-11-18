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
   

  <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8');
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <a href="add_new.php" class="btn btn-dark mb-3"> Ajouter nouveau</a>

    
    <table class="table table-hover text-center">
        <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Référence</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Description</th>
            <th scope="col">Marque/Fournisseur</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>
            <th scope="col">DateExp</th>
            <th scope="col">Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
        include "db_conn.php";
        
        // Utilisation de la requête préparée pour plus de sécurité
        $sql = "SELECT * FROM `crud`";
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Nom'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Référence'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Catégorie'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['MarqueFournisseur'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Quantité'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Prix'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['DateExp'], ENT_QUOTES, 'UTF-8'); ?></td>
                    

                    <td>
                        <a href="edit.php?id=<?php echo $row['ID']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="delete.php?id=<?php echo $row['ID']; ?>" class="link-dark" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='11'>Erreur de la requête: " . mysqli_error($conn) . "</td></tr>";
        }
        ?>
        </tbody>
    </table>
      </div>

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0/Yosjhf5VxqfGgI2T3Ybh+GkJt6+8zFgfYJ9UpqYjzMxBdXquHv8xNjw7" 
            crossorigin="anonymous"></script>
</body>
</html>