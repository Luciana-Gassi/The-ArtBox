<?php
    require 'dbconnection.php';
    require 'includes/header.php';

// Check if an error parameter is present in the URL
if(isset($_GET['error'])) {
    $error = $_GET['error'];
    // Display a message based on the error parameter
    if($error === 'not_found') {
        echo "<p>Artwork not found.</p>";
    }
}

    $query = "SELECT * FROM oeuvres";
    $result = mysqli_query($connectDB, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($connectDB));
    }
    
    $oeuvres = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    
    <div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['ID'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'includes/footer.php'; ?>
