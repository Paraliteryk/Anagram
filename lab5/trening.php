<?php

session_start();
if(!isset($_SESSION['wyswietl']))
{
	$_SESSION['l']=$_POST['liczba'];
	$_SESSION['max']=$_POST['ileliter'];
	$_SESSION['poczatek']=$_POST['poczatek'];
	$_SESSION['koniec']=$_POST['koniec'];
	$_SESSION['srodek']=$_POST['srodek'];
	$_SESSION['dobreodp']=0;
	$_SESSION['licznik']=0;
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<h1>Anagram</h1>

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
			if(empty($_SESSION['poczatek']) && empty($_SESSION['srodek']) && empty($_SESSION['koniec']))
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
			else
			{
				$wyszukaj=$_SESSION['poczatek'];
				$wyszukaj2=$_SESSION['srodek'];
				$wyszukaj3=$_SESSION['koniec'];
				$ilosc=0;
				$skoncz=0;
				//$wyszukaj3=$_SESSION['koniec'];
				//$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE slowo LIKE '$wyszukaj%' ORDER BY RAND() limit 1 ");
				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE slowo LIKE '$wyszukaj%' AND slowo LIKE '%$wyszukaj2%' AND slowo LIKE '%$wyszukaj3' AND id='$idslowa'");
					$ilosc=$rezultat->num_rows;
					$skoncz++;
					if($skoncz>10000)
					{
						$_SESSION['blad']="Brak wystarczającej liczby słów spełniającej Twoje warunki!";
						header('Location:panel2.php');
						exit();
					}
				}
				
				
			}
		
		}
		
		
		if($_SESSION['l']=="5")
		{
			if(empty($_SESSION['poczatek']) && empty($_SESSION['srodek']) && empty($_SESSION['koniec']))
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
			else
			{
				$wyszukaj=$_SESSION['poczatek'];
				$wyszukaj2=$_SESSION['srodek'];
				$wyszukaj3=$_SESSION['koniec'];
				$ilosc=0;
				$skoncz=0;
				//$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE slowo LIKE '$wyszukaj%' ORDER BY RAND() limit 1 ");
				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik5 WHERE slowo LIKE '$wyszukaj%' AND slowo LIKE '%$wyszukaj2%' AND slowo LIKE '%$wyszukaj3' AND id='$idslowa'");
					$ilosc=$rezultat->num_rows;
					$skoncz++;
					if($skoncz>10000)
					{
						$_SESSION['blad']="Brak wystarczającej liczby słów spełniającej Twoje warunki!";
						header('Location:panel2.php');
						exit();
					}
				}
				
				
			}
		
		}
		
		
		if($_SESSION['l']=="7")
		{
			if(empty($_SESSION['poczatek']) && empty($_SESSION['srodek']) && empty($_SESSION['koniec']))
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
			else
			{
				$wyszukaj=$_SESSION['poczatek'];
				$wyszukaj2=$_SESSION['srodek'];
				$wyszukaj3=$_SESSION['koniec'];
				$ilosc=0;
				$skoncz=0;
				//$wyszukaj3=$_SESSION['koniec'];
				//$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE slowo LIKE '$wyszukaj%' ORDER BY RAND() limit 1 ");
				while($ilosc==0)
				{
					$idslowa=rand(1,$_SESSION['rozmiar']);
					$rezultat=$polaczenie->query("SELECT slowo FROM slownik7 WHERE slowo LIKE '$wyszukaj%' AND slowo LIKE '%$wyszukaj2%' AND slowo LIKE '%$wyszukaj3' AND id='$idslowa'");
					$ilosc=$rezultat->num_rows;
					$skoncz++;
					if($skoncz>10000)
					{
						$_SESSION['blad']="Brak wystarczającej liczby słów spełniającej Twoje warunki!";
						header('Location:panel2.php');
						exit();
					}
				}
				
				
			}
		
		}
			$wiersz=$rezultat->fetch_assoc();
			$poprawne=$wiersz['slowo'];
			$_SESSION['poprawnepl']=$poprawne;
		$ogonki = array("Ę", "Ó", "Ą", "Ś", "Ł", "Ż", "Ź", "Ć", "Ń");
		$bez_ogonkow = array("0", "1", "2", "3", "4", "5", "6", "7", "8");

		$poprawne=str_replace($ogonki, $bez_ogonkow, $poprawne);
			$tab = array();
			for($i = 0; $i < strlen($poprawne); $i++)
					$tab[$i] = $poprawne[$i];
			$tab2=array();					
            for($i=0;$i<strlen($poprawne);$i++)
            {
                $tab2[$i]=$tab[$i];
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
					echo "<span style=\"font-size: 40px;\"> $tab[$i] </span>";
		
?>	
<form method="post" >

<br/> <input type="text" autofocus name="odp"/>
<input type="submit"  value="ok">

</form>
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
				
			}
			else
			{
				if(isset($_SESSION['wyswietl']))
				{
					echo  $_SESSION['wyswietl'];
				}
			}
				
	echo '<p><p>'.$_SESSION['dobreodp']."/".$_SESSION['licznik'];
	$_SESSION['licznik']++;
	if($_SESSION['licznik']>$_SESSION['max'])
	{
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1);
						header('Location:panel.php');
						exit();
	}
	
	echo '<p><p><a href="panel.php">Zakończ trening</a>';
?>


</body>
</html>
