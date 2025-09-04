function uploadform()
{
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filterschild").style.display = "none";
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filters").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "felvitelform.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
            }
        }
    };
    xhr.send();
}
function uploadvalidate()
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
                            if (csoport === "")
                            {
                                document.getElementById("alert-textCsoport").innerHTML = "A szolgálati csoport mező litöltése kötelező!";
                                document.getElementById("alert-textCsoport").style.display = "block";
                                isValid = false;
                            }
                            else
                            {
                                if (isNaN(csoport) || csoport < 1 || csoport > 5)
                                {
                                    document.getElementById("alert-textCsoport").innerHTML = "A szolgálati csoportok 1-5-ig vannak!";
                                    document.getElementById("alert-textCsoport").style.display = "block";
                                    isValid = false;
                                }
                                else
                                {
                                    if (kezdes === "")
                                    {
                                        document.getElementById("alert-textKezdes").innerHTML = "A munka kezdete mező kitöltése kötelező!";
                                        document.getElementById("alert-textKezdes").style.display = "block";
                                        isValid = false;
                                    }
                                    else
                                    {
                                        if (orvosi === "")
                                        {
                                            document.getElementById("alert-textEu").innerHTML = "Az ovosi érvényesség mező kitöltése kötelező!";
                                            document.getElementById("alert-textEu").style.display = "block";
                                            isValid = false;
                                        }
                                        else
                                        {
                                            if (pszicho === "")
                                            {
                                                document.getElementById("alert-textPszicho").innerHTML = "A pszicho érvényesség mező kitöltése kötelező!";
                                                document.getElementById("alert-textPszicho").style.display = "block";
                                                isValid = false;
                                            }
                                            else
                                            {
                                                if (vizsga === "")
                                                {
                                                    document.getElementById("alert-textVizsga").innerHTML = "A szakmai érvényesség mező kitöltése kötelező!";
                                                    document.getElementById("alert-textVizsga").style.display = "block";
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
        upload();
    }
    /*else
    {
        error("Űrlapot nem lehet elküldeni!");
    }*/
    
}
function upload()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("mv_nev", document.getElementById("mv_nev").value);
    formData.append("mv_szulhely", document.getElementById("mv_szulhely").value);
    formData.append("mv_szuldatum", document.getElementById("mv_szuldatum").value);
    formData.append("mv_lakcim", document.getElementById("mv_lakcim").value);
    formData.append("szol_csoport", document.getElementById("szol_csoport").value);
    formData.append("munkav_kezdete", document.getElementById("munkav_kezdete").value);
    formData.append("euervenyeseg", document.getElementById("euervenyeseg").value);
    formData.append("pszichervenyeseg", document.getElementById("pszichervenyeseg").value);
    formData.append("vizsgadatum", document.getElementById("vizsgadatum").value);

    xhr.open("POST", "felvitel.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200)
            {
                if(xhr.responseText === "success")
                {
                    window.location.href = "javascript:frisit()"; //szerkeszt.js
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
function childuploadform()
{
    document.getElementById("filtersapi").style.display = "none";
    document.getElementById("filterschild").style.display = "none";
    document.getElementById("filters").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "gyfelvitelform.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
            }
        }
    };
    xhr.send();
}
function childuploadvalidate()
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
        childupload();
    }
    /*else
    {
        error("Űrlapot nem lehet elküldeni!");
    }*/
}
function childupload()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    var inputElement = document.querySelector('input[name="beteg"]:checked')
    formData.append("gy_nev", document.getElementById("gy_nev").value);
    formData.append("gy_szulhely", document.getElementById("gy_szulhely").value);
    formData.append("gy_szuldatum", document.getElementById("gy_szuldatum").value);
    formData.append("gy_lakcim", document.getElementById("gy_lakcim").value);
    formData.append("beteg", inputElement.value);

    xhr.open("POST", "gyfelvitel.php", true);
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
                    document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
                }
            }
        }
    };
    xhr.send(formData);
}