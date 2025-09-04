function success(successText)
    {
        var content_box = document.getElementById("success-box");
        content_box.innerHTML = successText;
        content_box.innerHTML += "<br><br>";
        content_box.innerHTML += "<input type=\"button\" onclick=\"closeSuccess()\" value=\"Bezár\">";
        document.getElementById("success-box").style.display = "block";
    }

function closeSuccess()
    {
        document.getElementById("success-box").style.display = "none";
    }

function successChange(text)
{
    var content_box = document.getElementById("success-box");
    content_box.innerHTML = text;
    content_box.innerHTML += "<br><br>";
    content_box.innerHTML += "<input type=\"button\" onclick=\"OkSuccessChange()\" value=\"Bezár\">";
    document.getElementById("success-box").style.display = "block";
}

function OkSuccessChange()
    {
        document.getElementById("success-box").style.display = "none";
        loginForm();
    }