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
    $USERAGENT = $_SERVER['HTTP_USER_AGENT'];
    
    $opts = array('http'=>array('header'=>"User-Agent: $USERAGENT\r\n"));
    $context = stream_context_create($opts);

    // get the json response
    $resp_json = file_get_contents($url, false, $context);

    // decode the json
    $resp = json_decode($resp_json, true);

    if(!empty($resp)) {
        return array(floatval($resp[0]['lat']), floatval($resp[0]['lon']), $name);
    } else {
        return array();
    }

}
?>
