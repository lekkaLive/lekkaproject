<?php
    $email = $_GET["email"];
    $kod = $_GET["kod"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error)
    {
        die("Kapcsolódási hiba: " . $connection->connect_error);
    }

    // felhasználó mentése adatbázisba
    $stmt = $connection->prepare("SELECT count(*) as darab FROM validalas WHERE email = ? and hatarido >= now() and kod = ?;");
    $stmt->bind_param("ss", $email, $kod);

    $stmt->execute();
    $result = $stmt->get_result();
    $sor = $result->fetch_assoc();

    if ($sor["darab"] == 1)
    {
        $stmt = $connection->prepare("UPDATE validalas SET vegleges = now() WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();  

        $stmt = $connection->prepare("UPDATE felhasznalok SET aktiv = 'a' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();   

        header("Location: index.html?showlogin=true");
    }
    else
    {   
        //itt törlöm a lejárt, nem validált regisztrációkat
        //header("Location: hiba_oldal.php");        //nincs elkészítve
        echo "Valami nem jó";
    }
?>