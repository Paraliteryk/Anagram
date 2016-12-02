<?php

	session_start();
	unset($_SESSION['wyswietl']);
	unset($_SESSION['poprawnepl']);
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

<div id="menu">
 <div class="option"><a href="update.php" style="color:#ffffff" >Wprowadź zmiany do słownika</a> </div>
 <div class="option">Przeglądaj słownik </div>
 <div class="option">Przeglądaj ranking </div>
 <div class="option"><a href="zmiania.php" style="color:#ffffff" >Zmień dane</a> </div> 
 <div class="option"><a href="index.php" style="color:#ffffff" >Wyloguj się</a></div>
 <div style="clear:both;"></div>
 </div>

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
<a href="update.php"  >Wprowadź zmiany do swojego słownika</a>
 </div>
 
 
 
  <?php

		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");

		?>
 <div id="najlepsi">
 

 <h3 >TOP 5 - poziom trudny</h3>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php

		$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=7 ORDER BY punkty DESC, czas LIMIT 5 ");
		$a=1;
		while($r = $rezultat->fetch_assoc()) { 
		?>
        <tr><td >
		<?php 
		
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$a.'.</b> </span>');
			else
				echo "<b>".$a.".</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['nick'].'</b> </span>');
			else
				echo "<b>".$r['nick']."</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['punkty'].'</b> </span>');
			else
				echo "<b>".$r['punkty']."</b>";

		?>
		</td>
		
		<td >
		<?php 
		$minuta=0;
		$sekunda=$r['czas'];
			while($sekunda>60)
			{
				$minuta=$minuta+1;
				$sekunda=$sekunda-60;
				
			}
			if($a==1)
			{
				if($sekunda<10 && $minuta<10)
				$czas="0".$minuta.":0".$sekunda;
			else if($minuta<10)
				$czas="0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				$czas="".$minuta.":0".$sekunda;
			else
				$czas="$minuta : $sekunda";
			echo ('<b> <span style="color:#cc9900;">'.$czas.'</b> </span>');
			}
				
			else
			{
				if($sekunda<10 && $minuta<10)
				echo"0".$minuta.":0".$sekunda;
			else if($minuta<10)
				echo"0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				echo"".$minuta.":0".$sekunda;
			else
				echo "$minuta : $sekunda";
			}
		?>
		</td></tr>
	<?php
		$a=$a+1;
		echo "<p><p>";
		}
?>

</tr>
</tbody></table>

 <h3 >TOP 5 - poziom średni</h3>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php

		$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=6 ORDER BY punkty DESC, czas LIMIT 5 ");
		$a=1;
		while($r = $rezultat->fetch_assoc()) { 
		?>
        <tr><td >
		<?php 
		
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$a.'.</b> </span>');
			else
				echo "<b>".$a.".</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['nick'].'</b> </span>');
			else
				echo "<b>".$r['nick']."</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['punkty'].'</b> </span>');
			else
				echo "<b>".$r['punkty']."</b>";

		?>
		</td>
		
		<td >
		<?php 
		$minuta=0;
		$sekunda=$r['czas'];
			while($sekunda>60)
			{
				$minuta=$minuta+1;
				$sekunda=$sekunda-60;
				
			}
			if($a==1)
			{
				if($sekunda<10 && $minuta<10)
				$czas="0".$minuta.":0".$sekunda;
			else if($minuta<10)
				$czas="0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				$czas="".$minuta.":0".$sekunda;
			else
				$czas="$minuta : $sekunda";
			echo ('<b> <span style="color:#cc9900;">'.$czas.'</b> </span>');
			}
				
			else
			{
				if($sekunda<10 && $minuta<10)
				echo"0".$minuta.":0".$sekunda;
			else if($minuta<10)
				echo"0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				echo"".$minuta.":0".$sekunda;
			else
				echo "$minuta : $sekunda";
			}
		?>
		</td></tr>
	<?php
		$a=$a+1;
		echo "<p><p>";
		}
?>

</tr>
</tbody></table>


 <h3 >TOP 5 - poziom łatwy</h3>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php
$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=5 ORDER BY punkty DESC, czas LIMIT 5 ");
		$a=1;
		while($r = $rezultat->fetch_assoc()) { 
		?>
        <tr><td >
		<?php 
		
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$a.'.</b> </span>');
			else
				echo "<b>".$a.".</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['nick'].'</b> </span>');
			else
				echo "<b>".$r['nick']."</b>";
		?>
		</td>
		
		<td >
		<?php 
			if($a==1)
				echo ('<b> <span style="color:#cc9900;">'.$r['punkty'].'</b> </span>');
			else
				echo "<b>".$r['punkty']."</b>";

		?>
		</td>
		
		<td >
		<?php 
		$minuta=0;
		$sekunda=$r['czas'];
			while($sekunda>60)
			{
				$minuta=$minuta+1;
				$sekunda=$sekunda-60;
				
			}
			if($a==1)
			{
				if($sekunda<10 && $minuta<10)
				$czas="0".$minuta.":0".$sekunda;
			else if($minuta<10)
				$czas="0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				$czas="".$minuta.":0".$sekunda;
			else
				$czas="$minuta : $sekunda";
			echo ('<b> <span style="color:#cc9900;">'.$czas.'</b> </span>');
			}
				
			else
			{
				if($sekunda<10 && $minuta<10)
				echo"0".$minuta.":0".$sekunda;
			else if($minuta<10)
				echo"0".$minuta.":".$sekunda;
			else if( $sekunda<10)
				echo"".$minuta.":0".$sekunda;
			else
				echo "$minuta : $sekunda";
			}
		?>
		</td></tr>
	<?php
		$a=$a+1;
		echo "<p><p>";
		}
?>

</tr>
</tbody></table></div>

 </div>

 
 <p>
 
 <div id="wynik">
  <?php
  if(isset($_SESSION['wynik']))
	{
		echo $_SESSION['wynik'];
		unset($_SESSION['wynik']);
	}	
	?>
  <p> <p>
 </div>	
 
 <div id="trening">
 
<form action="panel2.php">
  <input type="submit" value="trening">
  </form>
 
 </div>

 
 <div id="gra">
 

  <input type="submit" value="gra rankingowa" onClick="document.getElementById('poziom').style.display='block';">
	<div style="display: none" id="poziom">
 
   <form action="gra.php" method="post">
   <br/> <b>poziom</b> : <input type="radio"  name="liczba" value="5" /> łatwy <input type="radio"  name="liczba" value="6" checked="checked" /> średni <input type="radio"  name="liczba" value="7"  /> trudny
<input type="submit"  value="ok">
	 </form>
</div>
 
 </div>

 

 
 

<?php
 if(isset($_SESSION['zmieniono']))
	{
		echo $_SESSION['zmieniono'];
		unset($_SESSION['zmieniono']);
	}
	
	
?>
</body>
</html>
 
