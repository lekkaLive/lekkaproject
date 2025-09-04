<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    $gy_nev = $_POST["gy_nev"];
    $gy_szulhely = $_POST["gy_szulhely"];
    $gy_szuldatum = $_POST["gy_szuldatum"];
    $gy_lakcim =  $_POST["gy_lakcim"];
    $tartosbeteg =  $_POST["beteg"];
    if ($tartosbeteg == 'nem')
        $tartosbeteg = 'n';
    else
        $tartosbeteg = 'i';

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
    $today = date("Y-m-d"); // Mai dátum YYYY-MM-DD formátumban
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
    
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }   
        
        $stmt = $conn->prepare("INSERT INTO gyerekek (gy_nev, gy_szulhely, gy_szuldatum, gy_lakcim, tartosbeteg, mv_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $gy_nev, $gy_szulhely, $gy_szuldatum, $gy_lakcim, $tartosbeteg, $mv_id);
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