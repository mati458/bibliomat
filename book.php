<?php 

session_start();
//jeśli nie jesteś zalogowany przeniesienie na stronę główną
if(!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
if(!isset($_GET["id"]))
{
     header('Location: index.php');
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
     <hr/>
     <a href="strona.php">Strona główna</a> |
     <a href="borrow.php">Wybierz inną książkę</a>
     <hr/>

     <?php
     require_once "connect.php";
// Create connection
     $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
     if ($polaczenie->connect_error) {
       die("Connection failed: " . $polaczenie->connect_error);
  }

  $id = $_GET["id"];

  $sql = "SELECT book_id, name, author FROM books WHERE book_id = '$id'";
  $result = $polaczenie->query($sql);

  if ($result->num_rows > 0)
  {
  // output data of each row
   while($row = $result->fetch_assoc()) {
    echo '<div id="title">"' . $row['name'] . '"</div>';
    echo "<p>Autor: " . $row["author"] . "</p>";
    echo '<br>';
}
} else {
  echo "0 results";
}


echo '<a href=book.php?id=' . $_GET["id"] . '&borrow=1><p id = "borrow1">wypożycz</p></a>  ';

echo ' <a href=book.php?id=' . $_GET["id"] . '&borrow=-1><p id = "borrow2">anuluj wypożyczenie</p></a>';

echo '<div id="l2">b</div>';

$user_id = $_SESSION['użytkownik_id'];

if(!isset($_GET["borrow"]))
{
     $sql = "SELECT * FROM orders WHERE user_id = '$user_id' AND book_id = '$id'";
     $result = $polaczenie->query($sql);

}

if(isset($_GET["borrow"]))
{
     $gborrow = $_GET["borrow"];

     $sql = "DELETE FROM `orders` WHERE `book_id` = '$id' AND `user_id` = '$user_id'";

     if ($polaczenie->query($sql) === TRUE) {
          ;
     } else {
       echo "Error deleting record: " . $polaczenie->error;
     }

     if($gborrow == 1)
     {
          $sql = "INSERT INTO `orders` (`book_id`, `user_id`, `pickup_date`, `received`) VALUES ('$id', '$user_id', '2023-01-31', '0')";

          if ($polaczenie->query($sql) === TRUE)
          {

          }
          else
          {
            echo "Error: " . $sql . "<br>" . $polaczenie->error;
          }
     }
}

$sql2 = "SELECT * FROM orders WHERE book_id = '$id' AND user_id = '$user_id'";

$result = $polaczenie->query($sql2);

if(mysqli_num_rows($result) == 1)
{
     echo '<script>';
     echo 'document.getElementById("l2").innerHTML = "Książka jest wypożyczona!";';
     echo '</script>';
}
else
{
     echo '<script>';
     echo 'document.getElementById("l2").innerHTML = "";';
     echo '</script>';
}

$polaczenie->close();

?>
</table>
</body>
</html>