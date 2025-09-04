function orvosi(){
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    /*const k_nev = document.getElementById("k_nev").value;
    const k_csop = document.getElementById("k_csop").value;*/

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adatkeres/orvosi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

     xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const euadat = JSON.parse(xhr.responseText);
                megjelenitOrvosi(euadat);
            }
        }
    };
    /*const params = `k_nev=${encodeURIComponent(k_nev)}&k_csop=${encodeURIComponent(k_csop)}`;*/
    xhr.send();
}
function megjelenitOrvosi(orvosi){
    const div = document.getElementById('valasz_ablak');
    let maidatum = new Date().toISOString().split("T")[0];

    let table = "<h3>Orvosi alkalmassági érvényasség:</h3>";
    table += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Csoport</th><th>Munkavállaló neve</th><th>Orvosi alkalmasság érvényaessége</th></tr>';
    for(const sor of orvosi){
        if((parseInt(sor.orvosi_alk_ervenyessege)) <= parseInt(maidatum))
        {
            table += `<tr>
            <td>${sor.szol_csoport}</td>
            <td class="left" style=\"background-color: red;\">${sor.mv_nev}</td>
            <td style=\"background-color: red;\">${sor.orvosi_alk_ervenyessege}</td>
            </tr>`;
        }
        else{
            table += `<tr'>
            <td>${sor.szol_csoport}</td>
            <td class="left">${sor.mv_nev}</td>
            <td>${sor.orvosi_alk_ervenyessege}</td>
            </tr>`;
        }
    }
    table += '</div></table>'
    div.innerHTML = table;
}

function szakmai(){
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    /*const k_nev = document.getElementById("k_nev").value;
    const k_csop = document.getElementById("k_csop").value;*/

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adatkeres/orvosi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

     xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const szakma = JSON.parse(xhr.responseText);
                megjelenitSzakmai(szakma);
            }
        }
    };
    /*const params = `k_nev=${encodeURIComponent(k_nev)}&k_csop=${encodeURIComponent(k_csop)}`;*/
    xhr.send();
}
function megjelenitSzakmai(szakmai){
    const div = document.getElementById('valasz_ablak');
    let maidatum = new Date().toISOString().split("T")[0];

    let table = "<h3>Legutóbbi szakmai vizsga időpontja:</h3>";
    table += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Csoport</th><th>Munkavállaló neve</th><th>Legutóbbi szakmai vizsga időpontja</th></tr>';
    for(const sor of szakmai){
        if(parseInt(maidatum)-(parseInt(sor.szakmai_vizsga_datuma)) == 2)
        {
            table += `<tr>
            <td>${sor.szol_csoport}</td>
            <td class="left" style=\"background-color: red;\">${sor.mv_nev}</td>
            <td style=\"background-color: red;\">${sor.szakmai_vizsga_datuma}</td>
            </tr>`;
        }
        else{
            table += `<tr'>
            <td>${sor.szol_csoport}</td>
            <td class="left">${sor.mv_nev}</td>
            <td>${sor.szakmai_vizsga_datuma}</td>
            </tr>`;
        }
    }
    table += '</div></table>'
    div.innerHTML = table;
}
function pszicho(){
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterschild').style.display = 'none';
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    /*const k_nev = document.getElementById("k_nev").value;
    const k_csop = document.getElementById("k_csop").value;*/

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adatkeres/orvosi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

     xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                const pszicoadat = JSON.parse(xhr.responseText);
                megjelenitPszicho(pszicoadat);
            }
        }
    };
    /*const params = `k_nev=${encodeURIComponent(k_nev)}&k_csop=${encodeURIComponent(k_csop)}`;*/
    xhr.send();
}
function megjelenitPszicho(pszicho){
    const div = document.getElementById('valasz_ablak');
    let maidatum = new Date().toISOString().split("T")[0];

    let table = "<h3>Pszicho alkalmassági érvényasség:</h3>";
    table += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success sticky"><th>Csoport</th><th>Munkavállaló neve</th><th>Pszichológia alkalmassági érvényasség</th></tr>';
    for(const sor of pszicho){
        if((parseInt(sor.pszich_alk_ervenyessege)) <= parseInt(maidatum))
        {
            table += `<tr>
            <td>${sor.szol_csoport}</td>
            <td class="left" style=\"background-color: red;\">${sor.mv_nev}</td>
            <td style=\"background-color: red;\">${sor.pszich_alk_ervenyessege}</td>
            </tr>`;
        }
        else{
            table += `<tr'>
            <td>${sor.szol_csoport}</td>
            <td class="left">${sor.mv_nev}</td>
            <td>${sor.pszich_alk_ervenyessege}</td>
            </tr>`;
        }
    }
    table += '</div></table>'
    div.innerHTML = table;
}