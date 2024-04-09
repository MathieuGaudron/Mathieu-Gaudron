<?php

include_once 'bdd.php';
include 'get_genre.php';


function get_movie() {

if(!empty($_POST['searchmovie']) || !empty($_POST['searchdistrib']) || !empty($_POST['column'])) {
 

    $moviename = htmlspecialchars($_POST['searchmovie']);
    $distributeur = htmlspecialchars($_POST['searchdistrib']);
    $genre = htmlspecialchars($_POST['column']);
 

    
    $conn = connecterBDD();



    $sql = "SELECT mo.title, di.name, ge.name AS genre_name
            FROM movie mo 
            INNER JOIN distributor di ON mo.id_distributor = di.id
            INNER JOIN movie_genre mg ON mo.id = mg.id_movie
            INNER JOIN genre ge ON mg.id_genre = ge.id
            WHERE title LIKE '%$moviename%'
            AND di.name LIKE '%$distributeur%'
            AND ge.name LIKE '%$genre%'";

    
    $stmt = executerRequete($conn, $sql);

    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<br></br>";

    if(!empty($result)) {
        echo "<table class='table table-striped' id='tables'>
              <thead>
              <tr>
                  <th>Titre</th>
                  <th>Distributeur</th>
                  <th>Genre</th>
              </tr>
              </thead>
              <tbody>";

        foreach($result as $row) {
            echo "<tr>
                  <td>{$row['title']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['genre_name']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo '<p style="color:red;">Film introuvable, désolé !</p>';
    }
}

    
}

