function changePassForm()
{
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ugyintezes/jelszo_modositas_form.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("valasz_ablak").innerHTML = xhr.responseText;
            }
        }
    };
    xhr.send();
}
function changeVerify()
{
    var oldPassword = document.getElementById("tb_oldPassword").value;
    var newPassword = document.getElementById("tb_newPassword").value;
    var confirmPassword = document.getElementById("tb_confirmPassword").value;
    if (oldPassword === "" || newPassword === "" || confirmPassword === "" ) {
        error("Minden mező kitöltése kötelető!");
    }
    else {
        if (newPassword !== confirmPassword) {
            error("Az új jelszavak nem egyeznek meg!");
        }
        else {
            //Itt egy jelszó mentés fügvény meghívása, vagy valami ahol a jelszó_modsitas_kell == 'n'
            //successChange("A jelszavad sikeresen módosítva lett!");
            jelszoMentes();
        }
    }
}
function jelszoMentes()
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("oldPasssword", document.getElementById("tb_oldPassword").value);
    formData.append("newPassword", document.getElementById("tb_newPassword").value);

    xhr.open("POST", "ugyintezes/jelszo_mentes.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "mentve") {
                    //window.location.replace('index.php')
                    successChange("A jelszavad sikeresen módosítva lett!");
                }
                else{
                    error(xhr.responseText);
                }
            }
        }
    };
    xhr.send(formData);
}