<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 11:04
 */
return array(

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息

    //图书馆操作系统
    'sys_type' => [
        '0' => ['id'=>'1','name'=>'金盘'],
        '1' => ['id'=>'2','name'=>'yunlib'],
    ],


    //图书馆api类型
    'api_type_id' => [
        '0' => ['id'=>'1','name'=>'登录'],
        '1' => ['id'=>'2','name'=>'借书'],
        '2' => ['id'=>'3','name'=>'还书'],
        '3' => ['id'=>'4','name'=>'续借'],
        '4' => ['id'=>'5','name'=>'查书'],
        '5' => ['id'=>'6','name'=>'流通记录'],
    ],

    //排行榜类型
    'rank_type' => [
        '0' => ['id'=>'1','name'=>'畅销'],
        '1' => ['id'=>'2','name'=>'热读'],
        '2' => ['id'=>'3','name'=>'牛人榜'],
    ],


    //订阅状态
    'bes_status' => [
        '0' => ['id'=>'1','name'=>'预约'],
        '1' => ['id'=>'2','name'=>'取消预约'],
        '2' => ['id'=>'3','name'=>'已上架'],
        '3' => ['id'=>'4','name'=>'已全部外借'],
        '4' => ['id'=>'5','name'=>'该书不支持外借'],
    ]

);