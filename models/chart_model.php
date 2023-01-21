<?php
class Chart_Model
{
            public $data = array();
            public function get_data($vars)
            {
                try {
                    $connection = Database::getConnection();
                    $sql = "select hely.telepules AS 'Telepules',SUM(munkalap.munkaora) AS 'Munkaora', 
                            SUM(munkalap.anyagar) AS 'Anyagar' from munkalap 
                            INNER JOIN hely on munkalap.helyaz=hely.az 
                            INNER join szerelo on munkalap.szereloaz=szerelo.az 
                            GROUP BY hely.telepules;";
                    $stmt = $connection->query($sql);
                    $retData ['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $retData['eredmeny'] = "OK";
                    return $retData;
                }catch
                    (PDOException $e) {
                        $retData['eredmeny'] = "ERROR";
                        $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
                    }
                return $retData;
            }
}
    ?>