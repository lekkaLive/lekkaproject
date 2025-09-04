<?php

require_once "kod.php";

$email = $_POST["tb_email"];
$nickname = $_POST["tb_nick"];
$nev = $_POST["tb_vnev"];
$jelszo = $_POST['tb_password'];
$gender_type = $_POST["gender_type"];
if ($gender_type == 'nő')
    $gender_type = 'n';
else
    $gender_type = 'f';
$birth_date = $_POST["tb_birthDate"];

$minden_ok = true;

if (empty($email) || empty($nickname) || empty($nev) || empty($jelszo) || empty($birth_date))
    {
        $minden_ok = false;
    }
$today = date("Y-m-d");
if($birth_date >= $today)
    {
        $minden_ok = false;
    }
if($minden_ok)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";
    
    $connection = new mysqli($servername, $username, $password, $dbname);
    
    if ($connection->connect_error) {
        die("Kapcsolódási hiba: " . $connection->connect_error);
    }
    
    // felhasználó mentése adatbázisba
    $stmt = $connection->prepare("INSERT INTO felhasznalok VALUES (?, ?, ?, ?, ?, ?, 'r', NULL, md5(?));");
    $stmt->bind_param("sssssss", $email, $nickname, $nev, $jelszo, $gender_type, $birth_date, $jelszo, );
    //s -> string
    //i -> int
    //d -> double
    //b -> blob (binary large object)
    $stmt->execute();
    
    $kod = code_generate();

    // az email validálása
    $stmt = $connection->prepare("INSERT INTO validalas VALUES (?, date_add(now(), interval 1 day), ?, NULL);");
    $stmt->bind_param("ss", $email, $kod);

    $stmt->execute();
    /*
    $leveltorzs = "Tisztelt XY!\r\n";
    $leveltorzs .= "Az alábbi linkre kattintva erősítheti meg regisztrációját!";
    $leveltorzs .= "http://nagyonokosvagyok.hu/17_alkalom/validalas.php?kod=.......";
    $leveltorzs .= "<a href=\"http://nagyonokosvagyok.hu/17_alkalom/validalas.php?kod=.......\"link</a>";
    
    //mail($email, "Validálás", $leveltorzs);
    */

    echo "<a href=\"http://127.0.0.1/projectregist/validate.php?email=" . $email . "&kod=" . $kod . "\">A regisztráció véglegesítéséhez kattintson ide!</a>";

    //header("Location: index.html");

    $stmt->close();
    $connection->close();

}
?>