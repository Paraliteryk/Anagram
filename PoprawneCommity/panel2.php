<?php

	session_start();
	unset($_SESSION['wyswietl']);
	unset($_SESSION['l']);
	unset($_SESSION['licznik']);
	unset($_SESSION['poczatek']);
	unset($_SESSION['koniec']);
	unset($_SESSION['srodek']);
	unset($_SESSION['dobreodp']);
	unset($_SESSION['licznik']);

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
<div id="gracz">
<?php
echo " Witaj ".$_SESSION['nick'];
echo "<p> Twój ranking: ".$_SESSION['ranking'];
echo "<p> Wygrane: 0";
echo "<p> Przegrane: 0";
echo "<p> Najlepszy wynik: 0 <p>";
?>
<a href="statystyki.php" target="_blank">Zobacz dokładne statystyki</a>
<a href="zmiania.php" >Zmień dane</a>
<a href="index.php" >Wyloguj się</a>
<p><p>
<a href="update.php"  >Wprowadź update do słownika</a>
 </div>
 
 <p>
 

 <div id="trening">
	<form method="post" >	
  <input type="submit" value="trening">
  </form>
  <form action="trening.php" method="post">
<br/> <b>ilość wyrazów w sesji:</b>  <select name="ileliter">
		<option value="5">5</option> 
		<option value="10">10 </option> 
		<option value="15">15</option>
		<option value="20">20</option> 
		<option value="25">25</option> 
		<option value="30">30</option> 
		<option value="40">40</option> 
		<option value="50">50</option> 
		<option value="60">60</option> 
		<option value="80">80</option> 
		<option value="100">100</option>

	</select>
<br/> <b>słowa</b> : <input type="radio"  name="liczba" value="5" /> pięcioliterowe <input type="radio"  name="liczba" value="6" /> sześcioliterowe <input type="radio"  name="liczba" value="7" checked="checked" /> siedmioliterowe
<input type="submit"  value="ok">

<br/><br/><input type="checkbox"  name="twojslownik" value="1">Twój słownik

<br/><br/>Filtry dodatkowe(opcjonalnie):<br/><br/>
<b>zaczynające się od </b> :  <input name="poczatek" style="width: 50px" value="" /><br/><br/>
<b>kończące się na</b> : &nbsp <input name="koniec" style="width: 50px" value="" /><br/><br/>
<b>zawierające cząstkę</b>:  <input name="srodek" style="width: 50px" value="" /><br/> <br/>


</form>


<?php
if(isset($_SESSION['blad'])) //jezeli istnieje zmienna
	{
		echo '<div class="error">'.$_SESSION['blad'].'</div>';
		unset($_SESSION['blad']);
	}	

?>
 </div>
  



</body>
</html>
 
