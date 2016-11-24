<?php

session_start();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<h1>Anagram</h1>
<form method="post" >

Słowo dodane:<br/> <input type="text" autofocus name="dodaj"/>
<input type="submit" value="dodaj">
</form>

<form  method="post" >

Słowo usunięte:<br/> <input type="text" name="usun"/>
<input type="submit" value="usuń">
</form>



<?php
require_once "connect.php";

if(isset($_POST['dodaj']))
{
	$dodawane=$_POST['dodaj'];
	//$a=strlen($dodawane);
	$nick=$_SESSION['nick'];
	if(!empty($dodawane))
	{
		try
			{
					$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
					mysqli_set_charset($polaczenie, "utf8");
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						
							$rezultat=$polaczenie->query("SELECT slowo FROM slownikgracza WHERE slowo='$dodawane' AND nick='$nick'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
								echo'<span style="color:blue;">Słowo jest już w słowniku</span>';
							else
								{
									if($polaczenie->query("INSERT INTO slownikgracza VALUES('$nick','$dodawane')"))
									{
										echo'<span style="color:blue;">Dodałeś słowo</span>';
									}
									else
									{
										throw new Exception($polaczenie->error);
									}
								}
						
					}
						//$polaczenie->close();
			}


			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera</span>';
			}
	}
}

if(isset($_POST['usun']))
{
	$usun=$_POST['usun'];
	$nick=$_SESSION['nick'];
	try
			{
					$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
					mysqli_set_charset($polaczenie, "utf8");
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						
						
						$rezultat=$polaczenie->query("SELECT slowo FROM slownikgracza WHERE slowo='$usun' AND nick='$nick'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
							
								{
									if($polaczenie->query("DELETE FROM slownikgracza WHERE slowo='$usun' AND nick='$nick'"))
									{
										echo'<span style="color:blue;">Usunąłeś słowo</span>';
									}
									else
									{
										throw new Exception($polaczenie->error);
									}
								}
								
							else
								echo'<span style="color:blue;">Słownik nie zawiera podanego słowa</span>';
						
					}
			}
	catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera</span>';
			}
}	
?>
<p><p>
<a href="panel.php"  >Koniec wprowadzania update'u</a>
</body>
</html>