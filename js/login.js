function loginForm()
{
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "belepform.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
            }
        }
    };
    xhr.send();
}

function verify()
{
    var username = document.getElementById("tb_username").value;
    var password = document.getElementById("tb_password").value;
    if (username === "" || password === "") {
        error("Minden mező kitöltése kötelető!");
    }
    else {
        var beleegyezes = document.getElementById("chk_beleegyez");
        if (beleegyezes.checked) {
            login();
        }
        else {
            error("Fogadd el a feltételeket!");
        }
    }
}
function login()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("username", document.getElementById("tb_username").value);
    formData.append("password", document.getElementById("tb_password").value);

    xhr.open("POST", "belep.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "success") {
                    window.location.replace('index.php')
                }
                else{
                    if(xhr.responseText === "jelszomodositas"){
                        changePassForm();
                    }
                    else{
                        if(xhr.responseText === "Az ön jelszava lejárt, kérem módosítsa!!"){
                            errorExpire(xhr.responseText);
                        }
                        else{
                            error(xhr.responseText);
                        }
                    }
                }
            }
        }
    };
    xhr.send(formData);
}