<?php
function code_generate()
{
    $code = "";
    
    for ($i=0; $i<16; $i++)
    {    
        $szam = rand(1,64);
        if ($szam == 1)
            $code .= "!";
        if ($szam == 2)
            $code .= "+";
        if (($szam >= 3) && ($szam <= 12))
            $code .= chr($szam + 45);
        if (($szam >= 13) && ($szam <= 38))
            $code .= chr($szam + 52);
        if (($szam >= 39) && ($szam <= 64))
            $code .= chr($szam + 58);
    }
    return $code;
}
?>