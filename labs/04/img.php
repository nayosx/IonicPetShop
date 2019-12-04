<?php
$img = 'img/';
$name = '';
$ext = '';
if (isset($_GET['name'])) {
    $name = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
    if(isset($_GET['ext'])) {
        $ext = strtolower(filter_var($_GET['ext'], FILTER_SANITIZE_STRING));
        if($ext == 'jpg') {
            header('Content-Type: image/jpeg');
        } else {
            header('Content-Type: image/png');
        }
        $img = $img . $name . '.' . $ext;
        readfile($img);
    } else {
        defualtImg();
    }
} else {
    defualtImg();
}

function defualtImg() {
    $img = 'img/logo.png';
    header('Content-Type: image/png');
    readfile($img);
    die();
}
