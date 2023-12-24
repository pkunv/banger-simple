<?php
header('Content-Type: application/json');

$data = [["content" => "Hello world!"]];

echo json_encode($data, JSON_UNESCAPED_UNICODE);
