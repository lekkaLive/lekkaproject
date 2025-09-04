<link rel="stylesheet" href="css/szerkesztform.css">
<link rel="stylesheet" href="css/error_tool.css">
<link rel="stylesheet" href="css/success_tool.css">
<script src="js/error.js"></script>
<script src="js/success.js"></script>
<script src="js/szerkeszt.js"></script>
<script src="js/szerkesztjson.js"></script>
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

        $gynev = $_POST['gynev'];

        $stmt = $connection->prepare("SELECT * FROM gyerekek WHERE gy_nev = ?");
        $stmt->bind_param("s", $gynev);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $sor = $result->fetch_assoc();

        echo "<div id=\"error-box\"></div>";
        echo "<div id=\"success-box\"></div>";
        echo "<form class=\"belep form-horizontal\"  id=\"frm_gyerekek\" name=\"frm_gyerekek\" action=\"gymentes.php\" method=\"post\">";
            echo "<fieldset class=\"fieldset gyszerkeszt form-horizontal\" id=\"fieldset\">
                <legend class=\"legend midle\">Szerkesztés űrlap</legend>
                    
                    <div class=\"form-group\">
                            <input class=\"form-control\" id=\"eredeti_nev\" name=\"eredeti_nev\" value=\"$sor[gy_nev]\" type=\"hidden\">
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_gynev\" name=\"lb_gynev\" for=\"gy_nev\">Gyerek neve neve:</label>
                        <input class=\"form-control\" id=\"gy_nev\" name=\"gy_nev\" value=\"$sor[gy_nev]\" type=\"text\" oninput=\"closeNevAlerttext()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_gyszulhely\" name=\"lb_gyszulhely\" for=\"gy_szulhely\">Születési hely:</label>
                        <input class=\"form-control\" id=\"gy_szulhely\" name=\"gy_szulhely\" value=\"$sor[gy_szulhely]\" type=\"text\" oninput=\"closeAlerttextSzulhely()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textSzulhely\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_gyszuldatum\" name=\"lb_gyszuldatum\" for=\"gy_szuldatum\">Születési dátum:</label>
                        <input class=\"form-control\" id=\"gy_szuldatum\" name=\"gy_szuldatum\" value=\"$sor[gy_szuldatum]\" type=\"date\" oninput=\"closeAlerttextSzuldatum()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textSzuldatum\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" class=\"form-label\" id=\"lb_gylakcim\" name=\"lb_gylakcim\" for=\"gy_lakcim\">Lakcím:</label>
                        <input class=\"form-control\" id=\"gy_lakcim\" name=\"gy_lakcim\" value=\"$sor[gy_lakcim]\" type=\"text\" oninput=\"closeAlerttextCim()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textCim\"></span>
                    </div>
                    <label class=\"form-label\">Tartós betegség: </label>
                        <div class=\"form-check form-check-inline\">
                            <label class=\"form-check-label\" for=\"igen\">Igen</label>
                            <input class=\"form-check-input\" id=\"igen\" name=\"beteg\" type=\"radio\" value=\"igen\" oninput=\"closeAlerttextBeteg()\">
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <label class=\"form-check-label\" for=\"nem\">Nem</label>
                            <input class=\"form-check-input\" id=\"nem\" name=\"beteg\" type=\"radio\" value=\"nem\" oninput=\"closeAlerttextBeteg()\">
                        </div>
                        <div class=\"form-check-inline\">
                            <span class=\"padding alert-text\" id=\"alert-textBeteg\"></span>
                        </div>
                    <div class=\"btn-midle\">
                        <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" type=\"button\" onclick=\"gymodificationValidate()\">Mentés</button>
                    </div>
                </fieldset>
            </form>
        ";       
?>