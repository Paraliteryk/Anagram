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

	 if (isset($_POST['szach']) && $_POST['szach'] =="1") {
 
 require_once "connect.php";
		try
		{
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$dodawane= $_SESSION['wyswietl'];
		$nick=$_SESSION['nick'];
		$rezultat=$polaczenie->query("SELECT slowo FROM slownikGracza WHERE slowo='$dodawane'");
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
								catch(Exception $e)
								{
									echo '<span style="color:red;">Błąd serwera</span>';
								}
								
								
 
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
<br/><input type="checkbox"  name="szach" value="1" />Dodaj do swojego słownika
</form>	
			<?php	}
			else
			{
				?>
				</form>	
				<?php
			}
	
	
	echo '<p><p><a href="panel.php">Zakończ trening</a>';
?>
	
	</div>
<div id="dobreodp">
	<?php
	
	echo '<p><p>'.$_SESSION['dobreodp']."/".$_SESSION['licznik'];	 
	$_SESSION['licznik']++;
	if($_SESSION['licznik']>$_SESSION['max'])
	{
			$_SESSION['wynik']="Twój wynik:".$_SESSION['dobreodp']."/".($_SESSION['licznik']-1);
			unset($_SESSION['wyswietl']);
			unset($_SESSION['l']);
			unset($_SESSION['licznik']);
			unset($_SESSION['poczatek']);
			unset($_SESSION['koniec']);
			unset($_SESSION['srodek']);
			unset($_SESSION['dobreodp']);
			unset($_SESSION['licznik']);
						header('Location:panel.php');
						exit();
	}
	?>
	</div>
	<div style="clear:both;"></div>
	
	
	
	
	
</div>






</body>
</html>
