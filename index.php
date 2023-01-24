<?php

session_start();
//jeśli jesteś już zalogowany przeniesienie na stronę
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: strona.php');
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

Logowanie <br /> <br />

   <form action="logging.php" method="post">

      Login: <br /> <input type="text" name="login" />  <br />
      Hasło: <br /> <input type="password" name="haslo" />  <br /> <br />
       <input type="submit" value="Zaloguj się"/>

      </form>

<?php
//błąd logowania
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>

</body>
</html>