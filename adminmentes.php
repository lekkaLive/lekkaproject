<?php
    require_once "tools/adatbazis.php";

    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $eredeti_nev = $_POST["eredeti_nev"];
    $valodi_nev = $_POST["valodi_nev"];
    $nev = $_POST["username"];
    $email = $_POST["email"];
    $jogkor = $_POST["jogkor"];
    $aktiv = $_POST["aktiv"];
    if ($aktiv == 'igen'){
        $aktiv = 'i';
    }
    else
        $aktiv = 'n';

    $minden_ok = true;

    $connection = new mysqli($servername, $username, $password, $dbname);
    $connection->set_charset("utf8");

    if($connection->connect_error )
        {
            die("Kapcsolódási hiba: " . $connection->connect_error);
        }

    if (empty($valodi_nev) || empty($nev) || empty($email) || empty($jogkor))
    {
        
        $minden_ok = false;
    }

    if ($minden_ok)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "munkahely";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");
    
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE ugyintezok set nev = ?, valodi_nev = ?, email = ?, jogkor = ?, aktiv = ? where valodi_nev = ?");
        $stmt->bind_param("ssssss", $nev, $valodi_nev, $email, $jogkor, $aktiv, $eredeti_nev);
        //s -> string
        //i -> int
        //d -> double
        //b -> blob (binary large object)
        $stmt->execute();  
    
        $stmt->close();
        $conn->close();                
    
        echo "success";
    }
    else {
        echo "Valami nem jó!";
    }
?>