<?php

include_once 'bdd.php';


function get_date() {

$conn = connecterBDD();
if(isset($_POST['date']) && !empty($_POST['date'])) {
    
    $date = htmlspecialchars($_POST['date']);


    $sql = "SELECT movie.title, date_begin
            FROM movie
            INNER JOIN movie_schedule
            ON movie.id = movie_schedule.id_movie
            WHERE date_begin LIKE '%$date%'";


$stmt = executerRequete($conn, $sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
        $data .= "<br><b>Titre : </b>". $row['title'];
    }

    echo $data; 


    


}
}



?>