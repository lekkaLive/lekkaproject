function frisit()
{
    document.getElementById("filters").style.display = "flex";
    document.getElementById("filterschild").style.display = "none";
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    const ker_nev = document.getElementById("ker_nev").value;
    const ker_csop = document.getElementById("ker_csop").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200)
            {
                document.getElementById('valasz_ablak').innerHTML = xhr.responseText;
            }
        }
    };

    const params = `ker_nev=${encodeURIComponent(ker_nev)}&ker_csop=${encodeURIComponent(ker_csop)}`;
    xhr.send(params);
}
// Oldal betöltésekor az összes tartalmat lekéri
//window.onload = frisit;

function szerkesztform($ertek)
{
    /*alert("a kapott ertek:" + $ertek);*/
    document.getElementById("filters").style.display = "none";
    const xhr = new XMLHttpRequest();
    const nev = $ertek;
    xhr.open("POST", "szerkesztform.php", true);
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
    const adat = `nev=${encodeURIComponent(nev)}`;
    xhr.send(adat);
}
function modificationValidate()
{
    let nev = document.getElementById("mv_nev").value;
    let szhely = document.getElementById("mv_szulhely").value;
    let szdatum = document.getElementById("mv_szuldatum").value;
    let lakcim = document.getElementById("mv_lakcim").value;
    let csoport = document.getElementById("szol_csoport").value
    let kezdes = document.getElementById("munkav_kezdete").value;
    let orvosi = document.getElementById("euervenyeseg").value;
    let pszicho = document.getElementById("pszichervenyeseg").value;
    let vizsga = document.getElementById("vizsgadatum").value;
    
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
            document.getElementById("alert-text2").innerHTML = "A születési hely mező kitöltés ekötelező!";
            document.getElementById("alert-text2").style.display = "block";
            isValid = false;
        }
        else
        {
            if (szhely.match(/\d+/) !== null)
            {
                document.getElementById("alert-text2").innerHTML = "A születési hely nem tartalmazhat számot";
                document.getElementById("alert-text2").style.display = "block";
                isValid = false;
            }
            else
            {
                if(szdatum === "")
                {
                    document.getElementById("alert-text3").innerHTML = "A születési dátumnak mező kitöltése kötelező";
                    document.getElementById("alert-text3").style.display = "block";
                    isValid = false;
                }
                else
                {
                    var today = new Date().toISOString().split("T")[0];
                    if(szdatum >= today)
                    {
                        document.getElementById("alert-text3").innerHTML = "A születési dátumnak a mai napnál régebbinek kell lennie";
                        document.getElementById("alert-text3").style.display = "block";
                        isValid = false;
                    }
                    else
                    {
                        if (lakcim === "" )
                        {
                            document.getElementById("alert-text4").innerHTML = "A lakcím mező kitöltése kötelező";
                            document.getElementById("alert-text4").style.display = "block";
                            isValid = false;
                        }
                        else
                        {
                            if (csoport === "")
                            {
                                document.getElementById("alert-text5").innerHTML = "A szolgálati csoport mező litöltése kötelező!";
                                document.getElementById("alert-text5").style.display = "block";
                                isValid = false;
                            }
                            else
                            {
                                if (isNaN(csoport) || csoport < 1 || csoport > 5)
                                {
                                    document.getElementById("alert-text5").innerHTML = "A szolgálati csoportok 1-5-ig vannak!";
                                    document.getElementById("alert-text5").style.display = "block";
                                    isValid = false;
                                }
                                else
                                {
                                    if (kezdes === "")
                                    {
                                        document.getElementById("alert-text6").innerHTML = "A munka kezdete mező kitöltése kötelező!";
                                        document.getElementById("alert-text6").style.display = "block";
                                        isValid = false;
                                    }
                                    else
                                    {
                                        if (orvosi === "")
                                        {
                                            document.getElementById("alert-text7").innerHTML = "Az ovosi érvényesség mező kitöltése kötelező!";
                                            document.getElementById("alert-text7").style.display = "block";
                                            isValid = false;
                                        }
                                        else
                                        {
                                            if (pszicho === "")
                                            {
                                                document.getElementById("alert-text8").innerHTML = "A pszicho érvényesség mező kitöltése kötelező!";
                                                document.getElementById("alert-text8").style.display = "block";
                                                isValid = false;
                                            }
                                            else
                                            {
                                                if (vizsga === "")
                                                {
                                                    document.getElementById("alert-text9").innerHTML = "A szakmai érvényesség mező kitöltése kötelező!";
                                                    document.getElementById("alert-text9").style.display = "block";
                                                    isValid = false;
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
        }
    }   
    if (isValid)
    {
        modify();
    }
    /*
    {
        error("Űrlapot nem lehet elküldeni!");
    }*/
}
function modify()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("eredeti_nev", document.getElementById("eredeti_nev").value)
    formData.append("mv_nev", document.getElementById("mv_nev").value);
    formData.append("mv_szulhely", document.getElementById("mv_szulhely").value);
    formData.append("mv_szuldatum", document.getElementById("mv_szuldatum").value);
    formData.append("mv_lakcim", document.getElementById("mv_lakcim").value);
    formData.append("szol_csoport", document.getElementById("szol_csoport").value);
    formData.append("munkav_kezdete", document.getElementById("munkav_kezdete").value);
    formData.append("euervenyeseg", document.getElementById("euervenyeseg").value);
    formData.append("pszichervenyeseg", document.getElementById("pszichervenyeseg").value);
    formData.append("vizsgadatum", document.getElementById("vizsgadatum").value);

    xhr.open("POST", "mentes.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200)
            {
                if(xhr.responseText === "success")
                {
                    window.location.href = "javascript:frisit()";
                }
                else
                {
                    document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
                }
            }
        }
    };
    xhr.send(formData);
}
function torol($ertek){

    const xhr = new XMLHttpRequest();
    const mv_nev = $ertek;
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState ===4)
        {
            if(xhr.status === 200)
            {
                if(xhr.responseText === "torolve")
                {
                    window.location.href = "javascript:frisit()";
                }
                else
                {
                    //document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
                    //window.location.href = "javascript:frisit()";
                }
            }
        }
    };
    const kit = `mv_nev=${encodeURIComponent(mv_nev)}`;
    xhr.send(kit);
}