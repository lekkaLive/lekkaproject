<?php
session_start();
session_destroy();
echo "
<div id=\"error-box\"></div>
<div id=\"success-box\"></div>
<div class=\"midle-container\">
    <div class=\"row\">
        <div class=\"login form-horizontal\">
            <div class=\"department\"><h2>Bejelentkezés</h2></div>
            <div>
                <label class=\"form-label\" id=\"lb_username\" name=\"lb_username\" for=\"tb_username\">Felhasználónév:</label>
                <input class=\"form-control\" id=\"tb_username\" name=\"tb_username\" type=\"text\" required>
                <div id=\"emailHelp\" class=\"form-text\"></div>
            </div>
            <div>
                <label class=\"form-label\" id=\"lb_password\" name=\"lb_password\" for=\"tb_password\">Jelszó:</label>
                <input class=\"form-control\" id=\"tb_password\" name=\"tb_password\" type=\"password\" required>
            </div>
            <div class=\"form-check\">
                <label class=\"form-check-label\" id=\"lb_beleegyez\" name=\"lb_beleegyez\" for=\"chk_beleegyez\">Elfogadom a felhasználási feltételeket!</label>
                <input class=\"form-check-input\" id=\"chk_beleegyez\" name=\"chk_beleegyez\" type=\"checkbox\">
            </div>
            <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" type=\"button\" onclick=\"verify()\">Belépés</button>
            <!--<div class=\"register\"><h6><a class=\"registerLink\" href=\"regisztracio/regisztracio.html\" target=\"_blank\">Új registráció</a></h6></div>-->
        </div>
    </div>
</div>";
?>