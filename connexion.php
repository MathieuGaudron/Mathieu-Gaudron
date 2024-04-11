<?php


require_once __DIR__ . '/bdd.php';

// include 'get_connexion.php';

$conn = connecterBDD();



?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>My Cinéma</title>
</head>
<body>

<h1 class="text-light">Ciné'Ponch</h1>

<nav>
    <ul>
        <li><a href="./index.php" class="nav">Accueil</a></li>
        <li><a href="./connexion.php" class="nav">Connexion</a></li>
        <li><a href="./membre.php" class="nav">Membres</a></li>
    </ul>
</nav>


<section class="connectsection">

<form action="connexion.php" method="post" class="box1">
    <div class="pseudo">
        <label><b>Nom d'utilisateur </b> : </label>
        <input type="text" name="pseudo" placeholder="Entrez votre nom d'utilisateur">
    </div>
    <div class="password">
        <label><b>Mot de Passe </b> : </label>
        <input type="text" name="password" placeholder="Entrez votre mot de passe">
    </div>
    <button type="submit" name="submit" value="Search">Connexion</button>

</form>

</section>
