<?php


include_once 'bdd.php';

function get_date() {
    if(isset($_POST['date']) && !empty($_POST['date'])) {
        $date = '%' . htmlspecialchars($_POST['date']) . '%';

        $conn = connecterBDD();

        $sql = "SELECT movie.title, movie_schedule.date_begin
                FROM movie
                INNER JOIN movie_schedule ON movie.id = movie_schedule.id_movie
                WHERE movie_schedule.date_begin LIKE :date";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result)){
            echo "<br></br>";
            echo '<br><p style="color:red;">Aucun film pour cette date !</p>'; 
        } else {
            echo "<br></br>";
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

        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['date']) || empty($_POST['date']))) {
        echo "<br></br>";
        echo '<br><p style="color:red;">Renseignez une date !</p>';
    }
}

?>
