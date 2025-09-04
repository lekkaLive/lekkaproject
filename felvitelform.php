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
    echo "<fieldset class=\"fieldset szerkeszt form-horizontal\" id=\"fieldset\">
            <legend class=\"legend\">Új munkavállaló felvitele űrlap</legend>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_nev\" name=\"lb_nev\" for=\"mv_nev\">Munkavállaló neve:</label>
                <input class=\"form-control\" id=\"mv_nev\" name=\"mv_nev\" type=\"text\" oninput=\"closeNevAlerttext()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-text\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_szulhely\" name=\"lb_szulhely\" for=\"mv_szulhely\">Születési hely:</label>
                <input class=\"form-control\" id=\"mv_szulhely\" name=\"mv_szulhely\" type=\"text\" oninput=\"closeAlerttextSzulhely()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textSzulhely\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_szuldatum\" name=\"lb_szuldatum\" for=\"mv_szuldatum\">Születési dátum:</label>
                <input class=\"form-control\" id=\"mv_szuldatum\" name=\"mv_szuldatum\" type=\"date\" oninput=\"closeAlerttextSzuldatum()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textSzuldatum\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" class=\"form-label\" id=\"lb_lakcim\" name=\"lb_lakcim\" for=\"mv_lakcim\">Lakcím:</label>
                <input class=\"form-control\" id=\"mv_lakcim\" name=\"mv_lakcim\" type=\"text\" oninput=\"closeAlerttextCim()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textCim\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_csoport\" name=\"lb_csoport\" for=\"szol_csoport\">Szolgálati csoport:</label>
                <input class=\"form-control\" id=\"szol_csoport\" name=\"szol_csoport\" type=\"number\" oninput=\"closeAlerttextCsoport()\" required>
            </div>
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textCsoport\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_kezdete\" name=\"lb_kezdete\" for=\"lb_kezdete\">Munkaviszony kezdete:</label>
                <input class=\"form-control\" id=\"munkav_kezdete\" name=\"munkav_kezdete\" type=\"date\" oninput=\"closeAlerttextKezdes()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textKezdes\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_euervenyeseg\" name=\"lb_euervenyeseg\" for=\"euervenyeseg\">Orvosi alkalmasság érvényessége:</label>
                <input class=\"form-control\" id=\"euervenyeseg\" name=\"euervenyeseg\" type=\"date\" oninput=\"closeAlerttextEu()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textEu\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_pszichervenyeseg\" name=\"lb_pszichervenyeseg\" for=\"pszichervenyeseg\">Pszichológiai alkalmasság érvényessége:</label>
                <input class=\"form-control\" id=\"pszichervenyeseg\" name=\"pszichervenyeseg\" type=\"date\" oninput=\"closeAlerttextPszicho()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textPszicho\"></span>
                </div>
            <div class=\"form-group\">
                <label class=\"form-label\" id=\"lb_vizsgadatum\" name=\"lb_vizsgadatum\" for=\"vizsgadatum\">Szakmai vizsga dátuma:</label>
                <input class=\"form-control\" id=\"vizsgadatum\" name=\"vizsgadatum\" type=\"date\" oninput=\"closeAlerttextVizsga()\">
            </div>
                <div class=\"show-alert\">
                    <span class=\"alert-text\" id=\"alert-textVizsga\"></span>
                </div>
            <div class=\"btn-midle\">
                <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" onclick=\"uploadvalidate()\">Mentés</button>
            </div>
        </fieldset>"       
?>