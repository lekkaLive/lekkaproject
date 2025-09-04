<?php
session_start();
session_destroy();
echo "
<div id=\"error-box\"></div>
<div id=\"success-box\"></div>
<div class=\"midle-container\">
    <div class=\"row\">
        <div class=\"login form-horizontal\">
            <div class=\"department\"><h2>Jelszó módosítás</h2></div>
            <div>
                <label class=\"form-label\" id=\"lb_oldPassword\" name=\"lb_oldPassword\" for=\"tb_oldPassword\">Régi jelszó:</label>
                <input class=\"form-control\" id=\"tb_oldPassword\" name=\"tb_oldPassword\" type=\"password\" required>
            </div>
            <div>
                <label class=\"form-label\" id=\"lb_newPassword\" name=\"lb_newPassword\" for=\"tb_newPassword\">Új jelszó:</label>
                <input class=\"form-control\" id=\"tb_newPassword\" name=\"tb_newPassword\" type=\"password\" required>
            </div>
            <div>
                <label class=\"form-label\" id=\"lb_confirmPassword\" name=\"lb_confirmPassword\" for=\"tb_confirmPassword\">Új jelszó megerősítése:</label>
                <input class=\"form-control\" id=\"tb_confirmPassword\" name=\"tb_confirmPassword\" type=\"password\" required>
            </div>
            <button class=\"btn btn-primary\" id=\"btn_belepes\" name=\"btn_belepes\" type=\"button\" onclick=\"changeVerify()\">Módosítás</button>
        </div>
    </div>
</div>";
?>