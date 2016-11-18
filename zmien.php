<?php
session_start();
if((!empty($_POST['haslon1'])) || (!empty($_POST['mail2'])))
{
echo "dziala cos";
require_once "connect.php";

		$haslon1=$_POST['haslon1'];
		$haslon2=$_POST['haslon2'];
		$mail2=$_POST['mail2'];
		$nick=$_SESSION['nick'];
		$zmieniono=true;
		echo "dziala cos";
		if((!empty($_POST['haslon1'])))
		{
			if($haslon1!=$haslon2)			//sprawdzamy poprawnosc hasla
			{	$zmieniono=false;
				$_SESSION['zlehaslon']="Podane hasła nie są takie same";
			}
			
			if(!ctype_alnum($haslon1))
			{
				
				$zmieniono=false;
				$_SESSION['zlehaslon']="Hasło zawiera niedozwolone znaki";
			}
			
			if(strlen($haslon1)<8)
			{
				$zmieniono=false;
				$_SESSION['zlehaslon']="Hasło jest zbyt krótkie";
			}
			if(strlen($haslon1)>25)
			{
				$zmieniono=false;
				$_SESSION['zlehaslon']="Hasło jest zbyt długie";
			}
		}
		if((!empty($_POST['mail2'])))
		{
			
			$mailspr2=filter_var($mail2,FILTER_SANITIZE_EMAIL);
			if( filter_var($mailspr2,FILTER_SANITIZE_EMAIL)==false || $mail2!=$mailspr2)
			{
				$zmieniono=false;
				$_SESSION['zlymail']="Nieprawidłowy adres e-mail";
			}
			
		}
		$hash=password_hash($haslon1,PASSWORD_DEFAULT);
		
		try
		{
				$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
				if($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$rezultat=$polaczenie->query("SELECT nick FROM gracze WHERE email='$mail2'");
					$ilosc=$rezultat->num_rows;
					if( $ilosc>0)
					{
						$zmieniono=false;
						$_SESSION['zlymail']="Podany adres e-mail ma już założone konto";
					}

					if($zmieniono)
					{
						if((empty($_POST['mail2'])))
						{
							if($polaczenie->query("UPDATE gracze SET haslo='$hash' WHERE nick='$nick'"))
							{
								$_SESSION['zmieniono']="Gratulacje, zmieniłeś hasło";
								//$polaczenie->close();
								header('Location:panel.php');
							}
							else
							{
								throw new Exception($polaczenie->error);
							}
							
							exit();
						}
						if((!empty($_POST['mail2'])))
						{
							if($polaczenie->query("UPDATE gracze SET email='$mail2' WHERE nick='$nick'"))
							{
								$_SESSION['zmieniono']="Gratulacje, zmieniłeś maila";
								//$polaczenie->close();
								header('Location:panel.php');
							}
							else
							{
								throw new Exception($polaczenie->error);
							}
							
							exit();
						}
					}
					else
					{
						header('Location:zmiania.php');
					}
					$polaczenie->close();
				}

		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera</span>';
		}
}

else
{
	header('Location:panel.php');
	exit();
}
?>