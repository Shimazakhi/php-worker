<?php

require '../boot.php';

header('Content-type:application/json;charset=utf-8');

$timezone = $_GET['timezone'] ?? 'Asia/Colombo';
$limit = $_GET['limit'] ?? 10;
$page = $_GET['page'] ?? 1;

\Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
    return $page;
});

$contacts = \HyveMobileTest\Models\Contact::whereOriginalTz($timezone)->paginate($limit);

$timezone = collect(['timezone' => $timezone]);

echo json_encode($timezone->merge($contacts));
