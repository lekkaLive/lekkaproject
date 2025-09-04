<?php
    session_start();
    
    require_once "tools/adatbazis.php";
    /*
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";
    */
    $connection = new mysqli($servername, $username, $password, $dbname);

    if($connection->connect_error)
    {
        die("Kapcsolódás sikertelen" . $connection->connect_error);
    }

    // Ellenőrzés!!!!
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nev = $_POST["username"];
        $jelszo = $_POST["password"];

        $stmt = $connection->prepare("SELECT * FROM ugyintezok WHERE nev = ? AND (jelszo = sha2(?,256)) || (jelszo = ?)");
        $stmt->bind_param("sss", $nev, $jelszo, $jelszo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $sor = $result->fetch_assoc();

        if($result->num_rows > 0)
        {
            $_SESSION["nev"] = $nev;
            $_SESSION["valodi_nev"] = $sor["valodi_nev"];
            $_SESSION["email"] = $sor["email"];
            $_SESSION["jogkor"] = $sor["jogkor"];
            if($sor["jelszo_modositas_kell"] == "i")
            {
                //header("Location: jelszo_modositas.php");
                echo "jelszomodositas";
            }
            else{
                //Lejárt jelszó
                $today = date("Y-m-d"); // Mai dátum YYYY-MM-DD formátumban
                $lejarat = new DateTime($sor["jelszo_lejar"]);
                if($lejarat->format("Y-m-d") <= $today)
                {
                    echo "Az ön jelszava lejárt, kérem módosítsa!!";
                }
                else{
                    echo "success";
                }
            }   
        }
        else
        {
            echo "Hibás felhasználó név vagy jelszó!";
        }
        $stmt->close();
    }
    $connection->close();
?>