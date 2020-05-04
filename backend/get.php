<?php

require 'DB.php';

function li(){
    $dbConn = DB::get();
    
    $result = pg_query_params($dbConn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("GET345"));

    if (pg_num_rows($result) == 0) {
        // $result = pg_prepare($dbConn, "GET2", 'SELECT * FROM pg_stat_activity WHERE datname =  $1');
        pg_prepare($dbConn, "GET35", 'SELECT * FROM public.machinery_bu');
    }

    
    $result = [];
    $res = pg_execute($dbConn, "GET35",[]);
    if ($res === false) {
        // header('Location: /login.html');
        // print_r(pg_result_error($dbConn));
    } else {
        $cnt = 0;
        // $arr = pg_fetch_array($res, NULL, PGSQL_NUM);
        while ($arr = pg_fetch_array($res, NULL, PGSQL_NUM)) {
            $result[$cnt]['id'] = $arr[0];
            $result[$cnt]['name'] = $arr[1];
            $result[$cnt]['description'] = $arr[2];
            $result[$cnt]['path'] = $arr[3];
            $result[$cnt]['price'] = $arr[4];
            $cnt++;
        }
    }
    return $result;
}