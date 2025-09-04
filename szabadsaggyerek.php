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
    $sql = "SELECT mv.szol_csoport, mv.mv_nev, alapszabadsag, gy.gy_nev, gy.gy_szuldatum, tartosbeteg, (DATEDIFF(CURDATE(), gy_szuldatum)) / 360 AS kor FROM munkavallalok mv LEFT JOIN gyerekek gy ON mv.id = gy.mv_id ORDER BY mv.mv_nev";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $gyadatok = [];

    while($sor = $result->fetch_assoc()){
        $csoport = $sor['szol_csoport'];
        $nev = $sor['mv_nev'];
        $gyerek = $sor['gy_nev'];
        $szuldatum = $sor['gy_szuldatum'];
        $beteg = $sor['tartosbeteg'];
        $alapszabi = $sor['alapszabadsag'];
        $gykor = $sor['kor'];

        // Ha még nincs ilyen munkavállaló a tömbben, hozzáadjuk
        if(!isset($gyadatok[$nev])){
            $gyadatok[$nev] = [
                'szol_csoport' => $csoport,
                'mv_nev' => $nev,
                'alapszabadsag' => $alapszabi,
                'gyerekek' => [],
                'gyerek_szam' => 0,
                'beteg_szam' => 0
            ];
        }
        // Ha van gyereke, hozzáadjuk a listához
        if(!is_null($gyerek)){
            if($gykor < 16){
                $gyadatok[$nev]['gyerekek'][] = $gyerek;
                $gyadatok[$nev]['gyerek_szam']++;
                if($beteg == 'i'){
                    $gyadatok[$nev]['beteg_szam']++;
                }
            }
        }
    }
    // Átalakítás numerikus indexű tömbbé
    $json_tomb = array_values($gyadatok);
    header('Content-Type: application/json');
    echo json_encode($json_tomb);

    $stmt->close();
    $conn->close();
?>