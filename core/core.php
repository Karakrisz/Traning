<?php

$size = $_GET['size'] ?? 15;
$page = $_GET['page'] ?? 1;

$possibilePageSizes = [10, 25, 30, 40, 50];

$pictures = array_fill(0, 100,     [
    'title' => 'Random kép',
    'thumbnail' => 'https://picsum.photos/200/200'
]);

$content = array_slice($pictures, ($page - 1) * $size, $size);

function paginate($total, $currentPage, $size)
{
    $page = 0;
    $markap = "";
    if ($currentPage > 1) {
        $previousPage = $currentPage - 1;
        $markap .=
            "<li class=\"page-item\">
     <a class=\"page-link\" href=\"?size=$size&page=$previousPage\">Previus</a>
    </li>";
    }
    for ($i = 0; $i < $total; $i += $size) {
        $page++;
        $activeClass = $currentPage == $page ? 'active' : '';
        $markap .=
            "<li class=\"page-item $activeClass\">
         <a class=\"page-link\" href=\"?size=$size&page=$page\">$page</a>
        </li>";
    }
    if ($currentPage < $page) {
        $NextPage = $currentPage + 1;
        $markap .=
            "<li class=\"page-item\">
     <a class=\"page-link\" href=\"?size=$size&page=$NextPage\">Next</a>
    </li>";
    }
    return $markap;
}
