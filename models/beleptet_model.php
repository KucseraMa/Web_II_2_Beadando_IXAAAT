<?php

class Beleptet_Model
{
	public function get_data($vars)
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
            $sqlSelect = "select id, cs_nev, u_nev, f_nev,jogosultsag from felhasznalok where f_nev=:f_nev and jelszo=:jelszo";
            $sth = $connection->prepare($sqlSelect);
            $sth->execute(array( ':f_nev' => $vars['username'], ':jelszo' => sha1($vars['pass'])));
			$felhasznalo = $sth->fetchAll(PDO::FETCH_ASSOC);
			switch(count($felhasznalo)) {
				case 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "A felhaszbáló név vagy jelszó nem megfelelő";
					break;
				case 1:
					$retData['eredmény'] = "OK";
					$retData['uzenet'] = "Üdvözöljük újra ".$felhasznalo[0]['cs_nev']." ".$felhasznalo[0]['u_nev']."!<br><br>					                      ";
                    $_SESSION['username']=$felhasznalo[0]['f_nev'];
                    $_SESSION['logedin'] = 1;
					$_SESSION['userid'] =  $felhasznalo[0]['id'];
					$_SESSION['userlastname'] =  $felhasznalo[0]['cs_nev'];
					$_SESSION['userfirstname'] =  $felhasznalo[0]['u_nev'];
					$_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
					Menu::setMenu();
					break;
				default:
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Több felhasználót találtunk a megadott felhasználói név -jelszó párral!";
			}
		}
		catch (PDOException $e) {
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}
}

?>