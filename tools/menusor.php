<?php
    function menusor($jogkor){
        if($jogkor == 'v'){
            echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
                                    <div class='container-fluid space-around'>
                                        <!--<a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-xl'></i></a>-->
                                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                                            <span class='navbar-toggler-icon'></span>
                                        </button>
                                        <a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-xl'></i></a>
                                        <div class='collapse navbar-collapse dropdown' id='navbarSupportedContent'>
                                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 egyedi'>
                                                <li class='nav-item dropdown employee'>
                                                    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Munkavállalók
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='uploadform()' class='dropdown-item'>Felvitel</a></li>
                                                        <li><a type='button' onclick='frisit()' class='dropdown-item'>Módosítás</a></li>        <!--szerkeszt.js-->
                                                        <li><a type='button' onclick='mvapi()' class='dropdown-item'>Összes adat</a></li>       <!--api.js-->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown children'>
                                                    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Gyerekek
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='childuploadform()' class='dropdown-item'>Felvitel</a></li><!-- upload.js -->
                                                        <li><a type='button' onclick='frisitgyerek()' class='dropdown-item'>Módosítás</a></li>  <!-- szerkesztjson.js -->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown free-day'>
                                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Szabadság
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='osszesszabadsag()' class='dropdown-item'>Éves összes szabadság</a></li>
                                                        <li class='dropdown-divider'></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szabadsageletkor()'>Életkor utáni szabadság</a></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szabadsaggyerek()'>Gyerekek utáni szabadság</a></li>
                                                        <!--<li><a class='dropdown-item' type='button'>I. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>II. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>III. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>VI. negyedéves kimutatás</a></li>-->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown exams'>
                                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Vizsgák
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a class='dropdown-item' type='button' onclick='orvosi()'>Orvosi alkalmassági</a></li>
                                                        <li class='dropdown-divider'></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szakmai()'>Szakmai vizsga</a></li>
                                                        <li><a class='dropdown-item' type='button' onclick='pszicho()'>Pszichológiai vizsga</a></li>
                                                        <li><a class='dropdown-item' href='#'>Gépkarabély lövészet</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <form class='d-flex'>
                                                Bejelentkezve: " . $_SESSION['valodi_nev'] .
                                                "<button type='button' class='btn btn-primary' onclick='window.location.replace(`logout.php`)'>Kijelentkezés<i class='fa-solid fa-arrow-right-from-bracket'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </nav>";   
        }
        else{
            if($jogkor == 'r'){
                echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
                                    <div class='container-fluid space-around'>
                                        <!--<a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-xl'></i></a>-->
                                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                                            <span class='navbar-toggler-icon'></span>
                                        </button>
                                        <a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-2xl'></i></a>
                                        <div class='collapse navbar-collapse dropdown' id='navbarSupportedContent'>
                                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 egyedi'>
                                            <li class='nav-item dropdown employee'>
                                                    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Ügyintézők
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a href='ugyintezes/uj_ugyintezo.php' target='_blank'><button type='button' class='dropdown-item'>Felvitel</button></a></li>
                                                        <li><a type='button' onclick='frisitadmin()' class='dropdown-item'>Módosítás</a></li>        <!--szerkeszt.js-->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown employee'>
                                                    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Munkavállalók
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='uploadform()' class='dropdown-item'>Felvitel</a></li>
                                                        <li><a type='button' onclick='frisit()' class='dropdown-item'>Módosítás</a></li>        <!--szerkeszt.js-->
                                                        <li><a type='button' onclick='mvapi()' class='dropdown-item'>Összes adat</a></li>       <!--api.js-->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown children'>
                                                    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Gyerekek
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='childuploadform()' class='dropdown-item'>Felvitel</a></li><!-- upload.js -->
                                                        <li><a type='button' onclick='frisitgyerek()' class='dropdown-item'>Módosítás</a></li>  <!-- szerkesztjson.js -->
                                                    </ul>
                                                </li>
                                            </ul>
                                            <form class='d-flex'>
                                                Bejelentkezve: " . $_SESSION['valodi_nev'] .
                                                "<button type='button' class='btn btn-primary' onclick='window.location.replace(`logout.php`)'>Kijelentkezés<i class='fa-solid fa-arrow-right-from-bracket'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </nav>";
            }
            else{
                echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
                                    <div class='container-fluid space-around'>
                                        <!--<a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-xl'></i></a>-->
                                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                                            <span class='navbar-toggler-icon'></span>
                                        </button>
                                        <a class='navbar-brand' href='index.php'><i class='fa-regular fa-house fa-xl'></i></a>
                                        <div class='collapse navbar-collapse dropdown' id='navbarSupportedContent'>
                                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 egyedi'>
                                                
                                                <li class='nav-item dropdown free-day'>
                                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Szabadság
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a type='button' onclick='osszesszabadsag()' class='dropdown-item'>Éves összes szabadság</a></li>
                                                        <li class='dropdown-divider'></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szabadsageletkor()'>Életkor utáni szabadság</a></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szabadsaggyerek()'>Gyerekek utáni szabadság</a></li>
                                                        <!--<li><a class='dropdown-item' type='button'>I. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>II. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>III. negyedéves kimutatás</a></li>
                                                        <li><a class='dropdown-item' type='button'>VI. negyedéves kimutatás</a></li>-->
                                                    </ul>
                                                </li>
                                                <li class='nav-item dropdown exams'>
                                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Vizsgák
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        <li><a class='dropdown-item' type='button' onclick='orvosi()'>Orvosi alkalmassági</a></li>
                                                        <li class='dropdown-divider'></li>
                                                        <li><a class='dropdown-item' type='button' onclick='szakmai()'>Szakmai vizsga</a></li>
                                                        <li><a class='dropdown-item' type='button' onclick='pszicho()'>Pszichológiai vizsga</a></li>
                                                        <li><a class='dropdown-item' href='#'>Gépkarabély lövészet</a></li>
                                                    </ul>
                                                </li>
                                                <!--<li class='nav-item dropdown printlist'>
                                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                                        data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Nyomtatható listák
                                                    </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                        
                                                        <li><a class='dropdown-item' href='#'>Szabdság tudomásul vétel</a></li>
                                                        <li><a class='dropdown-item' href='#'>----------</a></li>
                                                        <li><a class='dropdown-item' href='#'>----------</a></li>
                                                    </ul>
                                                </li>-->
                                            </ul>
                                            <form class='d-flex'>
                                                Bejelentkezve: " . $_SESSION['valodi_nev'] .
                                                "<button type='button' class='btn btn-primary' onclick='window.location.replace(`logout.php`)'>Kijelentkezés<i class='fa-solid fa-arrow-right-from-bracket'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </nav>";
            }
        }
    }

?>