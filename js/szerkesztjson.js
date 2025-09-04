function frisitgyerek()
{
    document.getElementById("filters").style.display = "none";
    document.getElementById("filterschild").style.display = "flex";
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    const nev = document.getElementById("nev").value;
    const ker_datum = document.getElementById("ker_datum").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend_json.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200)
            {
                const data = JSON.parse(xhr.responseText);
                megjelenit(data);
            }
        }
    };

    const params = `nev=${encodeURIComponent(nev)}&ker_datum=${encodeURIComponent(ker_datum)}`;
    xhr.send(params);
}
// Oldal betöltésekor az összes tartalmat lekéri
//window.onload = frisitgyerek;
function megjelenit(adatok)
{
    const div = document.getElementById('valasz_ablak');
    if(adatok.length === 0)
        {
        div.innerHTML = "<p>Nincs találat.</p>";
        return;
        }
        let tabla = "<h3>Gyerekek tábla:</h3>";
        tabla += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success"><th>Név</th><th>Születési hely</th><th>Születési dátum</th><th>Lakcím</th><th>Betegség</th></tr>';
        for (const sor of adatok)
        {
            tabla += `<tr>
                        <td class="left"><a href = "javascript:gyszerkesztform('${sor.gy_nev}')">${sor.gy_nev}</td>
                        <td>${sor.gy_szulhely}</td>
                        <td>${sor.gy_szuldatum}</td>
                        <td>${sor.gy_lakcim}</td>
                        <td>${sor.tartosbeteg}</td>
                    </tr>`;
        }          
        tabla += '</div></table>';
        div.innerHTML = tabla;
}
function gyszerkesztform($gy_nev)
{
    document.getElementById("filterschild").style.display = "none";
    const xhr = new XMLHttpRequest();
    const gynev = $gy_nev;
    xhr.open("POST", "gyszerkesztform.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState ===4)
        {
            if(xhr.status === 200)
            {
                document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
            }
        }
    };
    const gyadat = `gynev=${encodeURIComponent(gynev)}`;
    xhr.send(gyadat);
}
function gymodificationValidate()
{
    let nev = document.getElementById("gy_nev").value;
    let szhely = document.getElementById("gy_szulhely").value;
    let szdatum = document.getElementById("gy_szuldatum").value;
    let lakcim = document.getElementById("gy_lakcim").value;
    let beteg = document.querySelector('input[name="beteg"]:checked');
    
    let isValid = true;
    if (nev === "")
    {
        alerttext("A név mező kitoltése kötelező!");
        isValid = false;
    }
    else
    {
        if(szhely === "")
        {
            document.getElementById("alert-textSzulhely").innerHTML = "A születési hely mező kitöltés ekötelező!";
            document.getElementById("alert-textSzulhely").style.display = "block";
            isValid = false;
        }
        else
        {
            if (szhely.match(/\d+/) !== null)
            {
                document.getElementById("alert-textSzulhely").innerHTML = "A születési hely nem tartalmazhat számot";
                document.getElementById("alert-textSzulhely").style.display = "block";
                isValid = false;
            }
            else
            {
                if(szdatum === "")
                {
                    document.getElementById("alert-textSzuldatum").innerHTML = "A születési dátum mező kitöltése kötelező";
                    document.getElementById("alert-textSzuldatum").style.display = "block";
                    isValid = false;
                }
                else
                {
                    var today = new Date().toISOString().split("T")[0];
                    if(szdatum >= today)
                    {
                        document.getElementById("alert-textSzuldatum").innerHTML = "A születési dátumnak a mai napnál régebbinek kell lennie";
                        document.getElementById("alert-textSzuldatum").style.display = "block";
                        isValid = false;
                    }
                    else
                    {
                        if (lakcim === "" )
                        {
                            document.getElementById("alert-textCim").innerHTML = "A lakcím mező kitöltése kötelező";
                            document.getElementById("alert-textCim").style.display = "block";
                            isValid = false;
                        }
                        else
                        {
                            if (!beteg)
                            {
                                document.getElementById("alert-textBeteg").innerHTML = 'Válasszon!';
                                document.getElementById("alert-textBeteg").style.display = "block";
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }  
    if (isValid)
    {
        gymodify();
    }
}
function gymodify()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    var inputElement = document.querySelector('input[name="beteg"]:checked');
    formData.append("eredeti_nev", document.getElementById("eredeti_nev").value);
    formData.append("gy_nev", document.getElementById("gy_nev").value);
    formData.append("gy_szulhely", document.getElementById("gy_szulhely").value);
    formData.append("gy_szuldatum", document.getElementById("gy_szuldatum").value);
    formData.append("gy_lakcim", document.getElementById("gy_lakcim").value);
    formData.append("beteg", inputElement.value);

    xhr.open("POST", "gymentes.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200)
            {
                if(xhr.responseText === "success")
                {
                    window.location.href = "javascript:frisitgyerek()";
                }
                else
                {
                    //document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
                    window.location.href = "javascript:frisitgyerek()";
                }
            }
        }
    };
    xhr.send(formData);
}
//window.onload = frisitgyerek;