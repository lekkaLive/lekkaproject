<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $mv_nev = $_POST["mv_nev"];
    $mv_szulhely = $_POST["mv_szulhely"];
    $mv_szuldatum = $_POST["mv_szuldatum"];
    $mv_lakcim =  $_POST["mv_lakcim"];
    $szol_csoport =  $_POST["szol_csoport"];
    $munkav_kezdete =  $_POST["munkav_kezdete"];
    $euervenyeseg =  $_POST["euervenyeseg"];
    $pszichervenyeseg =  $_POST["pszichervenyeseg"];
    $vizsgadatum =  $_POST["vizsgadatum"];
    
    $today = date("Y-m-d"); // Mai dátum YYYY-MM-DD formátumban

    $minden_ok = true;

    if (empty($mv_nev) || empty($mv_szulhely) || empty($mv_szulhely) || empty($mv_szuldatum) || empty($mv_lakcim) || empty($szol_csoport))
    {
        $minden_ok = false;
    }
    if (is_null($mv_szulhely) || preg_match('/^\d+$/', $mv_szulhely))
    {
        $minden_ok = false;
    }
    
    if($mv_szuldatum >= $today)
    {
        $minden_ok = false;
    }
    if (!(is_numeric($szol_csoport)) || ($szol_csoport < 1) || ($szol_csoport > 5))
    {
        $minden_ok = false;
    }
    if ($munkav_kezdete >= $today)
    {
        $minden_ok = false;
    }
    if (($euervenyeseg < $today) || ($pszichervenyeseg < $today))
    {
        $minden_ok = false;
    }
  
    if (empty($vizsgadatum))
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
        
        $stmt = $conn->prepare("INSERT INTO munkavallalok (mv_nev, mv_szulhely, mv_szuldatum, mv_lakcim, szol_csoport, munkaviszony_kezdete, orvosi_alk_ervenyessege, pszich_alk_ervenyessege, szakmai_vizsga_datuma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssissss", $mv_nev, $mv_szulhely, $mv_szuldatum, $mv_lakcim, $szol_csoport, $munkav_kezdete, $euervenyeseg, $pszichervenyeseg, $vizsgadatum);
        //s -> string
        //i -> int
        //d -> double
        //b -> blob (binary large object)
        $stmt->execute();  
        echo "success";
        $stmt->close();
        $conn->close();                
    }
    else{
        echo "Hiba! Nem sikerült az adatokat feltölteni";
    }
?>