<?php
include_once "MysqliDb.php";
include_once "AttributeModel.php";
include_once "ProductModel.php";

error_reporting(E_ERROR |E_PARSE);

if ($_SERVER['SERVER_ADDR']=="127.0.0.1") {
	$db = new MysqliDb('localhost', 'root', 'password', 'minishop_test');
} else {
	$db = new MysqliDb('localhost', 'username', 'password', 'minishop_test');
}


