<?php

function addWwwToUrl($url) {

    $bits = parse_url($url);
 
    $newHost = substr($bits["host"],0,4) !== "www." ? "www." . $bits["host"] : $bits["host"];
 
    $newUrl = $bits["scheme"]. "://" . 
    $newHost . (isset($bits["port"]) ? ":" . $bits["port"] : "" ) . 
    (isset($bits["path"]) ? "" . $bits["path"] : "" ) . 
    (!empty($bits["query"])? "?" . $bits["query"]: "");
 
    return $newUrl;
 }