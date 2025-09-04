<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die(json_encode(["error" => "Kapcsolódási hiba!"]));
    }

    $sql = "SELECT mv_nev, szol_csoport, mv_szuldatum, alapszabadsag FROM munkavallalok ORDER BY szol_csoport";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($sor = $result->fetch_assoc())
    {
        $data[] = $sor;
    }

    header('Content-Type: application/json');
    echo json_encode($data);

    $stmt->close();
    $conn->close();
?>