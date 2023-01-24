<?php 

session_start();
//jeśli nie jesteś zalogowany przeniesienie na stronę główną
if(!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
if(isset($_GET["id"]))
{
     header('Location: book.php?id=' . $_GET["id"]);
     exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
     <link rel="stylesheet" href="style1.css">
     <meta charset="utf-8"/>
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title>Bibliomat</title>

</head>

<body>

     <?php 
//wylogowanie
     echo "<p>Witaj, ".$_SESSION['user'].' <a href = "logout.php">Kliknij tutaj</a> aby się wylogować!</p>';
     ?>


     <h1>Wybierz książkę</h1>
     <hr/>
     <a href="strona.php">Strona główna</a>
     <hr/>
<table>

          <?php
          require_once "connect.php";
// Create connection
          $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
          if ($polaczenie->connect_error) {
             die("Connection failed: " . $polaczenie->connect_error);
        }

        $sql = "SELECT book_id, name, author FROM books";
        $result = $polaczenie->query($sql);

        if ($result->num_rows > 0) {
  // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<tr><td><a href="book.php?id=' . $row['book_id'] . '"><h2>' . $row['name'] . '</h2></td></a>';
                echo "<td><p>" . $row["author"] . "</p></td>";
                echo '</tr><br>';
           }
      } else {
        echo "0 results";
   }
   $polaczenie->close();
   ?>
</table>
</body>
</html>