<?php
$prenom = '';
$nom = '';
$email = '';
$age = '';
$filiere = '';
$motivation = '';
$reglement = false;

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom = $_POST['prenom'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $filiere = $_POST['filiere'] ?? '';
    $motivation = $_POST['motivation'] ?? '';
    $reglement = isset($_POST['reglement']);

    // VALIDATION

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide.";
    }

    if (!is_numeric($age) || $age < 16 || $age > 30) {
        $erreurs[] = "L'âge doit être un nombre entre 16 et 30.";
    }

    if (empty($filiere)) {
        $erreurs[] = "Veuillez choisir une filière.";
    }

    if (strlen($motivation) < 30) {
        $erreurs[] = "La motivation doit contenir au moins 30 caractères.";
    }

    // ✅ BONUS B1
    if (strlen($motivation) > 300) {
        $erreurs[] = "La motivation ne doit pas dépasser 300 caractères.";
    }

    if (!$reglement) {
        $erreurs[] = "Vous devez accepter le règlement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidature</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (empty($erreurs) && $_SERVER['REQUEST_METHOD'] === 'POST') : ?>

    <h1>Candidature reçue !</h1>

    <p><strong>Prénom :</strong> <?php echo $prenom; ?></p>
    <p><strong>Nom :</strong> <?php echo $nom; ?></p>
    <p><strong>Email :</strong> <?php echo $email; ?></p>
    <p><strong>Âge :</strong> <?php echo $age; ?></p>
    <p><strong>Filière :</strong> <?php echo $filiere; ?></p>

    <p><strong>Motivation :</strong></p>
    <p><?php echo nl2br($motivation); ?></p>

    <p><em>Votre candidature a bien été enregistrée. Nous vous contacterons à l'adresse indiquée.</em></p>

    <a href="candidature.php">Soumettre une nouvelle candidature</a>

<?php else : ?>

    <h1>Formulaire de candidature</h1>

    <?php if (!empty($erreurs)) : ?>
        <ul class="erreurs">
            <?php foreach ($erreurs as $e) : ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="candidature.php" method="POST">

        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom; ?>">

        <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom; ?>">

        <input type="email" name="email" placeholder="Adresse email" value="<?php echo $email; ?>">

        <input type="number" name="age" placeholder="Âge" value="<?php echo $age; ?>">

        <select name="filiere">
            <option value="">-- Choisir --</option>
            <option value="Informatique" <?php echo ($filiere === 'Informatique') ? 'selected' : ''; ?>>Informatique</option>
            <option value="Electronique" <?php echo ($filiere === 'Electronique') ? 'selected' : ''; ?>>Electronique</option>
            <option value="Mecanique" <?php echo ($filiere === 'Mecanique') ? 'selected' : ''; ?>>Mecanique</option>
            <option value="Autre" <?php echo ($filiere === 'Autre') ? 'selected' : ''; ?>>Autre</option>
        </select>

        <textarea name="motivation" rows="6" placeholder="Lettre de motivation"><?php echo $motivation; ?></textarea>

        <!-- ✅ Compteur -->
        <p><?php echo strlen($motivation); ?> / 300 caractères</p>

        <label>
            <input type="checkbox" name="reglement" value="1" <?php echo $reglement ? 'checked' : ''; ?>>
            J'ai lu et j'accepte le règlement du club.
        </label>

        <button type="submit">Envoyer ma candidature</button>

    </form>

<?php endif; ?>

</body>
</html>