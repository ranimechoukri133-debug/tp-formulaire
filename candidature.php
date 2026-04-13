<?php
$prenom = '';
$nom = '';
$email = '';
$age = '';
$filiere = '';
$motivation = '';
$erreurs = [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidature</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Formulaire de candidature</h1>

    <form action="candidature.php" method="POST">

        <input type="text" name="prenom" placeholder="Prénom">

        <input type="text" name="nom" placeholder="Nom">

        <input type="email" name="email" placeholder="Adresse email">

        <input type="number" name="age" placeholder="Âge">

        <select name="filiere">
            <option value="">-- Choisir --</option>
            <option value="Informatique">Informatique</option>
            <option value="Electronique">Electronique</option>
            <option value="Mecanique">Mecanique</option>
            <option value="Autre">Autre</option>
        </select>

        <textarea name="motivation" rows="6" placeholder="Lettre de motivation"></textarea>

        <label>
            <input type="checkbox" name="reglement" value="1">
            J'ai lu et j'accepte le règlement du club.
        </label>

        <button type="submit">Envoyer ma candidature</button>

    </form>

</body>
</html>