<?php
function sanitize($var) {
    $sanitized = strip_tags($var);
    $sanitized = str_replace('"', "", $sanitized);
    $sanitized = str_replace("'", "", $sanitized);
    $sanitized = str_replace("<", "", $sanitized);
    $sanitized = str_replace(">", "", $sanitized);
    return $sanitized;
}

function geocode($address, $name){

    // url encode the address
    $address = urlencode($address);

    $url = "http://nominatim.openstreetmap.org/?format=json&addressdetails=1&q={$address}&format=json&limit=1";

    // get the json response
    $resp_json = file_get_contents($url);

    // decode the json
    $resp = json_decode($resp_json, true);

    if(!empty($resp)) {
        #return array(floatval($resp[0]['lat']), floatval($resp[0]['lon']), $name);
        return $resp;
    } else {
        #return array();
        return $resp;
    }

}
?>
