<?php

include_once 'bdd.php';

function get_genre() {
    
    $conn = connecterBDD();


    $sql = "SELECT id, name FROM genre";

    
    $stmt = executerRequete($conn, $sql);

    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;


    }
