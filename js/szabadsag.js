function osszesszabadsag(){
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "flex";

    const k_nev = document.getElementById("k_nev").value;
    const k_csop = document.getElementById("k_csop").value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'osszesszabadsag.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const osszadat = JSON.parse(xhr.responseText);
                megjelenitOsszes(osszadat);
            }
        }
    };
    const params = `k_nev=${encodeURIComponent(k_nev)}&k_csop=${encodeURIComponent(k_csop)}`;
    xhr.send(params);
}
function megjelenitOsszes(osszdata){
    const div3 = document.getElementById('valasz_ablak');
    let today = new Date().toISOString().split("T")[0];
    let pluszkor;
    let osszeseves;
    let table = "<h3>Összes éves szbadság:</h3>";
    table += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Szülő Neve</th><th>Születési Év</th><th>Életkor</th><th>Gyerek(ek) Adatai</th><th>Gyerekek száma</th><th>Betegek száma</th><th>Alap szabadság</th><th>Életkor utáni szabadság</th><th>Gyerekek utáni szabadság</th><th>Beteg gyerek utáni szabadság</th><th>Éves összes Szabadság</th></tr>';
    for(const sor of osszdata){
        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=25 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 28){
            pluszkor = 1;
        }
        else{
            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=28 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 31){
                pluszkor = 2;
            }
            else{
                if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=31 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 33){
                    pluszkor = 3;
                }
                else{
                    if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=33 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 35){
                        pluszkor = 4;
                    }
                    else{
                        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=35 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 37){
                            pluszkor = 5;
                        }
                        else{
                            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=37 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 39){
                                pluszkor = 6;
                            }
                            else{
                                if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=39 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 41) {
                                    pluszkor = 7;
                                }
                                else{
                                    if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 41 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 43){
                                        pluszkor = 8;
                                    }
                                    else{
                                        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 43 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 45){
                                            pluszkor = 9;
                                        }
                                        else{
                                            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 45){
                                            pluszkor = 10;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        table += `<tr>
        <!--<td>${sor.szol_csoport}</td>-->
        <td class="left align-content">${sor.mv_nev}</td>
        <td class="align-content">${sor.mv_szuldatum.split("-")[0]}</td>
        <td class="align-content">${parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0])}</td>
        <td>${sor.gyerekek}</td>
        <td class="align-content">${sor.gyerek_szam}</td>
        <td class="align-content">${sor.beteg_szam}</td>
        <td class="align-content">${sor.alapszabadsag}</td>
        <td class="align-content">${pluszkor}</td>`;
        if((sor.gyerek_szam) < 1)
        {
            const plusznap = 0;
            table +=
            `<td class="align-content">${plusznap}</td>
            <td class="align-content">${sor.beteg_szam*2}</td>
            <td class="align-content">${(sor.alapszabadsag) + (pluszkor) + (plusznap) + (sor.beteg_szam*2)}</td>
            </tr>`;
        }
        else{
            if((sor.gyerek_szam) == 1){
                const plusznap = 2;
                table +=
                `<td class="align-content">${plusznap}</td>
                <td class="align-content">${sor.beteg_szam*2}</td>
                <td class="align-content">${(sor.alapszabadsag) + (pluszkor) + (plusznap) + (sor.beteg_szam*2)}</td>
                </tr>`;
            }
            else{
                if((sor.gyerek_szam) == 2){
                    const plusznap = 4;
                    table +=
                    `<td class="align-content">${plusznap}</td>
                    <td class="align-content">${sor.beteg_szam*2}</td>
                    <td class="align-content">${(sor.alapszabadsag) + (pluszkor) + (plusznap) + (sor.beteg_szam*2)}</td>
                    </tr>`;
                }
                else{
                    const plusznap = 7;
                    table +=
                    `<td class="align-content">${plusznap}</td>
                    <td class="align-content">${sor.beteg_szam*2}</td>
                    <td class="align-content">${(sor.alapszabadsag) + (pluszkor) + (plusznap) + (sor.beteg_szam*2)}</td>
                    </tr>`;
                }
            }
           
        }
    }
    table += '</div></table>'
    div3.innerHTML = table;
}
function szabadsageletkor()
{
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "szabadsageletkor.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const adat = JSON.parse(xhr.responseText);
                megjelenitTabla(adat);
            }
        }
    };
    xhr.send();
}

function megjelenitTabla(data)
{
    const div = document.getElementById('valasz_ablak');

    let today = new Date().toISOString().split("T")[0];
    let osszes;
    let tabla = "<h3>Életkor utáni szbadság:</h3>";
    tabla += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Név</th><th>Csoport</th><th>Születési datum</th><th>Kor</th><th>Alapszabadság</th><th>Összes Szabadság</th></tr>';
    for (const sor of data)
    {
        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=25 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 28){
            osszes = sor.alapszabadsag + 1;
        }
        else{
            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=28 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 31){
                osszes = sor.alapszabadsag + 2;
            }
            else{
                if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=31 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 33){
                    osszes = sor.alapszabadsag + 3;
                }
                else{
                    if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=33 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 35){
                        osszes = sor.alapszabadsag + 4;
                    }
                    else{
                        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=35 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 37){
                            osszes = sor.alapszabadsag + 5;
                        }
                        else{
                            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=37 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 39){
                                osszes = sor.alapszabadsag + 6;
                            }
                            else{
                                if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >=39 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 41) {
                                    osszes = sor.alapszabadsag + 7;
                                }
                                else{
                                    if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 41 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 43){
                                        osszes = sor.alapszabadsag + 8;
                                    }
                                    else{
                                        if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 43 && parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) < 45){
                                            osszes = sor.alapszabadsag + 9;
                                        }
                                        else{
                                            if(parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0]) >= 45){
                                            osszes = sor.alapszabadsag + 10;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        tabla += `<tr>
        <td class="left">${sor.mv_nev}</td>
        <td>${sor.szol_csoport}</td>
        <td>${sor.mv_szuldatum.split("-")[0]}</td>
        <td>${parseInt(today)-parseInt(sor.mv_szuldatum.split("-")[0])}</td>
        <td>${sor.alapszabadsag}</td>
        <td>${osszes}</td>
        </tr>`;
    }          
    tabla += '</div></table>'
    div.innerHTML = tabla;
}

function szabadsaggyerek(){
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'szabadsaggyerek.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const szadat = JSON.parse(xhr.responseText);
                megjelenitSzabi(szadat);
            }
        }
    };
    xhr.send();
    
}
function megjelenitSzabi(szdata){
    const div2 = document.getElementById('valasz_ablak');
    let table = "<h3>Gyerekek utáni szbadság:</h3>";
    table += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Szülő Neve</th><th>Gyerek(ek) Neve</th><th>Gyerekek száma</th><th>Betegek száma</th><th>Alapszabadság</th><th>Gyerekek utáni Szabadság</th><th>Beteg gyerek utáni szabadság</th><th>Összesen</th></tr>';
    for(const sor of szdata){
        
        table += `<tr>
        <td class="left">${sor.mv_nev}</td>
        <td>${sor.gyerekek}</td>
        <td>${sor.gyerek_szam}</td>
        <td>${sor.beteg_szam}</td>
        <td>${sor.alapszabadsag}</td>`;
        if((sor.gyerek_szam) < 1)
        {
            const plusznap = 0;
            table +=
            `<td>${plusznap}</td>
            <td>${sor.beteg_szam*2}</td>
            <td>${(plusznap) + (sor.beteg_szam*2) + (sor.alapszabadsag)}</td>
            </tr>`;
        }
        else{
            if((sor.gyerek_szam) == 1){
                const plusznap = 2;
                table +=
                `<td>${plusznap}</td>
                <td>${sor.beteg_szam*2}</td>
                <td>${(plusznap) + (sor.beteg_szam*2) + (sor.alapszabadsag)}</td>
                </tr>`;
            }
            else{
                if((sor.gyerek_szam) == 2){
                    const plusznap = 4;
                    table +=
                    `<td>${plusznap}</td>
                    <td>${sor.beteg_szam*2}</td>
                    <td>${(plusznap) + (sor.beteg_szam*2) + (sor.alapszabadsag)}</td>
                    </tr>`;
                }
                else{
                    const plusznap = 7;
                    table +=
                    `<td>${plusznap}</td>
                    <td>${sor.beteg_szam*2}</td>
                    <td>${(plusznap) + (sor.beteg_szam*2) + (sor.alapszabadsag)}</td>
                    </tr>`;
                
                }
            }
           
        }
    }
    table += '</div></table>'
    div2.innerHTML = table;
}