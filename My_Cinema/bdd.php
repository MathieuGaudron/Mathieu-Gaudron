<?php
function connecterBDD() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=cinema", "PONCH", "Chanel75013.", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode=""') );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}


function executerRequete($conn, $sql) {
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    } catch(PDOException $e) {
        die("Erreur d'exécution de requête : " . $e->getMessage());
    }
}

?>