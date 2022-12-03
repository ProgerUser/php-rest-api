<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/wordlist.php';

$database = new Database();
$db = $database->getConnection();

$item = new WordList($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getSingleWord();

if ($item->word != null) {
    // create array
    $emp_arr = array(
        "id" => $item->id,
        "word" => $item->word,
        "translate" => $item->translate,
        "dict_ref" => $item->dict_ref,
        "created_at" => $item->created_at,
        "updated_at" => $item->updated_at
    );

    http_response_code(200);
    echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Employee not found.");
}
?>