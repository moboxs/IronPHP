<?php

class TestController extends Controller{

    function test($p1,$p2){
        print_r($p1.$p2);exit;
        echo 'test2222';
    }
}