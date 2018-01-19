<?php
return array(
	//'配置项'=>'配置值'


    /* 数据库设置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'rm-wz9vpnz00h11zm54u.mysql.rds.aliyuncs.com:3306', // 服务器地址
    'DB_NAME'   => 'waylib', // 数据库名
    'DB_USER'   => 'waylibopr', // 用户名
    'DB_PWD'    => 'waylib@2017db',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'waylib_', // 数据库表前缀
    'DB_DEBUG'  =>  false,  // 数据库调试模式 3.2.3新增



//    'DB_TYPE'   => 'mysql', // 数据库类型
//    'DB_HOST'   => '119.23.251.40', // 服务器地址
//    'DB_NAME'   => 'waylib', // 数据库名
//    'DB_USER'   => 'root', // 用户名
//    'DB_PWD'    => 'WayLib~test2017mysql',  // 密码
//    'DB_PORT'   => '3306', // 端口
//    'DB_PREFIX' => 'waylib_', // 数据库表前缀
//    'DB_DEBUG'  =>  false,  // 数据库调试模式 3.2.3新增



    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 2, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /*绑定模块*/
    'MODULE_ALLOW_LIST'    =>    array('Home','Run'),
    'DEFAULT_MODULE'       =>    'Run',





);