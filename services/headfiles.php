<?php

function headfiles($filename, $options) {
    $pageinfo = array(
        'active_tab' => 1,
        'scripts' => array(),
        'styles' => array()
    );

    $_base = '/assets';
    $_base_css = "$_base/css/";
    $_base_js = "$_base/js/";
    $_pagination = $options['pagination'] ?? false;
    $_active_tab = $options['active_tab'] ?? 1;
    $_double_pagination = $options['pagination_double'] ?? false;
    $_banner = $options['banner'] ?? false;
    $_pagination_button_text = $options['pagination_button_text'] ?? '';

    array_push($pageinfo['styles'], $_base_css . $filename . '.css');
    if($_pagination) array_push($pageinfo['scripts'], $_base_js . 'pagination.js');
    array_push($pageinfo['scripts'], $_base_js . $filename . '.js');
    array_push($pageinfo['scripts'], $_base_js . 'dropdown' . '.js');
    if($_banner) array_push($pageinfo['scripts'], $_base_js . 'banner.js');
    $pageinfo['active_tab'] = $_active_tab;
    $pageinfo['pagination_double'] = $_double_pagination;
    $pageinfo['banner'] = $_banner;
    $pageinfo['pagination_button_text'] = $_pagination_button_text;
    
    return $pageinfo;
}
