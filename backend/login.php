<?php

require 'DB.php';

session_start();

// var_dump($_POST);
// die();

// $_POST = [];
// $_POST['username'] = 'adlet@sevalo.kz';
// $_POST['password'] = '!q2w3e4r5t';


if ($_POST) {
    $dbConn = DB::get();
    pg_prepare($dbConn, "au12345", 'SELECT * FROM public.users');

    $result = [];
    $res = pg_execute($dbConn, "au12345",[]);
    if ($res === false) {
        // header('Location: /login.html');
        print_r(pg_result_error($dbConn));
    } else {
        $cnt = 0;
        // $arr = pg_fetch_array($res, NULL, PGSQL_NUM);
        while ($arr = pg_fetch_array($res, NULL, PGSQL_NUM)) {
            $result[$cnt]['id'] = $arr[0];
            $result[$cnt]['email'] = $arr[1];
            $result[$cnt]['password'] = $arr[2];
            $cnt++;
        }
    } 
    // var_dump($result);
    foreach ($result as $user) {
        if ($user['email'] == $_POST['login-username'] && $user['password'] == $_POST['login-password']) {
            $_SESSION['auth'] = $user;
            header('Location: index.php');
            break;
        }
    }
    
    if (!isset($_SESSION['auth'])) {
        header('Location: /login.html');
    }

    // header('Location: /login.html');
    // return;
} else {
    header('Location: /login.html');
} 
