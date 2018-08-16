<?php
$q = filter_input(INPUT_POST, 'key');
if ($q) {
    $param = array(
        'mode'     => 'search',
        'act'      => 'location',
        'output'   => 'json',
        'callback' => 'set_data',
        'profile'  => 'template_2',
        'q'        => $q,
    );
    $url = 'http://www.streetdirectory.com//api/?' . http_build_query($param);
    echo getContents($url);
} else {
    echo 0;
}
function getContents($url){
    $setting = array("http" => array("timeout" => 5));
    if ($_SERVER['HTTP_HOST'] == '172.16.64.198') {
        $setting["http"] += array(
            "proxy" => "172.26.67.100:80",
            "request_fulluri" => true ,
        );
    }
    $context = stream_context_create($setting);
    if($result = @file_get_contents($url, false, $context)){
        return $result;
    } else {
        return 0;
    }
}


    /*tested locally*/
/*function getContents($url){
    $setting = array("http" => array("timeout" => 5));
    if ($_SERVER['HTTP_HOST'] == '127.0.0.1') {
        $setting["http"] += array(
            "proxy" => "172.0.0.1:80",
            "request_fulluri" => true ,
        );
    }
    $context = stream_context_create($setting);
    if($result = @file_get_contents($url, false, $context)){
        return $result;
    } else {
        return 0;
    }
}*/