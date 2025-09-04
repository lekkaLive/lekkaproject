<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $servername = 'localhost';
    $usernane = 'root';
    $password = '';
    $dbname = 'munkahely';

    $conn = new mysqli($servername, $usernane, $password, $dbname);
    $conn->set_charset('utf8');

    if($conn->connect_error){
        die(json_encode(['error'=>'Kapcsolódási hiba!']));
    }

    // Paraméter lekérése
    $k_nev = $_POST['k_nev'] ?? '';
    $k_csop = $_POST['k_csop'] ?? '';

    $where = [];
    $params = [];
    $types = "";

    if (!empty($k_nev))
    {
        $where[] = "mv_nev LIKE ?";
        $params[] = $k_nev . "%";
        $types = $types . "s";
    }
    if (!empty($k_csop))
    {
        $where[] = "szol_csoport = ?";
        $params[] = intval($k_csop);
        $types .= "i";
    }

    $sql = "SELECT mv.szol_csoport, mv.mv_nev, mv.mv_szuldatum, mv.alapszabadsag, mv.leszereles_datuma, gy.gy_nev,gy.gy_szuldatum, tartosbeteg, (DATEDIFF(CURDATE(), gy.gy_szuldatum)) / 360 AS kor FROM munkavallalok mv LEFT JOIN gyerekek gy ON mv.id = gy.mv_id";
    if(!empty($where))
    {
        $sql .= " WHERE " . implode(" AND ", $where) . " AND leszereles_datuma IS NULL  ORDER BY mv_nev";
    }
    else{
        $sql .= " WHERE leszereles_datuma IS NULL ORDER BY mv_nev";
    }
    $stmt = $conn->prepare($sql);
    if($params)
    {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $szadatok = [];

    while($sor = $result->fetch_assoc()){
        $csoport = $sor['szol_csoport'];
        $nev = $sor['mv_nev'];
        $szuldatum = $sor['mv_szuldatum'];
        $alapszabi = $sor['alapszabadsag'];
        $beteg = $sor['tartosbeteg'];
        $gyerek = $sor['gy_nev'];
        $gyszuldatum = $sor['gy_szuldatum'];
        $gykor = $sor['kor'];

        // Ha még nincs ilyen munkavállaló a tömbben, hozzáadjuk
        if(!isset($szadatok[$nev])){
            $szadatok[$nev] = [
                'szol_csoport' => $csoport,
                'mv_nev' => $nev,
                'mv_szuldatum' => $szuldatum,
                'alapszabadsag' => $alapszabi,
                'gyerekek' => [],
                'gyerek_szam' => 0,
                'beteg_szam' => 0
            ];
        }
        // Ha van gyereke, hozzáadjuk a listához
        if(!is_null($gyerek)){
            if($gykor < 16){
                $szadatok[$nev]['gyerekek'][] = $gyerek;
                $szadatok[$nev]['gyerek_szam']++;
                if($beteg == 'i'){
                    $szadatok[$nev]['beteg_szam']++;
                }
            }
        }
    }

    // Átalakítás numerikus indexű tömbbé
    $json_sztomb = array_values($szadatok);
    header('Content-Type: application/json');
    echo json_encode($json_sztomb);

    $stmt->close();
    $conn->close();
?>