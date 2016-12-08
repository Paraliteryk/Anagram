<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head >
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>

</head>
<h1>Ranking</h1>



 <div class="rank">
 <b>Poziom TRUDNY</b>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=7 ORDER BY punkty DESC, czas");
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
</div>



<div class="rank">
 <b>Poziom ŚREDNI</b>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=6 ORDER BY punkty DESC, czas");
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
</div>


<div class="rank">
 <b>Poziom ŁATWY</b>
<table>
<thead><tr>
<th colspan="2"></th>
<th>PUNKTY</th>
<th>CZAS</th>
</tr></thead><tbody>

<?php
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$rezultat=$polaczenie->query("SELECT * FROM ranking WHERE poziom=5 ORDER BY punkty DESC, czas");
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
</div>
<div style="clear:both;"></div>

<a href="panel.php"  >Wróć na stronę główną</a>
</body>
</html>
