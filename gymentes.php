<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $eredeti_nev = $_POST["eredeti_nev"];
    $gy_nev = $_POST["gy_nev"];
    $gy_szulhely = $_POST["gy_szulhely"];
    $gy_szuldatum = $_POST["gy_szuldatum"];
    $gy_lakcim = $_POST["gy_lakcim"];
    $tartosbeteg = $_POST["beteg"];
    if ($tartosbeteg == 'igen'){
        $tartosbeteg = 'i';
    }
    else
        $tartosbeteg = 'n';

    $mv_id;

    $minden_ok = true;
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "munkahely";

    $connection = new mysqli($servername, $username, $password, $dbname);
    $connection->set_charset("utf8");

    if($connection->connect_error )
        {
            die("Kapcsolódási hiba: " . $connection->connect_error);
        }
    
    $sql = "SELECT mv_lakcim, id FROM munkavallalok";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        while($sor = $result->fetch_assoc())
        {
            foreach($sor as $kulcs => $ertek)
            {
                if ($ertek == $gy_lakcim)
                {
                    $mv_id = $sor["id"];
                }
            }
        }
    }

    $connection->close();

    if (empty($gy_nev) || empty($gy_szulhely) || empty($gy_szuldatum) || empty($gy_lakcim))
    {
        
        $minden_ok = false;
    }
    
    $today = date("Y-m-d");

    if($gy_szuldatum >= $today)
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

        $stmt = $conn->prepare("UPDATE gyerekek set gy_nev = ?, gy_szulhely = ?, gy_szuldatum = ?, gy_lakcim = ?, tartosbeteg = ?, mv_id = ? where gy_nev = ?");
        $stmt->bind_param("sssssis", $gy_nev, $gy_szulhely, $gy_szuldatum, $gy_lakcim, $tartosbeteg, $mv_id, $eredeti_nev);
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