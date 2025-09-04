<?php
    require_once "tools/oldalmenu.php";
    require_once "tools/menusor.php";
    session_start();
    if (!isset($_SESSION["nev"]))
    {
        header("Location: index.html");
    }
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Háttérfolyamat indexphp</title>
    
    <link rel="stylesheet" href="bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/belepform.css">
    <link rel="stylesheet" href="css/error_tool.css">
    <link rel="stylesheet" href="css/success_tool.css">
    <link rel="stylesheet" href="css/backend.css">
    <link rel="stylesheet" href="css/szerkesztform.css">

    <script src="bootstrap-5.3.5-dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2e7e59fe6a.js" crossorigin="anonymous"></script>
    <script src="js/api.js"></script>
    <script src="js/login.js"></script>
    <script src="js/error.js"></script>
    <script src="js/success.js"></script>
    <script src="js/szerkeszt.js"></script>
    <script src="js/szerkesztjson.js"></script>
    <script src="js/szerkesztjsonadmin.js"></script>
    <script src="js/upload.js"></script>
    <script src="js/szabadsag.js"></script>
    <script src="js/adatkeres.js"></script>
</head>

<body>
    <div class="main-container">
        <div class="container container-image">
            <div class="row headrow">
                <div class="col- col-lg-2">
                   
                </div>
                <div class="col-12 col-lg-9">
                    <div class="cimer form-horizontal">
                        
                    </div>
                </div>
                <div class="col- col-lg-1">
                    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="nav nav-side col- col-lg-2">
                    <div class="form-horizontal" id="menu">
                        <?php oldalmenu($_SESSION['jogkor']); ?>
                    </div>
                </div>
                <div class="section col-12 col-lg-9">
                    <div class="form-horizontal">
                        <section>
                            <article class="nav-article">
                                <div class="form-horizontal" id="menu">
                                    <?php menusor($_SESSION['jogkor']); ?>
                                </div>
                            </article>
                            <article class="kereso_sav">
                                <div class="filters" id="filters">
                                    <label class="keres">Név: <input type="text" id="ker_nev" name="ker_nev" oninput="frisit()"></label>
                                    <label class="keres">Szolgálati csoport: <input type="number" id="ker_csop" name="ker_csop" oninput="frisit()"></label>
                                </div>
                                <div class="filters" id="filterschild">
                                    <label class="keres">Név: <input type="text" id="nev" name="nev" oninput="frisitgyerek()"></label>
                                    <label class="keres">Születési dátum: <input type="text" id="ker_datum" name="ker_datum" oninput="frisitgyerek()"></label>
                                </div>
                                <div class="filters" id="filteradmin">
                                    <label class="keres">Név: <input type="text" id="adminnev" name="adminnev" oninput="frisitadmin()"></label>
                                </div>
                                <div class="filters" id="filtersapi">
                                    <label class="keres">Név: <input type="text" id="apinev" name="apinev" oninput="mvapi()"></label>
                                    <label class="keres">Szolgálati csoport: <input type="number" id="apicsoport" name="apicsoport" oninput="mvapi()"></label>
                                    <!--<label class="keresend">Leszerelt: <input class="form-check-input" type="checkbox" id="chk_api" name="chk_api" oninput="mvapi()"></label>-->
                                </div>
                                <div class="filters" id="filtersszabadsag">
                                    <label class="keres">Név: <input type="text" id="k_nev" name="k_nev" oninput="osszesszabadsag()"></label>
                                    <label class="keres">Szolgálati csoport: <input type="number" id="k_csop" name="k_csop" oninput="osszesszabadsag()"></label>
                                    <!--<label class="keresend">Leszerelt: <input class="form-check-input" type="checkbox" id="chk_api" name="chk_api" oninput="mvapi()"></label>-->
                                </div>
                            </article>
                            <article class="valasz">
                                <div id="valasz_ablak"></div>
                                <div id="success-box"></div>
                            </article>
                            <article class="info">
                                <div class="orvosi">

                                </div>
                                <div class="szakmai">

                                </div>
                                <div class="pszicho">

                                </div>
                            </article>
                        </section>
                    </div>
                </div>
                <div class="aside col- col-lg-1">
                    <div class="form-horizontal">
                        <aside class="grid-container">
                            <div class="grid-elemek">
                                <a href="https://njt.hu/" target="_blank"><img src="media/njtlogo.png" alt="jogtar" title="njt" width="80px" height="44px"></a>
                            </div>
                            <div class="grid-elemek">
                                <a href="https://njt.hu/" target="_blank"><img src="media/magyar_cimer.jpg" alt="kozlony" title="közlöny" width="60px" height="85px"></a>
                            </div>
                            <div class="grid-elemek">
                                <a href="https://njt.hu/" target="_blank"><img src="media/katasztrofav.jpg" alt="okf" title="katasztrófavédelem" width="80px" height="80px"></a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-horizontal">
                            <div class="keszit">
                                <ul class="adatok">
                                    <li><span style="font-weight:bold">Név: </span>Lekka Sándor</li>
                                    <li><span style="font-weight:bold">tel.: </span>+36302694877</li>
                                    <li><span style="font-weight:bold">email: </span>lekkasanyi@gmail.com</li>
                                    <hr style="margin: 2px">
                                </ul>
                            </div>
                            <div class="keszit">
                                © Készítette: Lekka Sándor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>