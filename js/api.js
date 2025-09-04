function mvapi()
{
    document.getElementById("filtersapi").style.display = "flex";
    document.getElementById("filterschild").style.display = "none";
    document.getElementById("filteradmin").style.display = "none";
    document.getElementById("filters").style.display = "none";
    document.getElementById("filtersszabadsag").style.display = "none";

    const apinev = document.getElementById("apinev").value;
    const apicsoport = document.getElementById("apicsoport").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "apilista.php", true);
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

    const params = `apinev=${encodeURIComponent(apinev)}&apicsoport=${encodeURIComponent(apicsoport)}`;
    xhr.send(params);
}
// Oldal betöltésekor az összes tartalmat lekéri
//window.onload = frisit;