<?php
    //session kezelés
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: ../index.html?showlogin=true");
    }
    if (isset($_GET["rendben"]))
    {
        $nev= $_GET["nev"];
        $valodinev = $_GET["vnev"];
        $rendben = $_GET["rendben"]; 
    }
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Új Ügyintéző Felvétele</title>
        
        <link rel="stylesheet" href="../css/success_tool.css">;
        <style>
            body {
                font-family: Arial, sans-serif;
                background-image: url("../media/background.jpg");
                background-size:cover;
                background-attachment:fixed;
                display: flex;
                height: 100vh;
                justify-content: center;
                align-items: center;
            }
            .form-container {
                background-color: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 300px;
            }
            .form-container h2 {
                text-align: center;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-inline{
                display: flex;
            }
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            input, select {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
            }
            .form-check-input{
                width: 10%;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                box-shadow: -2px -2px 3px black;
                color:white;
                background-color:green;
                font-weight:bolder;
            }
            .error {
                color: red;
                font-size: 0.9em;
                margin-top: -10px;
                margin-bottom: 10px;
            }
            .success {
                color: green;
                font-size: 0.9em;
                margin-top: -10px;
                margin-bottom: 10px;
                border-radius: 10px;
                background-color: white;
                text-align: center;
            }
        </style>
        <script src="../js/success.js"></script>
    </head>
    <body>
        <div id="success-box">
            <?php
            if(isset($rendben))
            {
                echo "<script>";
                echo "success('Az új ügyintéző felvétele megtörtént! A bejelentkezési adatok e-mail-ben elküldve!');";
                echo "</script>";
            }
            ?>
        </div>
        <div class="form-container">
            <div class="success" id="success"><?php if (isset($_GET["rendben"])){$nev = $_GET["nev"];$valodinev = $_GET["vnev"]; echo $valodinev . " nevű ügyintéző felvétele rendben!!!<br><br>A JELSZÓ MEGVÁLTOZTATÁSA KÖTELEZŐ AZ ELSŐ BEJELENTKEZÉST KÖVETŐEN!!!";}?></div>
            <h2>Új ügyintéző</h2>
            <form id="ujKollegaForm" action="ugyintezo_mentese.php" method="POST" onsubmit="return ellenoriz()">
                <div class="form-group">
                    <label for="nev">Nick Név:</label>
                    <input type="text" id="nev" name="nev">
                </div>
                <div class="form-group">
                    <label for="valodinev">Valódi Név:</label>
                    <input type="text" id="valodinev" name="valodinev">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group form-inline">
                    <label class="form-check-label" for="chk_aktiv">Aktiv: </label>
                    <input class="form-check-input" type="checkbox" id="chk_aktiv" name="chk_aktiv" value="i">
                </div>
                <div class="form-group">
                    <label for="jogkor">Jogkör:</label>
                    <select id="jogkor" name="jogkor">
                        <option value="">-- Válassz jogkört --</option>
                        <option value="r">Rendszergazda</option>
                        <option value="v">Vezető</option>
                        <option value="k">Kolléga</option>
                    </select>
                </div>
                <div id="hibaUzenet" class="error"></div>
                <button type="submit">Mentés</button>
            </form>
        </div>
        <script>
            function ellenoriz() {
                const nev = document.getElementById('nev').value.trim();
                const email = document.getElementById('email').value.trim();
                const jogkor = document.getElementById('jogkor').value;
                const hibaUzenet = document.getElementById('hibaUzenet');

                if (nev === '' || email === '' || jogkor === '') {
                    hibaUzenet.textContent = 'Kérlek tölts ki minden mezőt!';
                    return false;
                }

                hibaUzenet.textContent = '';
                return true;
            }
        </script>
    </body>
</html>