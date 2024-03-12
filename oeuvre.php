<?php
    require 'dbconnection.php';
    require 'includes/header.php';
 
// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if(empty($_GET['id'])) {
    header('Location: index.php');
}

// Retrieve the ID parameter from the URL
$id = mysqli_real_escape_string($connectDB, $_GET['id']);

// Fetching data for the specific artwork
$query = "SELECT * FROM oeuvres WHERE id = $id";
$result = mysqli_query($connectDB, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connectDB));
}

$oeuvre = mysqli_fetch_assoc($result);

// Si aucune oeuvre trouvée, on redirige vers la page d'accueil
if(!$oeuvre) {
    header('Location: index.php?error=not_found');
    exit();
}

?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'includes/footer.php'; ?>
