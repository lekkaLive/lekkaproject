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

    $connection = new mysqli($servername, $username, $password, $dbname);
    $connection->set_charset("utf8");

    if($connection->connect_error )
        {
            die("Kapcsolódási hiba: " . $connection->connect_error);
        }
        
    $ker_nev = $_POST['ker_nev'] ?? '';
    $ker_csop = $_POST['ker_csop'] ?? '';

    $where = [];
    $params = [];
    $types = "";

    if (!empty($ker_nev))
    {
        $where[] = "mv_nev LIKE ?";
        $params[] = $ker_nev . "%";
        $types = $types . "s";
    }
    if (!empty($ker_csop))
    {
        $where[] = "szol_csoport = ?";
        $params[] = intval($ker_csop);
        $types .= "i";
    }

    $sql = "SELECT mv_nev, szol_csoport, orvosi_alk_ervenyessege, pszich_alk_ervenyessege, szakmai_vizsga_datuma FROM munkavallalok";
    if(!empty($where))
    {
        $sql .= " WHERE leszereles_datuma IS NULL AND " . implode(" AND ", $where) . " ORDER BY mv_nev";
    }
    else{
        $sql .= " WHERE leszereles_datuma IS NULL ORDER BY mv_nev";
    }
    $stmt = $connection->prepare($sql);
    if($params)
    {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        echo "
            <h3>Munkavállalók tábla:</h3>
            <div class=\"container\">
                <table class=\"table table-striped table-bordered table-sm table-hover\">
                    <tr class=\"table-success\">
                        <th>Név</th>
                        <th>Csoport</th>
                        <th>Orvosi érvényesség</th>
                        <th>Pszicho érvényesség</th>
                        <th>Szakmai vizsga ideje</th>
                        <th>Szerkeszt</th>
                    </tr>";
        while($sor = $result->fetch_assoc())
            {
                echo "<tr>";
                foreach($sor as $kulcs => $ertek)
                {
                    if ($kulcs == "mv_nev" )
                    {
                        echo "<td class=\"left\"><a href =\"javascript:szerkesztform('$ertek')\">" . $ertek . "</td>";
                    }
                    else
                    {  
                        echo "<td>" . htmlspecialchars($ertek) . "</td>";  
                    }
                }
                foreach($sor as $kulcs => $ertek)
                {
                    if ($kulcs == "mv_nev" )
                    {
                        //echo "<td><a href =\"javascript:szerkesztform('$ertek')\">Szerkeszt</td>";
                        echo "<td>
                                <div class='btn-group'>
                                    <button class=' btn btn-edit' onclick='szerkesztform(`$ertek`)'><i class=\"fa-regular fa-pen-to-square fa-2xs\"></i></button>
                                    <button class=' btn btn-edit' onclick='torol(`$ertek`)'><i class=\"fa-solid fa-trash-can fa-2xs\"></i></button>
                                </div>        
                            </td>";
                    }
                }
                echo "</tr>";
            }
    }
    //$stmt->close();
    else
    {
        echo "<tr><td>Nincs találat.</td></tr>";
    }
        echo "</table>";
    echo "</div>";
    $connection->close();
?>
