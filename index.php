<?php


require_once __DIR__ . '/bdd.php';





// include "get_genre.php";
include "get_movie.php";
include "get_member.php";
include "date.php";

$conn = connecterBDD();


?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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

<section class="film">
    
    <form action="./index.php" method="post" class="box"> 
        <label> <b>Veuillez choisir</b> : </label>
            <input type="text" name="searchmovie" placeholder="Nom du Film">
        
            <input type="text" name="searchdistrib" placeholder="Nom du Distributeur">
        
            <select class="option" name="column">
                <?php
                $result = get_genre();
                $selectgenre = "Genre";
                foreach($result as $row) {
                    // echo"<option value $selectgenre> </option>";
                    echo "<option value=".$row['name'].">".$row['name']." </option>";
            } 
        ?>
        
            </select>
            <button type="submit" name="submit" value="Search" >Search</button>
            
            <?php
            
            $get_movie = get_movie();
            
            ?>
    </form> 
</section>


<section class="date">

<form action="./index.php" method="post">
        <label for="date"><b>Date</b> : </label>
        <input type="date" id="date" name="date"/>
        <button type="submit" name="submit" value="Search">Search</button>
            <?php
            get_date();
            ?>
    </form>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>let table = new DataTable('#tables');</script>
</body>
</html>




