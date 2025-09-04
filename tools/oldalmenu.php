<?php
    function oldalmenu($jogkor){
        if($jogkor == 'v'){
            echo "<nav>
                            <fieldset>
                                <legend>Munkavállaló</legend>
                                <ul class='oldalmenu'>
                                    <li><button type='button' class='btn-nav'  onclick='uploadform()'>Felvitel</button></li>
                                    <li><button type='button' class='btn-nav'  onclick='frisit()'>Módosítás</button></li>       <!-- szerkeszt.js -->
                                    <li><button type='button' class='btn-nav'  onclick='mvapi()'>Összes adat</button></li>
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Gyerek</legend>
                                <ul class='oldalmenu'>
                                    <li><button type='button' class='btn-nav'  onclick='childuploadform()'>Felvitel</button></li>   <!-- upload.js -->
                                    <li><button type='button' class='btn-nav'  onclick='frisitgyerek()'>Módosítás</button></li>     <!-- szerkesztjson.js -->
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Szabadság</legend>
                                <ul class='oldalmenu'>
                                    <li><a type='button' class='btn-nav'  onclick='osszesszabadsag()'>Éves összes szabadság</a></li>
                                    <hr style='margin: 2px'>
                                    <li><a type='button' class='btn-nav'  onclick='szabadsageletkor()'>Életkor utáni szabadság</a></li>
                                    <li><a class='btn-nav' type='button' onclick='szabadsaggyerek()'>Gyermekek utáni szabadság</a></li>
                                    <!--<li>I. negyedéves kimutatás</li>
                                    <li>II. negyedéves kimutatás</li>
                                    <li>III. negyedéves kimutatás</li>
                                    <li>IV. negyedéves kimutatás</li>-->
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Vizsgák</legend>
                                <ul class='oldalmenu'>
                                    <li><a type='button' class='btn-nav'  onclick='orvosi()'>Orvosi alkalmassági</a></li>
                                    <hr style='margin: 2px'>   
                                    <li><a type='button' class='btn-nav'  onclick='szakmai()'>Szakmai vizsga</a></li>
                                    <li><a type='button' class='btn-nav'  onclick='pszicho()'>Pszichológiai vizsga</a></li>
                                    <li>Gépkarabély lövészet vizsga</li>
                                </ul>
                            </fieldset>
                            <!--<fieldset>
                                <legend>Nyomtatható listák</legend>
                                <ul class='oldalmenu'>
                                    <li>Szabdság tudomásul vétele</li>
                                    <li>...</li>
                                    <li>...</li>
                                    <li>...</li>
                                    <li>...</li>
                                </ul>
                            </fieldset>-->
                        </nav>";   
        }
        else{
            if($jogkor == "r"){
                echo "<nav>
                            <fieldset>
                                <legend>Ügyintézők</legend>
                                <ul class='oldalmenu'>
                                    <li><a href='ugyintezes/uj_ugyintezo.php' target='_blank'><button type='button' class='btn-nav'>Felvitel</button></a></li>
                                    <li><button type='button' class='btn-nav'  onclick='frisitadmin()'>Módosítás</button></li>       <!-- szerkesztjsonadmin.js -->
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Munkavállaló</legend>
                                <ul class='oldalmenu'>
                                    <li><button type='button' class='btn-nav'  onclick='uploadform()'>Felvitel</button></li>
                                    <li><button type='button' class='btn-nav'  onclick='frisit()'>Módosítás</button></li>       <!-- szerkeszt.js -->
                                    <li><button type='button' class='btn-nav'  onclick='mvapi()'>Összes adat</button></li>
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Gyerek</legend>
                                <ul class='oldalmenu'>
                                    <li><button type='button' class='btn-nav'  onclick='childuploadform()'>Felvitel</button></li>   <!-- upload.js -->
                                    <li><button type='button' class='btn-nav'  onclick='frisitgyerek()'>Módosítás</button></li>     <!-- szerkesztjson.js -->
                                </ul>
                            </fieldset>
                        </nav>";
            }
            else{
                echo "<nav> 
                            <fieldset>
                                <legend>Szabadság</legend>
                                <ul class='oldalmenu'>
                                    <li><a type='button' class='btn-nav'  onclick='osszesszabadsag()'>Éves összes szabadság</a></li>
                                    <hr style='margin: 2px'>
                                    <li><a type='button' class='btn-nav'  onclick='szabadsageletkor()'>Életkor utáni szabadság</a></li>
                                    <li><a class='btn-nav' type='button' onclick='szabadsaggyerek()'>Gyermekek utáni szabadság</a></li>
                                    <!--<li>I. negyedéves kimutatás</li>
                                    <li>II. negyedéves kimutatás</li>
                                    <li>III. negyedéves kimutatás</li>
                                    <li>IV. negyedéves kimutatás</li>-->
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Vizsgák</legend>
                                <ul class='oldalmenu'>
                                    <li><a type='button' class='btn-nav'  onclick='orvosi()'>Orvosi alkalmassági</a></li>
                                    <hr style='margin: 2px'>   
                                    <li><a type='button' class='btn-nav'  onclick='szakmai()'>Szakmai vizsga</a></li>
                                    <li><a type='button' class='btn-nav'  onclick='pszicho()'>Pszichológiai vizsga</a></li>
                                    <li>Gépkarabély lövészet vizsga</li>
                                </ul>
                            </fieldset>
                            <!--<fieldset>
                                <legend>Nyomtatható listák</legend>
                                <ul class='oldalmenu'>
                                    <li>Szabdság tudomásul vétele</li>
                                    <li>...</li>
                                    <li>...</li>
                                    <li>...</li>
                                    <li>...</li>
                                </ul>
                            </fieldset>-->
                        </nav>";
            }
        }
    }

?>