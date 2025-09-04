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
        var content_box = document.getElementById("success-box");
        document.getElementById("success-box").style.display = "none";
    }