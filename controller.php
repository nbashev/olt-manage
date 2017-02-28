<?php
/**
 * Created by PhpStorm.
 * User: Liang
 * Date: 16-9-28
 * Time: 下午1:35
 */

//禁止直接访问
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('HTTP/1.1 403');
    exit();
}
require_once('./class/OLT.php');
$olt = new \OLT\olt();

$brand = $_POST['brand'];
$ip = $_POST['ip'];
$username = $_POST['username'];
$password = $_POST['password'];
$enpassword = $_POST['enpassword'];
$mac = $_POST['mac'];
$device = $_POST['device'];
if ($brand == 'green') {
    $result = $olt->green($ip, $username, $password, $enpassword, $mac, $device);
} elseif ($brand == 'raisecom') {
    $result = $olt->raisecom($ip, $username, $password, $enpassword, $mac, $device);
} elseif ($brand == 'zte') {
    $result = $olt->zte($ip, $username, $password, $mac, $device);
}

echo json_encode($result);
