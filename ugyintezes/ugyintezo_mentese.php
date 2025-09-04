<?php
    require_once "../tools/adatbazis.php";
    require_once "levelkuldes/levelkuldo.php";

    //session kezelés
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: ../index.html?showlogin=true");
    }
    /*
    if  (isset($_POST["nev"]))
        $nev = $_POST["nev"];
    else
        hiba, hibaüzenet, stb.
        $nev= "";
    */
?>
<?php
    require_once "../kod.php";

    $nev = $_POST["nev"] ?? "";
    $vnev = $_POST["valodinev"] ?? "";
    $email = $_POST["email"] ?? "";
    $jogkor = $_POST["jogkor"] ?? "";
    if(isset($_POST["chk_aktiv"]) && $_POST["chk_aktiv"] == 'i'){
        $aktiv = 'i';
    }
    else{
        $aktiv = 'n';
    }
    
    //Ellenőrzés!!! Megcsinálni bővebben (email ellenőrzés - @; jogkör - r,v,k ...)!!!!
    if ($nev == "" || $email == "" || $jogkor == "")
    {
        echo "hiba";
    }
    else
    {
        $jelszo = code_generate();
        
        //mentés adatbázisba        Ez kiszervezve egy tools mappába és fent egy require_once "../tools/adatbazis.php";-al hivatkozok, elindítom
                             
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");

        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }

        $sql = "INSERT INTO ugyintezok (nev, valodi_nev, jelszo, aktiv, kodolt_jelszo, email, jogkor, jelszo_modositas_kell, jelszo_lejar) VALUES (?, ?, sha2(?, 256), ?, sha2(?, 256), ?, ?, 'i', DATE_ADD(now(), INTERVAL 3 MONTH))";
        $stmt = $conn->prepare($sql);        
        $stmt->bind_param("sssssss", $nev, $vnev, $jelszo, $aktiv, $jelszo, $email, $jogkor);
        $stmt->execute();

        $conn->close();

        //email kiküldése
        $leveltorzs = "Tisztelt " . $vnev ."!<br><br>" . "A belépéshez szükséges felhasználói neve és ideiglenes jelszava (figyeljen a kis- és nagybetűkre):<br><br>felhasználói név: " . $nev ."<br> jelszó: " . $jelszo . "<br><br>A JELSZÓ MEGVÁLTOZTATÁSA KÖTELEZŐ AZ ELSŐ BEJELENTKEZÉST KÖVETŐEN!!!<br><br>" . "<a href='http://127.0.0.27/project/index.html?showlogin=true'>Erre a linkre kattintva tud belépni.</a><br><br>Tisztelettel:<br>Adminisztrátor";
        $egyszerutorzs = "Tisztelt felhasználó!\n\nA belépéshez szükséges felhasználói neve és ideiglenes jelszava (figyeljen a kis- és nagybetűkre):\nfelhasználói név: " . $nev . "\njelszó: " . $jelszo . "\n\nA JELSZÓ MEGVÁLTOZTATÁSA KÖTELEZŐ AZ ELSŐ BEJELENTKEZÉST KÖVETŐEN!!!";
        $rendben = kuldes("lekkasanyi@gmail.com", 'LS', "Jelszó", $leveltorzs, $egyszerutorzs);
        if ($rendben == "Ok"){
            header("Location: uj_ugyintezo.php?rendben=".$rendben."&nev=".$nev."&vnev=".$vnev);
        }
        else{

        }
    }
?>