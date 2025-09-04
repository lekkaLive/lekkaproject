<?php
    require_once "../tools/adatbazis.php";

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
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset('utf8');

    if($conn->connect_error){
        die(json_encode(['error'=>'Kapcsolódási hiba!']));
    }

    // Paraméter lekérése
    /*$k_nev = $_POST['k_nev'] ?? '';
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
    }*/

    $sql = "SELECT szol_csoport, mv_nev, orvosi_alk_ervenyessege, pszich_alk_ervenyessege, szakmai_vizsga_datuma FROM munkavallalok ORDER BY szol_csoport ";
    
    /*if(!empty($where))
    {
        $sql .= " WHERE leszereles_datuma IS NULL " . implode(" AND ", $where) . " ORDER BY mv_nev";
    }
    else{
        $sql .= " WHERE leszereles_datuma IS NULL ORDER BY mv_nev";
    }*/
    $stmt = $conn->prepare($sql);
    /*if($params)
    {
        $stmt->bind_param($types, ...$params);
    }*/
    $stmt->execute();
    $result = $stmt->get_result();

    $orvosiadat = [];

    while($sor = $result->fetch_assoc()){
        $csoport = $sor['szol_csoport'];
        $nev = $sor['mv_nev'];
        $orvosi = $sor['orvosi_alk_ervenyessege'];
        $pszicho = $sor['pszich_alk_ervenyessege'];
        $szakmai = $sor['szakmai_vizsga_datuma'];

        // Ha még nincs ilyen munkavállaló a tömbben, hozzáadjuk
        if(!isset($orvosiadat[$nev])){
            $orvosiadat[$nev] = [
                'szol_csoport' => $csoport,
                'mv_nev' => $nev,
                'orvosi_alk_ervenyessege' => $orvosi,
                'pszich_alk_ervenyessege' => $pszicho,
                'szakmai_vizsga_datuma' => $szakmai,
            ];
        }
    }
    // Átalakítás numerikus indexű tömbbé
    $json_sztomb = array_values($orvosiadat);
    header('Content-Type: application/json');
    echo json_encode($json_sztomb);

    $stmt->close();
    $conn->close();
?>