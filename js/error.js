function error(hibaszoveg)
{
    var content_box = document.getElementById("error-box");
    content_box.innerHTML = hibaszoveg;
    content_box.innerHTML += "<br><br>";
    content_box.innerHTML += "<input type=\"button\" onclick=\"closeError()\" value=\"Bezár\">";
    document.getElementById("error-box").style.display = "block";
}
function closeError()
{
    document.getElementById("error-box").style.display = "none";
}

function errorExpire(szoveg)
{
    var content_box = document.getElementById("error-box");
    content_box.innerHTML = szoveg;
    content_box.innerHTML += "<br><br>";
    content_box.innerHTML += "<input type=\"button\" onclick=\"closeErrorExpire()\" value=\"OK\">";
    document.getElementById("error-box").style.display = "block";
}
function closeErrorExpire()
{
    //document.getElementById("error-box").style.display = "none";
    changePassForm();
}

function alerttext(nevalert)
{
    let nevalertText = document.querySelector("span.alert-text");
    nevalertText.innerHTML = nevalert;
    document.querySelector("span.alert-text").style.display = "block";
}    

function closeNevAlerttext()
{
    document.querySelector("span.alert-text").style.display = "none";
}

function closeAlerttextSzulhely()
{
    document.getElementById("alert-textSzulhely").style.display = "none";
}
function closeAlerttextSzuldatum()
{
    document.getElementById("alert-textSzuldatum").style.display = "none";
    document.getElementById("tb_birthDate").style.backgroundColor = "unset";
}
function closeAlerttextCim()
{
    document.getElementById("alert-textCim").style.display = "none";
    document.getElementById("tb_password").style.backgroundColor = "unset";
}
function closeAlerttextCsoport()
{
    document.getElementById("alert-textCsoport").style.display = "none";
    document.getElementById("tb_passwordConfirm").style.backgroundColor = "unset";
}
function closeAlerttextKezdes()
{
    document.getElementById("alert-textKezdes").style.display = "none";
    
}
function closeAlerttextEu()
{
    document.getElementById("alert-textEu").style.display = "none";
}
function closeAlerttextPszicho()
{
    document.getElementById("alert-textPszicho").style.display = "none";
}
function closeAlerttextVizsga()
{
    document.getElementById("alert-textVizsga").style.display = "none";
}
function closeAlerttextBeteg()
{
    document.getElementById("alert-textBeteg").style.display = "none";
}
function closeAlerttextUsername()
{
    document.getElementById("alert-textUsername").style.display = "none";
}
function closeAlerttextEmail()
{
    document.getElementById("alert-textEmail").style.display = "none";
}
function closeAlerttextJogkor()
{
    document.getElementById("alert-textJogkor").style.display = "none";
}
