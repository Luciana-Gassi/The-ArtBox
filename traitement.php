<?php
require 'dbconnection.php';

// Pour le form
if(isset($_POST['submit'])) {
    $errors = [];

    // Pour le titre
    if(empty($_POST['titre'])) {
        $errors[] = "Le titre de l'œuvre est requis.";
    }

    // Pour l'artiste
    if(empty($_POST['artiste'])) {
        $errors[] = "L'auteur de l'œuvre est requis.";
    }

    // Pour la description
    if(strlen($_POST['description']) < 3) {
        $errors[] = "La description doit faire au moins 3 caractères.";
    }

    // Pour l'image
    if(!filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
        $errors[] = "Le lien vers l'image doit avoir le format attendu (https://...).";
    }

    // If there are no errors
    if(empty($errors)) {
        // prevent injection
        $titre = mysqli_real_escape_string($connectDB, $_POST['titre']);
        $artiste = mysqli_real_escape_string($connectDB, $_POST['artiste']);
        $description = mysqli_real_escape_string($connectDB, $_POST['description']);
        $image = mysqli_real_escape_string($connectDB, $_POST['image']);

        // Insert the data
        $query = "INSERT INTO oeuvres (titre, artiste, description, image) VALUES ('$titre', '$artiste', '$description', '$image')";
        $result = mysqli_query($connectDB, $query);

        if($result) {
            // Get the ID of the new one
            $new_id = mysqli_insert_id($connectDB);
            $query = "SELECT * FROM oeuvres WHERE titre = $titre AND artiste = $artiste";
            // Redirect to the single oeuvre.php page with the new ID
            header("Location: oeuvre.php?id=$new_id");
            exit(); // Stop further execution
        } else {
            echo "Erreur lors de l'ajout de l'œuvre: " . mysqli_error($connectDB);
        }
    } else {
        // Redirect back to the form page with errors
        header('Location: ajouter.php?errors=' . urlencode(implode('<br>', $errors)));
    }
}

require 'includes/footer.php';
?>
