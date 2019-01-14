<?php

require '../boot.php';

header('Content-type:application/json;charset=utf-8');

$limit = $_GET['limit'] ?? 10;
$page = $_GET['page'] ?? 1;

\Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
    return $page;
});

echo json_encode(\HyveMobileTest\Models\Contact::paginate($limit));
