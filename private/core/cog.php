<?php
class Cog {
    function sql_prep($string) { // filtering or getting data ready for the query
        $db = Database::getInstance();
        $c = $db->getc();
        if($c) {
            return mysqli_real_escape_string($c, $string);
        } else {
            return addslashes($string);
        }
    }
    function j($string) { // json encoding
        return json_encode($string);
    }
    function u($string) { // filtering url
        return urlencode($string);
    }
}
?>
