<?php
function init_view_data($scripts, $js_contants, $load_data_ajax)
{
    $CI = &get_instance();
    set_cookie('return_url', current_url(), '3600');
    $vars['scripts'] = $scripts;
    $vars['js_contants'] = $js_contants;
    $vars['load_data_ajax'] = $load_data_ajax;
    $vars['CURRENT_METHOD'] = $CI->router->fetch_method();
    $vars['CURRENT_CONTROLLER'] = $CI->router->fetch_class();
    return $vars;
}

function init_js_constants($js_contants)
{
    $CI = &get_instance();
    echo '<script>';
    echo "const BASE_URL='" . base_url() . "';";
    echo "const USER_BASE_URL='" . base_url($CI->router->fetch_class()) . "';";
    if (isset($js_contants)) {
        if (is_array($js_contants)) {
            foreach ($js_contants as $key => $value) {
                echo "const " . $key . "='" . $value . "';";
            }
        }
    }
    echo '</script>';
}

function init_js_view_data_by_ajax($load_data_ajax)
{
    if (isset($load_data_ajax)) {
        if (is_array($load_data_ajax)) {
            echo "<script>let JS_ViewData={};";
            echo "$(document).ready(function () {";
            foreach ($load_data_ajax as $data) {
                echo "AjaxPost(new FormData(), `" . $data['url'] . "`, AjaxSuccess, AjaxError,'" . $data['var_name'] . "');";
            }
            echo "function AjaxSuccess(content,varname) {let result = JSON.parse(content);if (result.error) {} else if (result.success) {JS_ViewData[varname] = result.result;}}});</script>";
        }
    }
}

function init_js_scripts($scripts)
{
    if (isset($scripts)) {
        if (is_array($scripts)) {
            foreach ($scripts as $src) {
                echo "<script src='" . base_url($src) . "?d=" . date("Ymdhis") . "'></script>";
            }
        } else {
            echo "<script src='" . base_url($scripts) . "?d=" . date("Ymdhis") . "'></script>";
        }
    }
}

function card_color_logo($report_type){
    if(isset($report_type)){
        if(strtolower($report_type) == 'wellness'){
            return array('border'=> "primary","icon"=> 'fas fa-medkit');
        } elseif (strtolower($report_type) == 'skin') {
            return array('border' => "warning", "icon" => 'fas fa-female');
        } elseif (strtolower($report_type) == 'cardiomet') {
            return array('border' => "danger", "icon" => 'fas fa-heartbeat');
        }else{
            return False;
        }
    }
}
