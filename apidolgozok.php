<?php
// CORS és tartalom típus beállítás
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Adatbázis kapcsolat beállítás
$host = "localhost";
$username = "root";
$password = "";
$dbname = "munkahely";

$conn = new mysqli($host, $username, $password, $dbname);

// Kapcsolat ellenőrzés
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection to database faild! " . $conn->connect_error]);
    exit;
}

// Karakterkódolás beállítása
$conn->set_charset("utf8");

// Paraméter lekérése

if (!empty($_GET['mv_nev'] || $_GET['szol_csoport'])){
    // LIKE lekérdezés előkészítése
    $nev = $_GET['mv_nev'];
    $csoport = $_GET['szol_csoport'];
    $stmt = $conn->prepare("SELECT * FROM munkavallalok WHERE mv_nev LIKE CONCAT(?, '%') AND szol_csoport LIKE CONCAT(?, '%') ORDER BY mv_nev");
    $stmt->bind_param("ss", $nev, $csoport);
    $stmt->execute();
    $result = $stmt->get_result();
}
else {
    // Teljes tábla lekérése
    $result = $conn->query("SELECT * FROM munkavallalok ORDER BY mv_nev");
}

// Eredmény beolvasása
$dolgozok = [];

if($result){
    while ($sor = $result->fetch_assoc()){
        $dolgozok[] = $sor;
    }
}

// Eredmény JSON-ben visszaadása
echo json_encode($dolgozok);

// Kapcsolat lezárása
$stmt->close();
$conn->close();
?>