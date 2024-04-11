<?php


include 'bdd.php';

include "get_member.php";


function connexion () {

    if (isset($_POST['pseudo']) && isset($_POST['password']))

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    
$conn = connecterBDD();









}


?>