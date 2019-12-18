<?php

$size = $_GET['size'] ?? 15;
$page = $_GET['page'] ?? 1;

$possibilePageSizes = [10, 25, 30, 40, 50];

function getTotal($connection)
{
    if ($result = mysqli_query($connection, 'select count(*) as count from photos')) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}

$total = getTotal($connection);
$offset = ($page - 1) * $size;

function getPhotosPaginated($connection, $size, $offset)
{
    if ($statement = mysqli_prepare($connection, 'select * from photo LIMIT ? OFFSET  ?')) {
        mysqli_stmt_bind_param($statement, 'ii', $size, $offset);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}

$content = getPhotosPaginated($connection, $size, $offset);

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

function logMessage($level, $message)
{
    $file = fopen('app.log', "a");
    fwrite($file, "[$level] $message" . PHP_EOL);
    fclose($file);
}

function errorPage()
{
    include "tamplates/error.php";
    die();
}
