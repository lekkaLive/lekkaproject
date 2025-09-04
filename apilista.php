<?php
    // API URL meghatározása
    $apiUrl = "http://127.0.0.27/projectregist/apidolgozok.php?";

    if (isset($_POST['apinev'])){
        $apinev = urlencode($_POST['apinev']);
        $apicsoport = urlencode($_POST['apicsoport']);
        $apiUrl .= "mv_nev=$apinev"."&szol_csoport=$apicsoport";
        //echo $apiUrl;
    }

    // API kérés végrehajtása
    $response = file_get_contents($apiUrl);

    if ($response === FALSE){
        die("Hiba történt az API lekérése közben!");
    }

    $dolgozok = json_decode($response, true);

    echo "
            <h3>Munkavállalók tábla:</h3>
            <div class=\"container\">
                <table class=\"table table-striped table-bordered table-sm table-hover\">
                <tr class=\"table-success sticky\">
                        <th>Név</th>
                        <th>Szül.hely</th>
                        <th>Szül.datum</th>
                        <th>Lakcím</th>
                        <!--<th>Csoport</th>-->
                        <th>MV.kezdete</th>
                        <th>Orvosialk.</th>
                        <th>Pszichológia</th>
                        <th>Szakmai v.</th>
                       
                    </tr>";
    if (empty($dolgozok)){
        echo "<tr><td>Nincs találat.</td></tr>";    
    }
    else{
        
        foreach ($dolgozok as $dolgozo){
            echo "<tr>";
            echo "<td class=\"left\">" . htmlspecialchars($dolgozo['mv_nev']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['mv_szulhely']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['mv_szuldatum']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['mv_lakcim']) . "</td>";
            /*echo "<td>" . htmlspecialchars($dolgozo['szol_csoport']) . "</td>";*/
            echo "<td>" . htmlspecialchars($dolgozo['munkaviszony_kezdete']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['orvosi_alk_ervenyessege']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['pszich_alk_ervenyessege']) . "</td>";
            echo "<td>" . htmlspecialchars($dolgozo['szakmai_vizsga_datuma']) . "</td>";
            echo "</tr>";
        }
    echo "</table></div>";
    }
?>