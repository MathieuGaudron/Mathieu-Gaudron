<?php

include_once "bdd.php";

function get_member() {
    if(!empty($_POST['searchmember'])) {
        $searchmember = '%' . htmlspecialchars($_POST['searchmember']) . '%';

        $conn = connecterBDD();

        $sql = "SELECT firstname, lastname FROM user 
                WHERE firstname LIKE :searchmember
                OR lastname LIKE :searchmember";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':searchmember', $searchmember, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($result)){
            echo "<br></br>";
            echo '<br><p style="color:red;">Utilisateur Introuvable !</p>'; 
        } else {
            echo "<br></br>";
            echo "<table class='table table-striped' id='tables'>
                  <thead>
                  <tr>
                      <th>Firstname</th>
                      <th>Lastname</th>
                  </tr>
                  </thead>
                  <tbody>";

            foreach($result as $row) {
                echo "<tr>
                      <td>{$row['firstname']}</td>
                      <td>{$row['lastname']}</td>
                  </tr>";
            }

            echo "</tbody></table>";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['searchmember']) || empty($_POST['searchmember']))) {
        echo "<br></br>";
        echo '<br><p style="color:red;">Renseignez un utilisateur !</p>';
    }
}

function get_sub() {
    if(!empty($_POST['searchmember'])) {
        $searchmember = '%' . htmlspecialchars($_POST['searchmember']) . '%';

        $conn = connecterBDD();

        $sql = "SELECT user.id, user.firstname, user.lastname, subscription.name, subscription.description, subscription.price, subscription.duration, subscription.reduction
                FROM user
                INNER JOIN membership ON user.id = membership.id_user
                INNER JOIN subscription ON subscription.id = membership.id_subscription
                WHERE user.firstname LIKE :searchmember
                OR user.lastname LIKE :searchmember";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':searchmember', $searchmember, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result)){
            echo "<br></br>";
            echo '<br><p style="color:red;">Utilisateur Introuvable !</p>'; 
        } else {
            echo "<br></br>";
            echo "<table class='table table-striped' id='tables'>
                  <thead>
                  <tr>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Duration</th>
                      <th>Reduction</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>";

            foreach($result as $row) {
                echo "<tr>
                      <td>{$row['firstname']}</td>
                      <td>{$row['lastname']}</td>
                      <td>{$row['name']}</td>
                      <td>{$row['description']}</td>
                      <td>{$row['price']}</td>
                      <td>{$row['duration']}</td>
                      <td>{$row['reduction']}</td>
                      <td><a href='membre.php?id={$row['id']}'>Modifier</a></td>
                      <td><a href='membre.php?id={$row['id']}'>Supprimer</a></td>
                      <td><a href='membre.php?id_member={$row['id']}'>Historique</a></td>
                  </tr>";
            }

            echo "</tbody></table>";
        }
    }
}

function get_historique(int $idmember) {
    $conn = connecterBDD();

    $sql = "SELECT mo.title, ms.date_begin, us.firstname, us.lastname 
            FROM membership_log ml 
            INNER JOIN membership m ON ml.id_membership = m.id
            INNER JOIN user us ON us.id = m.id_user
            INNER JOIN movie_schedule ms ON ms.id = ml.id_session      
            INNER JOIN movie mo ON mo.id = ms.id_movie
            WHERE us.id = :idmember";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idmember', $idmember, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<br></br>";
    if (!empty($result)) {
        echo "<table class='table table-striped' id='tables'>
              <thead>
              <tr>
                  <th>Titre</th>
                  <th>Date</th>
              </tr>
              </thead>
              <tbody>";

        foreach($result as $row) {
            echo "<tr>
                  <td>{$row['title']}</td>
                  <td>{$row['date_begin']}</td>
              </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo '<p style="color:red;">Aucun historique pour cet utilisateur.</p>';
    }
}

?>
