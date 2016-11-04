<?php

session_start();

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
		$idslowa=rand(1,100000);
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE id='$idslowa'");
		$ilosc=$rezultat->num_rows;

			while($ilosc==0)
			{
				$idslowa=rand(1,100000);
				$rezultat=$polaczenie->query("SELECT slowo FROM slownik6 WHERE id='$idslowa'");
				$ilosc=$rezultat->num_rows;
			}
			$wiersz=$rezultat->fetch_assoc();
			$poprawne=$wiersz['slowo'];
			echo "<p> (".$poprawne.")</p>";
			
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

                  while($tab2[$a]=='1')
                         $a=rand(0,$r);
             
                   $tab[$i]= $tab2[$a];
                    $tab2[$a]='1';
            }
			for($i = 0; $i < strlen($poprawne); $i++)
					echo "<span style=\"font-size: 40px;\"> $tab[$i] </span>";
		
?>	

<form action="trening.php">
  <input type="submit" value="następny">
  </form>
</body>
</html>




