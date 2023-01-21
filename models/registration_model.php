<?php

class Registration_Model
{
    public function set_data($vars)
    {

        if($vars["pass"] == $vars["pass2"] ){

        $retData['eredmeny'] = "";
        try {
            $connection = Database::getConnection();
            $sql = "select * from felhasznalok where f_nev='".$vars['username']."'";
            $stmt = $connection->query($sql);
            $felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            switch(count($felhasznalo)) {
                case 0:
                    $sqlInsert = "insert into felhasznalok (id, cs_nev, u_nev, f_nev, jelszo ,jogosultsag)
                    values('', :cs_nev , :u_nev, :f_nev, :jelszo, :jogosultsag)";
                    $sth = $connection->prepare($sqlInsert);
                    $sth->execute(array( ':cs_nev' => $vars['lastname'],':u_nev' => $vars['firstname'],
                        ':f_nev' => $vars['username'], ':jelszo' => sha1($vars['pass']),
                         ':jogosultsag' => "_1_"));
                    $retData['eredmeny'] = "OK";
                    $retData['uzenet'] = "Kedves ".$vars['lastname']." ".$vars['firstname']."!<br><br>
					A regisztrációja sikeres.<br><br>
					Kérjük jelentkezzen be a folytatáshoz.<br><br>
					Jó munkát kívánunk rendszerünkkel!";
                    break;
                case 1:
                    $retData['eredmeny'] = "ERROR";
                    $retData['uzenet'] ="A felhesználónév már foglalt!";
                    break;
            }
        }
        catch (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
        }
        }else {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "A jelszó nem egyezik";
        }
        return $retData;
    }
}
