<?php

session_start();
if(!isset($_SESSION['wyswietl']))
{
	$_SESSION['l']=$_POST['liczba'];
	$_SESSION['max']=20;
	$_SESSION['dobreodp']=0;
	$_SESSION['licznik']=0;
	
		$dzien = date("j");
		$miesiac = date("n");
		$rok =date("Y");
		$godzina = date("G");
		$minuta = date("i");
		$sekunda = date("s");
		$czasp=$sekunda+60*$minuta+3600*$godzina + 86400*$dzien + 2592000*$miesiac + 31536000*$rok;
		$_SESSION['czas']=$czasp;
}

 ?>
<!DOCTYPE HTML>
<html lang="pl">
<head >
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<script type="text/javascript" src="jquery.js"></script>
	
	
	
	
	<script type="text/javascript" src="timer.js">
		
</script>


</head>

<input type="hidden" id="pole" value="" />
<?php

 global $a, $b;
 ?>

		<body onload="odliczanie();">

<h1>Anagram</h1>




<div id="zegar">


 </div>
 
<div id="pojemnik">
	<div id="haslo">
	
	<?php
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		if(!isset($_SESSION['wyswietl']))
		{
			if($_SESSION['l']=="6")
				$rezultat=$polaczenie->query("SELECT * FROM slownik6");
			if($_SESSION['l']=="5")
				$rezultat=$polaczenie->query("SELECT * FROM slownik5");
			if($_SESSION['l']=="7")
				$rezultat=$polaczenie->query("SELECT * FROM slownik7");
			$_SESSION['rozmiar']=$rezultat->num_rows;
		}
		$_SESSION['wyswietl']=" ";
		if(isset($_SESSION['poprawnepl']))
			$_SESSION['wyswietl']=$_SESSION['poprawnepl'];
		
		
		if($_SESSION['l']=="6")
		{
			
				$idslowa=rand(1,$_SESSION['rozmiar']);
				$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE id='$idslowa'");
				$ilosc=$rezultat->num_rows;

				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE id='$idslowa'");
					$ilosc=$rezultat->num_rows;
				}
			
		
		}
		
		
		if($_SESSION['l']=="5")
		{
			
				$idslowa=rand(1,$_SESSION['rozmiar']);
				$rezultat=$polaczenie->query("SELECT slowo FROM slownik5 WHERE id='$idslowa'");
				$ilosc=$rezultat->num_rows;

				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik5 WHERE id='$idslowa'");
					$ilosc=$rezultat->num_rows;
				}
		
		}
		
		
		if($_SESSION['l']=="7")
		{
			
				$idslowa=rand(1,$_SESSION['rozmiar']);
				$rezultat=$polaczenie->query("SELECT slowo FROM slownik7 WHERE id='$idslowa'");
				$ilosc=$rezultat->num_rows;

				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik7 WHERE id='$idslowa'");
					$ilosc=$rezultat->num_rows;
				}

		}
			$wiersz=$rezultat->fetch_assoc();
			$poprawne=$wiersz['slowo'];
			$_SESSION['poprawnepl']=$poprawne;
		$ogonki = array("Ę", "Ó", "Ą", "Ś", "Ł", "Ż", "Ź", "Ć", "Ń");
		$bez_ogonkow = array("0", "1", "2", "3", "4", "5", "6", "7", "8");

		$poprawne=str_replace($ogonki, $bez_ogonkow, $poprawne);
			$tab = array();
			$tab2=array();					
            for($i=0;$i<strlen($poprawne);$i++)
            {
                $tab2[$i]=$poprawne[$i];
            }
            for($i=0;$i<strlen($poprawne);$i++)
            {
				$r=strlen($poprawne)-1;
               $a=rand(0,$r);

                  while($tab2[$a]=='11')
                         $a=rand(0,$r);
             
                   $tab[$i]= $tab2[$a];
                    $tab2[$a]='11';
            }
			$tab=str_replace($bez_ogonkow, $ogonki,  $tab);
			for($i = 0; $i < strlen($poprawne); $i++)
					echo  $tab[$i];
		
?>	
	
	</div>
	
	<div id="odpowiedz">
	
	<form method="post" >

<br/> <input type="text" autofocus name="odp"/>
<input type="submit"  value="ok">

</div>
<div id="opis">
	
	
<?php

	if(!empty($_POST['odp']))
		$odpowiedz=$_POST['odp'];
	else
		$odpowiedz=" ";
	if(count_chars(mb_strtoupper($odpowiedz,"UTF-8"))!=(count_chars(mb_strtoupper($_SESSION['wyswietl'],"UTF-8"))))
		$dobrelitery=false;
	else
		$dobrelitery=true;
	if($_SESSION['l']=="6")
		$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE slowo='$odpowiedz'");
	if($_SESSION['l']=="7")
		$rezultat=$polaczenie->query("SELECT slowo FROM slownik7 WHERE slowo='$odpowiedz'");
	if($_SESSION['l']=="5")
		$rezultat=$polaczenie->query("SELECT slowo FROM slownik5 WHERE slowo='$odpowiedz'");
		$ilosc=$rezultat->num_rows;

			if($ilosc!=0 && $dobrelitery)
			{
				
				$_SESSION['dobreodp']++;
				echo'<p><p><span style="color:darkgreen;">'.$odpowiedz.'</span>';
				echo '<a href="http://www.sjp.pl/'.$_SESSION['wyswietl'].'" target="_blank" style="color:darkorange" > (sprawdź znaczenie)</a>';			
			}
			else
			{
				if(isset($_SESSION['wyswietl']))
				{
					echo'<p><p><span style="color:red;">'.$_SESSION['wyswietl'].'</span>';
					if($_SESSION['licznik']!=0)
					echo '<a href="http://www.sjp.pl/'.$_SESSION['wyswietl'].'" target="_blank" style="color:darkorange"> (sprawdź znaczenie)</a>';

				}
			}
			if($_SESSION['licznik']!=0){
?>
</form>	
			<?php	}
			else
			{
				?>
				</form>	
				<?php
			}
	
?>
	
	</div>
<div id="dobreodp">
	<?php
	
	echo '<p><p>'.$_SESSION['dobreodp']."/".$_SESSION['licznik'];	 
	$_SESSION['licznik']++;
	if($_SESSION['licznik']>$_SESSION['max'])
	{
		$dzien = date("j");
		$miesiac = date("n");
		$rok =date("Y");
		$godzina = date("G");
		$minuta = date("i");
		$sekunda = date("s");
		$czask=$sekunda+60*$minuta+3600*$godzina + 86400*$dzien + 2592000*$miesiac + 31536000*$rok;
		$sekundy=$czask-$_SESSION['czas'];
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$punkty=$_SESSION['dobreodp'];
		$poziom=$_SESSION['l'];
		$nick=$_SESSION['nick'];
		$polaczenie->query("INSERT INTO ranking VALUES('$nick','$punkty','$sekundy','$poziom')");
		$polaczenie->close();
		
		$minuta=0;
			while($sekundy>60)
			{
				$minuta=$minuta+1;
				$sekundy=$sekundy-60;
				
			}
			
		if($sekundy<10 && $minuta<10)
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1)."<p>Czas: 0".$minuta.":0".$sekundy;
		else if($minuta<10)
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1)."<p>Czas: 0".$minuta.":".$sekundy;
		else if( $sekundy<10)
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1)."<p>Czas: ".$minuta.":0".$sekundy;
		else
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1)."<p>Czas: ".$minuta." :".$sekundy;
			unset($_SESSION['wyswietl']);
			unset($_SESSION['l']);
			unset($_SESSION['licznik']);
			unset($_SESSION['dobreodp']);
			unset($_SESSION['licznik']);
			unset($_SESSION['czas']);
						header('Location:panel.php');
						exit();
	}
	?>
	</div>
	<div style="clear:both;"></div>
	
	
	
	
	
</div>






</body>
</html>
