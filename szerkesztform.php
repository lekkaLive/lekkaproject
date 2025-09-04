
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
    
        if($connection->connect_error)
        {
            die("Kapcsolódás sikertelen" . $connection->connect_error);
        }

        $nev = $_POST['nev'];

        $stmt = $connection->prepare("SELECT * FROM munkavallalok WHERE mv_nev = ?");
        $stmt->bind_param("s", $nev);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $sor = $result->fetch_assoc();

        echo "<div id=\"error-box\"></div>";
        echo "<div id=\"success-box\"></div>";
        echo "<form class=\"belep form-horizontal\"  id=\"frm_munkav\" name=\"frm_munkav\" action=\"mentes.php\" method=\"post\">";
            echo "<fieldset class=\"fieldset szerkeszt form-horizontal\" id=\"fieldset\">
                <legend class=\"legend midle\">Szerkesztés űrlap</legend>
                    
                    <div class=\"form-group\">
                            <input class=\"form-control\" id=\"eredeti_nev\" name=\"eredeti_nev\" value=\"$sor[mv_nev]\" type=\"hidden\">
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_nev\" name=\"lb_nev\" for=\"mv_nev\">Munkavállaló neve:</label>
                        <input class=\"form-control\" id=\"mv_nev\" name=\"mv_nev\" value=\"$sor[mv_nev]\" type=\"text\" oninput=\"closeNevAlerttext()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_szulhely\" name=\"lb_szulhely\" for=\"mv_szulhely\">Születési hely:</label>
                        <input class=\"form-control\" id=\"mv_szulhely\" name=\"mv_szulhely\" value=\"$sor[mv_szulhely]\" type=\"text\" oninput=\"closeAlerttext2()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text2\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_szuldatum\" name=\"lb_szuldatum\" for=\"mv_szuldatum\">Születési dátum:</label>
                        <input class=\"form-control\" id=\"mv_szuldatum\" name=\"mv_szuldatum\" value=\"$sor[mv_szuldatum]\" type=\"date\" oninput=\"closeAlerttext3()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text3\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" class=\"form-label\" id=\"lb_lakcim\" name=\"lb_lakcim\" for=\"mv_lakcim\">Lakcím:</label>
                        <input class=\"form-control\" id=\"mv_lakcim\" name=\"mv_lakcim\" value=\"$sor[mv_lakcim]\" type=\"text\" oninput=\"closeAlerttext4()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text4\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_csoport\" name=\"lb_csoport\" for=\"szol_csoport\">Szolgálati csoport:</label>
                        <input class=\"form-control\" id=\"szol_csoport\" name=\"szol_csoport\" value=\"$sor[szol_csoport]\" type=\"number\" oninput=\"closeAlerttext5()\" required>
                    </div>
                    </div>
                        <div class=\"show-alert\">
                            <span class=\"alert-text\" id=\"alert-text5\"></span>
                        </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_kezdete\" name=\"lb_kezdete\" for=\"lb_kezdete\">Munkaviszony kezdete:</label>
                        <input class=\"form-control\" id=\"munkav_kezdete\" name=\"munkav_kezdete\" value=\"$sor[munkaviszony_kezdete]\" type=\"date\" oninput=\"closeAlerttext6()\">
                    </div>
                        <div class=\"show-alert\">
                            <span class=\"alert-text\" id=\"alert-text6\"></span>
                        </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_euervenyeseg\" name=\"lb_euervenyeseg\" for=\"euervenyeseg\">Orvosi alkalmasság érvényessége:</label>
                        <input class=\"form-control\" id=\"euervenyeseg\" name=\"euervenyeseg\" value=\"$sor[orvosi_alk_ervenyessege]\" type=\"date\" oninput=\"closeAlerttext7()\">
                    </div>
                        <div class=\"show-alert\">
                            <span class=\"alert-text\" id=\"alert-text7\"></span>
                        </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_pszichervenyeseg\" name=\"lb_pszichervenyeseg\" for=\"pszichervenyeseg\">Pszichológiai alkalmasság érvényessége:</label>
                        <input class=\"form-control\" id=\"pszichervenyeseg\" name=\"pszichervenyeseg\" value=\"$sor[pszich_alk_ervenyessege]\" type=\"date\" oninput=\"closeAlerttext8()\">
                    </div>
                        <div class=\"show-alert\">
                            <span class=\"alert-text\" id=\"alert-text8\"></span>
                        </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_vizsgadatum\" name=\"lb_vizsgadatum\" for=\"vizsgadatum\">Szakmai vizsga dátuma:</label>
                        <input class=\"form-control\" id=\"vizsgadatum\" name=\"vizsgadatum\" value=\"$sor[szakmai_vizsga_datuma]\" type=\"date\" oninput=\"closeAlerttext9()\">
                    </div>
                        <div class=\"show-alert\">
                            <span class=\"alert-text\" id=\"alert-text9\"></span>
                        </div>
                    <div class=\"btn-midle\">
                        <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" type=\"button\" onclick=\"modificationValidate()\">Mentés</button>
                    </div>
                </fieldset>
            </form>
        "       
?>