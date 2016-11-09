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

Słowo dodane:<br/> <input type="text" name="dodaj"/>
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
	$a=strlen($dodawane);

	if(!empty($dodawane))
	{
		try
			{
					$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						if($a==5)
						{
							$rezultat=$polaczenie->query("SELECT id FROM slownik5 WHERE slowo='$dodawane'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
								echo'<span style="color:blue;">Słowo jest już w słowniku</span>';
							else
								{
									if($polaczenie->query("INSERT INTO slownik5 (`slowo`) VALUES('$dodawane')"))
									{
										echo'<span style="color:blue;">Dodałeś słowo</span>';
									}
									else
									{
										throw new Exception($polaczenie->error);
									}
								}
						}
						
						if($a==6)
						{
							$rezultat=$polaczenie->query("SELECT id FROM slownik6 WHERE slowo='$dodawane'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
								echo'<span style="color:blue;">Słowo jest już w słowniku</span>';
							else
								{
									if($polaczenie->query("INSERT INTO slownik6 (`slowo`) VALUES('$dodawane')"))
									{
										echo'<span style="color:blue;">Dodałeś słowo </span>';
									}
									else
									{
										throw new Exception($polaczenie->error);
									}
								}
						}
						
						if($a==7)
						{
							$rezultat=$polaczenie->query("SELECT id FROM slownik7 WHERE slowo='$dodawane'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
								echo'<span style="color:blue;">Słowo jest już w słowniku</span>';
							else
								{
									if($polaczenie->query("INSERT INTO slownik7 (`slowo`) VALUES('$dodawane')"))
									{
										echo'<span style="color:blue;">Dodałeś słowo </span>';
									}
									else
									{
										throw new Exception($polaczenie->error);
									}
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
	$b=strlen($usun);
	try
			{
					$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						if($b==5)
						{
						$rezultat=$polaczenie->query("SELECT id FROM slownik5 WHERE slowo='$usun'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
							
								{
									if($polaczenie->query("DELETE FROM slownik5 WHERE slowo='$usun'"))
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
						
						if($b==6)
						{
						$rezultat=$polaczenie->query("SELECT id FROM slownik6 WHERE slowo='$usun'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
							
								{
									if($polaczenie->query("DELETE FROM slownik6 WHERE slowo='$usun'"))
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
						
						if($b==7)
						{
						$rezultat=$polaczenie->query("SELECT id FROM slownik7 WHERE slowo='$usun'");
							$ilosc=$rezultat->num_rows;
							if( $ilosc>0)
							
								{
									if($polaczenie->query("DELETE FROM slownik7 WHERE slowo='$usun'"))
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