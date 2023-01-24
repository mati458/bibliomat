<?php 

session_start();
//jeśli nie ustawiono zmiennych loginu lub hasła wróć na stronę główną
if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
	header('Location: index.php');
	exit();
}

require_once "connect.php";
//dane logowania mysql
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
//wyświetlenie błędu połączenia z mysql
if($polaczenie->connect_errno!=0)
	
{
	echo "Error: ".$polaczenie->connect_errno;
}
else
{
      //pobranie loginu i hasła z sql
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];


	$sql = "SELECT * FROM users WHERE login = '$login' AND password = '$haslo'";

	if ($rezultat = @$polaczenie->query($sql))
	{
		$ilu_userow = $rezultat->num_rows;
		     //jeśli jest zalogowany użytkownik
		if ($ilu_userow==1)
		{ 
			echo "$login";
      echo "$haslo";

			$_SESSION['zalogowany'] = true;

			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['użytkownik_id'] = $wiersz['user_id'];
			$_SESSION['user'] = $wiersz['user'];

			unset($_SESSION['blad']);
			$rezultat->free_result();
			header('Location: strona.php');

		}
		else
		//powiadomienie o nieprawidłowym logowaniu
		{  
			$_SESSION['blad'] = '<span style="color:red">Błędna kombinacja loginu i hasła !</span>';
			header('Location: index.php');
		}

	}  

	$polaczenie->close();	  
}

?>