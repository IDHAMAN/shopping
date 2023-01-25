<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/shop.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$shop = new shop ($conn);
$shop->id = isset($_GET['id']) ? $_GET['id'] : die();

$shop->get();

$response = [];

if ($request == 'GET') {
    if ($shop->id != null) {
        $data[] = array('id' => $shop->id,'nama' => $shop->nama,'ukuran' => $shop->ukuran,'harga' => $shop->harga,);
        $response = array('status' =>  array('messsage' => 'Success', 'code' => http_response_code(200)),'data' => $data);
    } else {
        http_response_code(404);
        $response = array('status' =>  array('messsage' => 'No Data Found', 'code' => http_response_code()));
    }
} else {
    http_response_code(405);
    $response = array('status' =>  array('messsage' => 'Method Not Allowed', 'code' => http_response_code()));
}

echo json_encode($response);