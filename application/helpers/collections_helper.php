<?php
defined('REG_TYPE_COMPANY')      OR define('REG_TYPE_COMPANY', 'company');
defined('REG_TYPE_INDIVIDUAL')      OR define('REG_TYPE_INDIVIDUAL', 'individual');
function get_registration_types()
{
    $val = array(REG_TYPE_COMPANY,REG_TYPE_INDIVIDUAL);
    return $val;
}



