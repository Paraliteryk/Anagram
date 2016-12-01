<?php
	session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Anagram - rejestracja</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<h1>Anagram</h1>
<form  method="post">

Login:<br/> <input type="text" name="login"/> <br/>

<?php

	if(isset($_SESSION['zladlugosc']))
	{
			echo '<div class="error">'.$_SESSION['zladlugosc'].'</div>';
			unset($_SESSION['zladlugosc']);
	}
	
	if(isset($_SESSION['zleznaki']))
	{
			echo '<div class="error">'.$_SESSION['zleznaki'].'</div>';
			unset($_SESSION['zleznaki']);
	}
	
?>
Hasło:<br/> <input type="password" name="haslo"/> <br/>
Powtórz hasło:<br/> <input type="password" name="haslo2"/> <br/>

<?php

	if(isset($_SESSION['zlehaslo']))
	{
			echo '<div class="error">'.$_SESSION['zlehaslo'].'</div>';
			unset($_SESSION['zlehaslo']);
	}
?>

E-mail:<br/> <input type="text" name="mail"/> <br/>

<?php

	if(isset($_SESSION['zlymail']))
	{
			echo '<div class="error">'.$_SESSION['zlymail'].'</div>';
			unset($_SESSION['zlymail']);
	}
?>

<br/>
<input type="submit" value="zarejestruj się">
<?php

	if(isset($_SESSION['puste']))
	{
			echo '<div class="error">'.$_SESSION['puste'].'</div>';
			unset($_SESSION['puste']);
	}
?>
</form>
</body>
</html>


<?php
	require_once "connect.php";		
	//sprawdzanie poprawnosci danych wpisanych w formularzu
	if(isset($_POST['mail']))
	{
		$zarejestrowano=true;
		$login=$_POST['login'];
		if(strlen($login)>20)		//sprawdzamy dlugosc nicka
		{
			$zarejestrowano=false;
			$_SESSION['zladlugosc']="Zbyt długi nick";
		}
		
		if(!ctype_alnum($login))	// funkcja sprawdzajaca czy nie wystepuja znaki inne niz cyfry i litery
		{
			$zarejestrowano=false;
			$_SESSION['zleznaki']="Nick zawiera niedozwolone znaki";
		}
		
		$haslo=$_POST['haslo'];
		$haslo2=$_POST['haslo2'];
		
		if($haslo!=$haslo2)			//sprawdzamy poprawnosc hasla
		{
			$zarejestrowano=false;
			$_SESSION['zlehaslo']="Podane hasła nie są takie same";
		}
		
		if(!ctype_alnum($haslo))
		{
			$zarejestrowano=false;
			$_SESSION['zlehaslo']="Hasło zawiera niedozwolone znaki";
		}
		
		if(strlen($haslo)<8)
		{
			$zarejestrowano=false;
			$_SESSION['zlehaslo']="Hasło jest zbyt krótkie";
		}
		if(strlen($haslo)>25)
		{
			$zarejestrowano=false;
			$_SESSION['zlehaslo']="Hasło jest zbyt długie";
		}
		
		$mail=$_POST['mail'];
		$mailspr=filter_var($mail,FILTER_SANITIZE_EMAIL); 
		if( filter_var($mailspr,FILTER_SANITIZE_EMAIL)==false || $mail!=$mailspr)
		{
			$zarejestrowano=false;
			$_SESSION['zlymail']="Nieprawidłowy adres e-mail";
		}
		
		if(strlen($login)<1 || strlen($haslo)<1 || strlen($haslo2)<1 || strlen($mail)<1)		//sprawdzamy dlugosc nicka
		{
			$zarejestrowano=false;
			$_SESSION['puste']="Wszystkie pola muszą być wypełnione!";
		}
		
		$hash=password_hash($haslo,PASSWORD_DEFAULT);
		
		try
		{
				$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
				if($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$rezultat=$polaczenie->query("SELECT nick FROM gracze WHERE email='$mail'");
					$ilosc=$rezultat->num_rows;
					if( $ilosc>0)
					{
						$zarejestrowano=false;
						$_SESSION['zlymail']="Podany adres e-mail ma już założone konto";
					}
					$rezultat=$polaczenie->query("SELECT nick FROM gracze WHERE nick='$login'");
					$ilosc=$rezultat->num_rows;
					if( $ilosc>0)
					{
						$zarejestrowano=false;
						$_SESSION['zladlugosc']="Istnieje już użytkownik o podanym loginie - wybierz inny";
					}
					if(!$rezultat)
					{
						throw new Exception($polaczenie->error);
					}
					
					if($zarejestrowano)
					{
						
						if($polaczenie->query("INSERT INTO gracze VALUES('$login', '$hash', '$mail', 100)"))
						{
							$_SESSION['zarejestrowany']="Gratulacje, założyłeś konto, teraz możesz się zalogować";
							//$polaczenie->close();
							header('Location:index.php');
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
						echo "Udało się";
						exit();
					}
					$polaczenie->close();
				}

		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera</span>';
		}
		
		
	}

?>

