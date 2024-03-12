<?php
require 'dbconnection.php';

$errors = [];

// Pour le titre
if (empty($_POST['titre'])) {
    $errors[] = "titre";
}

// Pour l'artiste
if (empty($_POST['artiste'])) {
    $errors[] = "artiste";
}

// Pour la description
if (strlen($_POST['description']) < 3) {
    $errors[] = "description";
}

// Pour l'image
if (!filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    $errors[] = "image";
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
        $query = "SELECT * FROM oeuvres WHERE id = $new_id"; // You should use id instead of titre and artiste

        header("Location: oeuvre.php?id=$new_id");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'œuvre: " . mysqli_error($connectDB);
    }
} else {
    // si erreur, redirectionner au formulaire avec les erreurs
    header('Location: ajouter.php?errors=' . urlencode(implode(',', $errors)));
}
