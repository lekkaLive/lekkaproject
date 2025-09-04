function frisitadmin()
{
    document.getElementById("filters").style.display = "none";
    document.getElementById("filterschild").style.display = "none";
    document.getElementById("filteradmin").style.display = "flex";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    const adminnev = document.getElementById("adminnev").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend_json_admin.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200)
            {
                const adminadat = JSON.parse(xhr.responseText);
                kiir(adminadat);
            }
        }
    };

    const params = `adminnev=${encodeURIComponent(adminnev)}`;
    xhr.send(params);
}

function kiir(adminadatok)
{
    const div = document.getElementById('valasz_ablak');
    if(adminadatok.length === 0)
    {
    div.innerHTML = "<p>Nincs találat.</p>";
    return;
    }
    let tabla = "<h3>Ügyintézők tábla:</h3>";
    tabla += '<div class="container"><table class="table table-striped table-bordered table-sm table-hover"><tr class="table-success"><th>Név</th><th>Felhasználói név</th><th>Aktív</th><th>Email cím</th><th>Jogkör</th></tr>';
    for (const sor of adminadatok)
    {
        tabla += `<tr>
                    <td class="left"><a href = "javascript:adminszerkesztform('${sor.valodi_nev}')">${sor.valodi_nev}</td>
                    <td>${sor.nev}</td>
                    <td>${sor.aktiv}</td>
                    <td>${sor.email}</td>`;
        if(sor.jogkor == 'k'){
            tabla += `<td>Kolléga</td>`;
        }
        else{
            if(sor.jogkor == 'r'){
                tabla += `<td>Rendszergazda</td>`
            }
            else{
                tabla += `<td>Vezető</td>`
            }
        }
        tabla +=`
                </tr>`;
    }          
    tabla += '</div></table>';
    div.innerHTML = tabla;
}

function adminszerkesztform($valodi_nev)
{
    document.getElementById("filteradmin").style.display = "none";
    const xhr = new XMLHttpRequest();
    const valodi_nev = $valodi_nev;
    xhr.open("POST", "adminszerkesztform.php", true);
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
    const adminadat = `valodi_nev=${encodeURIComponent(valodi_nev)}`;
    xhr.send(adminadat);
}

function adminmodificationValidate()
{
    let valodi_nev = document.getElementById("valodi_nev").value;
    let felhaszn_nev = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let jogkor = document.getElementById("jogkor").value;
    let aktiv = document.querySelector('input[name="aktiv"]:checked');
    
    let isValid = true;
    if (valodi_nev === "")
    {
        alerttext("A név mező kitoltése kötelező!");
        isValid = false;
    }
    else
    {
        if(felhaszn_nev === "")
        {
            document.getElementById("alert-textUsername").innerHTML = "A felhasználói név mező kitöltés ekötelező!";
            document.getElementById("alert-textUsername").style.display = "block";
            isValid = false;
        }
        else
        {
            if (email === "")
            {
                document.getElementById("alert-textEmail").innerHTML = "Az email cím megadása ekötelező!";
                document.getElementById("alert-textEmail").style.display = "block";
                isValid = false;
            }
            else
            {
                if(jogkor === "")
                {
                    document.getElementById("alert-textJogkor").innerHTML = "Jogkör megadása kötelező!";
                    document.getElementById("alert-textJogkor").style.display = "block";
                    isValid = false;
                }
                else
                {
                    if (!aktiv)
                    {
                        document.getElementById("alert-textBeteg").innerHTML = 'Válasszon!';
                        document.getElementById("alert-textBeteg").style.display = "block";
                        return false;
                    }
                }
            }
        }
    }  
    if (isValid)
    {
        adminmodify();
    }
}
function adminmodify()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    var inputElement = document.querySelector('input[name="aktiv"]:checked');
    formData.append("eredeti_nev", document.getElementById("eredeti_nev").value);
    formData.append("valodi_nev", document.getElementById("valodi_nev").value);
    formData.append("username", document.getElementById("username").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("jogkor", document.getElementById("jogkor").value);
    formData.append("aktiv", inputElement.value);

    xhr.open("POST", "adminmentes.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200)
            {
                if(xhr.responseText === "success")
                {
                    window.location.href = "javascript:frisitadmin()";
                }
                else
                {
                    document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
                    //window.location.href = "javascript:frisitadmin()";
                }
            }
        }
    };
    xhr.send(formData);
}