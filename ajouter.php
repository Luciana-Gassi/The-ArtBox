<?php
require 'includes/header.php';
?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : ''; ?>">
        <?php if (isset($_GET['errors']) && strpos($_GET['errors'], 'titre') !== false): ?>
            <span class="error">Le titre de l'œuvre est requis.</span>
        <?php endif;?>
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" value="<?php echo isset($_POST['artiste']) ? $_POST['artiste'] : ''; ?>">
        <?php if (isset($_GET['errors']) && strpos($_GET['errors'], 'artiste') !== false): ?>
            <span class="error">L'auteur de l'œuvre est requis.</span>
        <?php endif;?>
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" value="<?php echo isset($_POST['image']) ? $_POST['image'] : ''; ?>">
        <?php if (isset($_GET['errors']) && strpos($_GET['errors'], 'image') !== false): ?>
            <span class="error">Le lien vers l'image doit avoir le format attendu (https://...).</span>
        <?php endif;?>
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
        <?php if (isset($_GET['errors']) && strpos($_GET['errors'], 'description') !== false): ?>
            <span class="error">La description doit faire au moins 3 caractères.</span>
        <?php endif;?>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'includes/footer.php'; ?>
