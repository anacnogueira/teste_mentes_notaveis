<?php
include_once '../core.php';
include_once '../config/database.php';
include_once '../src/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);