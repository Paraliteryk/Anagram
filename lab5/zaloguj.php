<?php

session_start();
if((!isset($_POST['haslo'])) || (!isset($_POST['login'])))
{
	header('Location:index.php');
	exit();
}


require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name); // tworzymy polaczenie wykorzystujac informacje z zainkludowanego connect.php, @ ukrywa szczegoly ewentualnych bledow

if($polaczenie->connect_errno!=0)
{
	echo "Error:".$polaczenie->connect_errno;
}
else
{
	$login = $_POST["login"];
	$haslo = $_POST["haslo"];
	
	$login=htmlentities($login,ENT_QUOTES,"UTF-8");  //zamiana znakow mogacych ingerowac w kod na nieinwazyjne
	if($rezultat=@$polaczenie->query
	(sprintf("SELECT * FROM gracze WHERE nick='%s'"
	,mysqli_real_escape_string($polaczenie,$login)))) //funkcja stworzona do wykrywania prob ingerencji w kod
	{
		$iluuserow=$rezultat->num_rows;
		if($iluuserow>0)
		{
			$wiersz=$rezultat->fetch_assoc();   //rezultat w postaci tablicy asocjacyjnej, gdzie mozemy odwolywac sie do elementow w sposob np. $wiersz['user'] 
			if(password_verify($haslo,$wiersz['haslo']))
			{
				$_SESSION['zalogowany']=true; 
				$_SESSION['ranking']=$wiersz['ranking'];   //globalna tablica asocjacyjna - wartosci z niej widza w trakcie sesji wszystkie pliki php
				$_SESSION['nick']=$wiersz['nick'];
				echo"działa, cześć $login!";
				unset($_SESSION['blad']);
				$rezultat->close();
				header('Location:panel.php');     //przekierowanie z uzyciem naglowka php
			}
			else
			{
				$_SESSION['blad']='<span style="color:red">Nieprawidłowe hasło</span style>';
				echo "nie działa";
				header('Location:index.php');
			}	
					
		}
		else
		{
			$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło</span style>';
			header('Location:index.php');
		}
	}
	
	
	$polaczenie->close();
	

}

 
?>