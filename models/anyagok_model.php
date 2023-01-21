<?php


$eredmeny = "";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=vizvezetek_szerelok', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $sql = "SELECT * FROM anyagok";
            $sth = $dbh->query($sql);
            $eredmeny .= "<table class='table table-striped'><tr><th>Id</th><th>Anyag</th><th>Db</th><th>Elérhető</th><th>Ár</th></tr>";
            while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $eredmeny .= "<tr>";
                foreach ($row as $column)
                    $eredmeny .= "<td class='text-center'>" . $column .  "</td>";
                $eredmeny .= "</tr>";
            }
            $eredmeny .= "</table>";
            break;
        case "POST":
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);
            /*
            echo $incoming;
            print_r($data);
            print_r($_POST);
            */
            $sql = "insert into anyagok values (0, :anyag, :db, :elerheto, :ar)";
            $sth = $dbh->prepare($sql);
            $count = $sth->execute(array(":anyag" => $data["anyag"], ":db" => $data["db"], ":elerheto" => $data["elerheto"], ":ar" => $data["ar"]));
            $newid = $dbh->lastInsertId();
            $eredmeny .= $count . " beszúrt sor: " . $newid;
            break;
        case "PUT":
            $data = array();
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);
            $modositando = "id=id";
            $params = array(":id" => $data["id"]);
            if ($data['anyag'] != "") {
                $modositando .= ", anyag = :anyag";
                $params[":anyag"] = $data["anyag"];
            }
            if ($data['db'] != "") {
                $modositando .= ", db = :db";
                $params[":db"] = $data["db"];
            }
            if ($data['elerheto'] != "") {
                $modositando .= ", elerheto = :elerheto";
                $params[":elerheto"] = $data["elerheto"];
            }
            if ($data['ar'] != "") {
                $modositando .= ", ar = :ar";
                $params[":ar"] = sha1($data["ar"]);
            }
            $sql = "update anyagok set " . $modositando . " where id=:id";
            $sth = $dbh->prepare($sql);
            $count = $sth->execute($params);
            $eredmeny .= $count . " módositott sor. Azonosítója:" . $data["id"];
            break;
        case "DELETE":
            $data = array();
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);
            $sql = "delete from anyagok where id=:id";
            $sth = $dbh->prepare($sql);
            $count = $sth->execute(array(":id" => $data["id"]));
            $eredmeny .= $count . " sor törölve. Azonosítója:" . $data["id"];
            break;
    }
} catch (PDOException $e) {
    $eredmeny = $e->getMessage();
}
echo $eredmeny;

