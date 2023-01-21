<?php

class Szereles_Model
{

    public function get_data()
    {
        try {

            $connection = Database::getConnection();
            $sql = 'select munkalap.bedatum,munkalap.javdatum,hely.telepules,hely.utca,szerelo.nev,munkalap.munkaora,munkalap.anyagar from munkalap INNER JOIN hely on munkalap.helyaz=hely.az INNER join szerelo on munkalap.szereloaz=szerelo.az;';
            $stmt = $connection->query($sql);
            $tezst = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";

             foreach ($tezst as $key => $val) {
                $number = $key + 1;
               //var_dump($val['munkaora']);

                    echo '<tr>';
                   // echo '<td class="text-center"> <a type="button" href="pdfgen" class="fa fa-download"></a></td>';
                    echo '<td class="text-center" id="bedatum"  >' . $val["bedatum"]. '</td>';
                    echo '<td class="text-center"id="jav" >' . $val["javdatum"]. '</td>';
                    echo '<td class="text-center"id="hely">' . $val["telepules"]. '</td>';
                    echo '<td class="text-center"id="hely">' . $val["utca"]. '</td>';
                    echo '<td class="text-center"id="szer">' . $val["nev"]. '</td>';
                    echo '<td class="text-center"id="munk">' . $val["munkaora"]. '</td>';
                    echo '<td class="text-center"id="anyag">' . $val["anyagar"]. ' Ft</td>';
                    echo '</tr>';


            }
        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
    public function get_varos()
    {
        try {
            $connection = Database::getConnection();
            $sql = "SELECT  DISTINCT  telepules from hely order by telepules;";
            $stmt = $connection->query($sql);
            $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";
            echo '<option value="0" selected>Települések</option>';
            foreach ($adat as $key => $val){
                $n = $key+1;
                echo '<option name="telepules" value="'.$val['telepules'].'">'.$val['telepules'].'</option>';
            }


        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
    public function get_utca($var)
    {

        try {
            $connection = Database::getConnection();
            $sql = "SELECT  DISTINCT  utca from hely where telepules = '".$var["varos"]."' order by utca;";
            $stmt = $connection->query($sql);
            $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";

            echo '<option value="0" selected>Utca</option>';
            foreach ($adat as $key => $val){
                $n = $key+1;
                echo '<option name="utca" value="'.$val['utca'].'">'.$val['utca'].'</option>';
            }


        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
    public function get_javdatum($var)
    {

        try {
            $connection = Database::getConnection();
            $sql=  "SELECT az from hely where telepules = '".$var["varos"]."' and utca = '".$var["utca"]."';";
            $stmt = $connection->query($sql);
            $azdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $helyaz = $azdata[0]["az"];
            $sql = "SELECT  javdatum from munkalap where helyaz = ".$helyaz." order by javdatum;";
            $stmt = $connection->query($sql);
            $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";

           echo '<option value="0" selected>Javítási dátum</option>';
           foreach ($adat as $key => $val){
                $n = $key+1;
                echo '<option name="javdatum" value="'.$val['javdatum'].'">'.$val['javdatum'].'</option>';
            }


        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
    public function get_szurt($var)
    {

        try {
            $connection = Database::getConnection();
            $sql = 'select munkalap.bedatum,munkalap.javdatum,hely.telepules,hely.utca,szerelo.nev,munkalap.munkaora,munkalap.anyagar from munkalap INNER JOIN hely on munkalap.helyaz=hely.az INNER join szerelo on munkalap.szereloaz=szerelo.az where hely.telepules="'.$var["varos"].'" and utca="'.$var["utca"].'" and javdatum="'.$var["javdatum"].'";';
            $stmt = $connection->query($sql);
            $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";

            foreach ($adat as $key => $val) {
                //$number = $key + 1;
                //var_dump($val['munkaora']);
                echo '<tr>';
                echo '<td class="text-center">' . $val["bedatum"]. '</td>';
                echo '<td class="text-center">' . $val["javdatum"]. '</td>';
                echo '<td class="text-center">' . $val["telepules"]. '</td>';
                echo '<td class="text-center">' . $val["utca"]. '</td>';
                echo '<td class="text-center">' . $val["nev"]. '</td>';
                echo '<td class="text-center">' . $val["munkaora"]. '</td>';
                echo '<td class="text-center">' . $val["anyagar"]. ' Ft</td>';
                echo '</tr>';

            }

        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
    public function get_selectvaros($var)
    {

        try {
            $connection = Database::getConnection();
            $sql=  "SELECT az from hely where telepules = '".$var["varos"]."' and utca = '".$var["utca"]."';";
            $stmt = $connection->query($sql);
            $azdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $helyaz = $azdata[0]["az"];
            $sql = "SELECT  * from munkalap where helyaz = ".$helyaz.";";
            $stmt = $connection->query($sql);
            $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "OK";

            foreach ($adat as $key => $val) {
                //$number = $key + 1;
                //var_dump($val['munkaora']);
                echo '<tr>';
                echo '<td class="text-center">' . $val["az"]. '</td>';
                echo '<td class="text-center">' . $val["bedatum"]. '</td>';
                echo '<td class="text-center">' . $val["javdatum"]. '</td>';
                echo '<td class="text-center">' . $val["helyaz"]. '</td>';
                echo '<td class="text-center">' . $val["szereloaz"]. '</td>';
                echo '<td class="text-center">' . $val["munkaora"]. '</td>';
                echo '<td class="text-center">' . $val["anyagar"]. ' Ft</td>';
                echo '</tr>';

            }

        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
    }
}