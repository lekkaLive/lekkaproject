<?php
    require_once "../tools/adatbazis.php";

    //session kezelés
    /*session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: ../index.html?showlogin=true");
    }*/
?>
<?php

    $oldPassword = $_POST["oldPasssword"];
    $newPassword = $_POST["newPassword"] ?? "";
    
    $modosit_ok = true;

    if (empty($oldPassword) || empty($newPassword))
    {
        $minden_ok = false;
    }

    if($modosit_ok)
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }   
        
        $stmt = $conn->prepare("UPDATE ugyintezok set jelszo = sha2(?, 256), kodolt_jelszo = sha2(?, 256), aktiv = 'i', jelszo_modositas_kell = 'n', jelszo_lejar = DATE_ADD(now(), INTERVAL 3 MONTH) where jelszo = sha2(?, 256)");
        $stmt->bind_param("sss", $newPassword, $newPassword, $oldPassword);
        //s -> string
        //i -> int
        //d -> double
        //b -> blob (binary large object)
        $stmt->execute();  
    
        $stmt->close();
        $conn->close();                
    
        echo "mentve";
    }
    else {
        echo "Sikertelen jelsző módisítás";
    }
?>