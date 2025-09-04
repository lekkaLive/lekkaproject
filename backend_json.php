<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    // Adatbázis kapcsolat beállítás
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";

    $connection = new mysqli($servername, $username, $password, $dbname);

    // Karakterkódolás beállítása
    $connection->set_charset("utf8");

    // Kapcsolat ellenőrzés
    if($connection->connect_error){
        die(json_encode(["error" => "Kapcsolódási hiba"]));
    }

    // Paraméter lekérése
    $nev = $_POST['nev'] ?? '';
    $ker_datum = $_POST['ker_datum'] ?? '';

    $where = [];
    $params = [];
    $types = "";

    // LIKE lekérdezés előkészítése
    if (!empty($nev))
    {
        $where[] = "gy_nev LIKE ?";
        $params[] = $nev . "%";
        $types = $types . "s";
    }
    if (!empty($ker_datum))
    {
        $where[] = "gy_szuldatum LIKE ?";
        $params[] = $ker_datum . "%";
        $types .= "s";
    }

    // Teljes tábla lekérése
    $sql = "SELECT * FROM gyerekek";
    if(!empty($where))
    {
        $sql .= " WHERE " . implode(" AND ", $where) . " ORDER BY gy_nev";
    }
    else{
        $sql .= " ORDER BY gy_nev";
    }

    $stmt = $connection->prepare($sql);
    if($params)
    {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Eredmény beolvasása
    $adatok = [];
    while ($sor = $result->fetch_assoc())
    {
        $adatok[] = $sor;
    }

    // Tartalom típus beállítás
    header('Content-Type: application/json');

    // Eredmény JSON-ben visszaadása
    echo json_encode($adatok);

    // Kapcsolat lezárása
    $stmt->close();
    $connection->close();
?>