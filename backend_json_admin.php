<?php
    require_once "tools/adatbazis.php";

    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    // Adatbázis kapcsolat beállítás

    $connection = new mysqli($servername, $username, $password, $dbname);

    // Karakterkódolás beállítása
    $connection->set_charset("utf8");

    // Kapcsolat ellenőrzés
    if($connection->connect_error){
        die(json_encode(["error" => "Kapcsolódási hiba"]));
    }

    // Paraméter lekérése
    $adminnev = $_POST['adminnev'] ?? '';

    $where = [];
    $params = [];
    $types = "";

    // LIKE lekérdezés előkészítése
    if (!empty($adminnev))
    {
        $where[] = "valodi_nev LIKE ?";
        $params[] = $adminnev . "%";
        $types = $types . "s";
    }

    // Teljes tábla lekérése
    $sql = "SELECT * FROM ugyintezok";
    if(!empty($where))
    {
        $sql .= " WHERE " . implode(" AND ", $where) . " ORDER BY valodi_nev";
    }
    else{
        $sql .= " ORDER BY valodi_nev";
    }

    $stmt = $connection->prepare($sql);
    if($params)
    {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

     // Eredmény beolvasása
    $adminadatok = [];
    while ($sor = $result->fetch_assoc())
    {
        $adminadatok[] = $sor;
    }

    // Tartalom típus beállítás
    header('Content-Type: application/json');

    // Eredmény JSON-ben visszaadása
    echo json_encode($adminadatok);

    // Kapcsolat lezárása
    $stmt->close();
    $connection->close();
?>