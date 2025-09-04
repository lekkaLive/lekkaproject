<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $mv_nev = $_POST["mv_nev"];

    $minden_ok = true;

    if (empty($mv_nev))
    {
        $minden_ok = false;
    }
    if($minden_ok)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "munkahely";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE munkavallalok set leszereles_datuma = CURDATE() where mv_nev = ?");
        //$stmt = $conn->prepare("UPDATE munkavallalok set leszereles_datuma = DATE_ADD(now() where mv_nev = ?");
        $stmt->bind_param("s", $mv_nev);
        //s -> string
        //i -> int
        //d -> double
        //b -> blob (binary large object)
        $stmt->execute();  
    
        $stmt->close();
        $conn->close();                
    
        echo "torolve";
    }
    else {
        echo "Valami nem jó!";
    }
?>