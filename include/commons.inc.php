<?php
/**
 * Created by PhpStorm.
 * User: haochuan
 * Date: 2016/3/11
 * Time: 11:51
 */
if (!defined('ROOT'))
    define("ROOT", str_replace("\\", "/", dirname(dirname(__FILE__))) . '/');

include_once ROOT . "config/database.inc.php";
include_once ROOT . "dao/MysqliDb.class.php";

$db = MysqliDb::getInterface($config);


