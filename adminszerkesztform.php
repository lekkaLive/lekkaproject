<link rel="stylesheet" href="css/szerkesztform.css">
<link rel="stylesheet" href="css/error_tool.css">
<link rel="stylesheet" href="css/success_tool.css">
<script src="js/error.js"></script>
<script src="js/success.js"></script>
<script src="js/szerkeszt.js"></script>
<script src="js/szerkesztjson.js"></script>
<?php
    require_once "tools/adatbazis.php";

    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
        $connection = new mysqli($servername, $username, $password, $dbname);
        $connection->set_charset("utf8");
    
        if($connection->connect_error)
        {
            die("Kapcsolódás sikertelen" . $connection->connect_error);
        }

        $valodi_nev = $_POST['valodi_nev'];

        $stmt = $connection->prepare("SELECT * FROM ugyintezok WHERE valodi_nev = ?");
        $stmt->bind_param("s", $valodi_nev);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $sor = $result->fetch_assoc();

        echo "<div id=\"error-box\"></div>";
        echo "<div id=\"success-box\"></div>";
        echo "<form class=\"belep form-horizontal\"  id=\"frm_ugyintezok\" name=\"frm_ugyintezok\" action=\"ugyintmentes.php\" method=\"post\">";
            echo "<fieldset class=\"fieldset gyszerkeszt form-horizontal\" id=\"fieldset\">
                <legend class=\"legend midle\">Szerkesztés űrlap</legend>
                    
                    <div class=\"form-group\">
                            <input class=\"form-control\" id=\"eredeti_nev\" name=\"eredeti_nev\" value=\"$sor[valodi_nev]\" type=\"hidden\">
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_valodi_nev\" name=\"lb_valodi_nev\" for=\"valodi_nev\">Ügyintéző neve:</label>
                        <input class=\"form-control\" id=\"valodi_nev\" name=\"valodi_nev\" value=\"$sor[valodi_nev]\" type=\"text\" oninput=\"closeNevAlerttext()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-text\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_username\" name=\"lb_username\" for=\"username\">Felhasználói név:</label>
                        <input class=\"form-control\" id=\"username\" name=\"username\" value=\"$sor[nev]\" type=\"text\" oninput=\"closeAlerttextUsername()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textUsername\"></span>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"form-label\" id=\"lb_email\" name=\"lb_email\" for=\"email\">Email cím:</label>
                        <input class=\"form-control\" id=\"email\" name=\"email\" value=\"$sor[email]\" type=\"text\" oninput=\"closeAlerttextEmail()\">
                    </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textEmail\"></span>
                    </div>
                    <div class='form-group'>
                    <label class='form-label' id='lb_jogkor' name='lb_jogkor' for='jogkor'>Jogkör:</label>
                    <select class='form-control' id='jogkor' name='jogkor' oninput='closeAlerttextJogkor()'>
                        <option value=''>-- Válassz jogkört --</option>
                        <option value='r'>Rendszergazda</option>
                        <option value='v'>Vezető</option>
                        <option value='k'>Kolléga</option>
                    </select>
                </div>
                    <div class=\"show-alert\">
                        <span class=\"alert-text\" id=\"alert-textJogkor\"></span>
                    </div>
                    <label class=\"form-label\">Aktív: </label>
                        <div class=\"form-check form-check-inline\">
                            <label class=\"form-check-label\" for=\"igen\">Igen</label>
                            <input class=\"form-check-input\" id=\"igen\" name=\"aktiv\" type=\"radio\" value=\"igen\" oninput=\"closeAlerttextBeteg()\">
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <label class=\"form-check-label\" for=\"nem\">Nem</label>
                            <input class=\"form-check-input\" id=\"nem\" name=\"aktiv\" type=\"radio\" value=\"nem\" oninput=\"closeAlerttextBeteg()\">
                        </div>
                        <div class=\"form-check-inline\">
                            <span class=\"padding alert-text\" id=\"alert-textBeteg\"></span>
                        </div>
                    <div class=\"btn-midle\">
                        <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" type=\"button\" onclick=\"adminmodificationValidate()\">Mentés</button>
                    </div>
                </fieldset>
            </form>
        ";       
?>