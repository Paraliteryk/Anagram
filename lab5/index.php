<?php

session_start();
/*if(isset($_SESSION['zalogowany'])) //jezeli istnieje zmienna
	{	
		header('Location:panel.php');
		exit();
	}*/
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
<form action="zaloguj.php" method="post" >

Login:<br/> <input type="text" name="login"/> <br/>
Hasło:<br/> <input type="password" name="haslo"/> <br/><br/>
<input type="submit" value="zaloguj się">

</form>

<?php

	echo '<p><p><a href="rejestracja.php">Nie masz konta? Zarejestruj się!</a>';
	
	if(isset($_SESSION['blad'])) //jezeli istnieje zmienna
	{
		echo $_SESSION['blad'];
		unset($_SESSION['blad']);
	}	
	if(isset($_SESSION['zarejestrowany']))
{
	echo "<p> ".$_SESSION['zarejestrowany']."</p>";
	unset($_SESSION['zarejestrowany']);
}	
	

?>

</body>
</html>