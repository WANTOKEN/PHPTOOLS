<?php
function generateGtk()
{
    $cookie = "@pzeU80nBK";
    $_COOKIE["skey"] = $cookie;
    $ASCIICode = 0;
    $hash = 5381;
    if (!empty($_COOKIE["skey"])) {
        $skey = $_COOKIE["skey"];
        for ($i = 0, $len = strlen($skey); $i < $len; ++$i) {
            $ASCIICode = ord(substr($skey, $i, 1));
            $hash += (($hash << 5) + $ASCIICode);
            $hash = $hash & 0x7fffffff;
        }
        $str = strval($hash);
        return $str;
    } else {
        return false;
    }
}
echo generateGtk();