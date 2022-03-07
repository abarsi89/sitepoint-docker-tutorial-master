<?php

return [
//    'hello'     =>  'HelloController',
//    'admin/hello/{id}'     =>  'HelloController',
//    'hello'     =>  'HelloController@index',
//    'GET@hello/show/'     =>  'HelloController2@show',
//    'POST@hello/show/'     =>  'HelloController2@show',
    'hello/show/{id}' => [
        'POST' => 'HelloController@postShow',
        'GET' => 'HelloController@getShow',
    ],
    'asdf/sadfasdf/{asdasd}/sddg/sdfsdf/{uilulk}' => [
        'POST' => 'HelloController@postShow',
        'GET' => 'HelloController@getShow',
    ]
];