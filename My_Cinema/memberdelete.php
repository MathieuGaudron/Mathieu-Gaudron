<?php

include 'bdd.php';



function delete() {

$iduser = $_GET['id'];


if (isset($_GET['id'])) {

    $searchmember = htmlspecialchars($_GET['id']);

    $conn = connecterBDD();

    $sql = "DELETE FROM membership WHERE id_user = '%$searchmember%'";






    $stmt = executerRequete($conn, $sql);
        
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


}




}
?>