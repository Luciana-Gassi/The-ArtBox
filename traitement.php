<?php
require 'dbconnection.php';

// Pour le form
if (isset($_POST['submit'])) {
    $errors[] = "Le formulaire n'a pas pu être envoyé.";
}

// Pour le titre
if (empty($_POST['titre'])) {
    $errors[] = "Le titre de l'œuvre est requis.";
}

// Pour l'artiste
if (empty($_POST['artiste'])) {
    $errors[] = "L'auteur de l'œuvre est requis.";
}

// Pour la description
if (strlen($_POST['description']) < 3) {
    $errors[] = "La description doit faire au moins 3 caractères.";
}

// Pour l'image
if (!filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    $errors[] = "Le lien vers l'image doit avoir le format attendu (https://...).";
}

// Si aucune erreur, on ajoute l'oeuvre
if (empty($errors)) {
    // prevenir les injections SQL
    $titre = mysqli_real_escape_string($connectDB, $_POST['titre']);
    $artiste = mysqli_real_escape_string($connectDB, $_POST['artiste']);
    $description = mysqli_real_escape_string($connectDB, $_POST['description']);
    $image = mysqli_real_escape_string($connectDB, $_POST['image']);

    // ajouter l'oeuvre à la BDD
    $query = "INSERT INTO oeuvres (titre, artiste, description, image) VALUES ('$titre', '$artiste', '$description', '$image')";
    $result = mysqli_query($connectDB, $query);

    if ($result) {
        // retrouver l'id de l'oeuvre ajoutee pour redirectionner
        $new_id = mysqli_insert_id($connectDB);
        $query = "SELECT * FROM oeuvres WHERE titre = $titre AND artiste = $artiste";
        
        header("Location: oeuvre.php?id=$new_id");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'œuvre: " . mysqli_error($connectDB);
    }
} else {
    // si erreur, redirectionner au formulaire
    header('Location: ajouter.php?errors=' . urlencode(implode('<br>', $errors)));
}

require 'includes/footer.php';
