<?php

if (isset($_GET['url'])) {

    $explode = explode('/', $_GET['url']);

    $name_page = $explode[0];

    if (is_file('pages/' . $name_page . '.php')) {
        include_once 'pages/' . $name_page . '.php';
    } else {
        include_once 'pages/error_404.php';
    }
} else {
    include_once 'pages/home.php';
}
