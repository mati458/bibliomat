<?php 
session_start();
//jeśli nie jesteś zalogowany przeniesienie na stronę główną
if(!isset($_SESSION['zalogowany']))
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
<h1>Bibliomat</h1>

<a href="borrow.php">Wypożycz książkę</a>
          
</body>
</html>