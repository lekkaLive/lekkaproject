<?php
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html?showlogin=true");
    }
?>
<?php
    echo "<div id=\"error-box\"></div>";
    echo "<div id=\"success-box\"></div>";
    echo "<fieldset class=\"fieldset gyszerkeszt form-horizontal\" id=\"fieldset\">
            <legend class=\"legend\">Gyermek felvitele űrlap</legend>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_nev\" name=\"lb_nev\" for=\"gy_nev\">Gyermek neve:</label>
                <input class=\"form-control\" id=\"gy_nev\" name=\"gy_nev\" type=\"text\" oninput=\"closeNevAlerttext()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-text\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_szulhely\" name=\"lb_szulhely\" for=\"gy_szulhely\">Születési hely:</label>
                <input class=\"form-control\" id=\"gy_szulhely\" name=\"gy_szulhely\" type=\"text\" oninput=\"closeAlerttextSzulhely()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textSzulhely\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_szuldatum\" name=\"lb_szuldatum\" for=\"gy_szuldatum\">Születési dátum:</label>
                <input class=\"form-control\" id=\"gy_szuldatum\" name=\"gy_szuldatum\" type=\"date\" oninput=\"closeAlerttextSzuldatum()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textSzuldatum\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" class=\"form-label\" id=\"lb_lakcim\" name=\"lb_lakcim\" for=\"gy_lakcim\">Lakcím:</label>
                <input class=\"form-control\" id=\"gy_lakcim\" name=\"gy_lakcim\" type=\"text\" oninput=\"closeAlerttextCim()\">
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
                <div class=\"show-alert\">
                    <span class=\"padding alert-text\" id=\"alert-textBeteg\"></span>
                </div>
            <div class=\"btn-midle\">
                <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" onclick=\"childuploadvalidate()\">Mentés</button>
            </div>
        </fieldset>"     
?>