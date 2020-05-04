<?php 

require 'DB.php';

// var_dump($_POST);
// var_dump($_FILES);
 
$generate = uniqid();
$image = $generate.'.jpg';
$tmp_name = $_FILES['file']['tmp_name'];

move_uploaded_file($tmp_name, "uploads/" . $image);

$params = [];
$params[] = $_POST['name']; 
$params[] = $_POST['textarea']; 
$params[] = $image;
$params[] = $_POST['price'];

##############################################################################

$dbConn = DB::get();
pg_prepare($dbConn, "create2", 'INSERT INTO public.machinery_bu ("name","description","image","price") VALUES ($1,$2,$3,$4)');

$res = pg_execute($dbConn, "create2", $params);
if ($res === false) {
    print_r(pg_result_error($dbConn));
} else {
    echo 'Запрос успешно добавлен в базу';
    echo '<br>';
    echo '<a href="index.php">Вернутся назад</a>';
}


