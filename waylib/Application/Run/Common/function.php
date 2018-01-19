<?php


/**
 * 管理员操作日志
 * @param $var  操作说明
 * @param $changeId  修改的user_id
 * @param $userId  管理员ID
 * @return mixed
 */
function addlog($var,$changeId = null,$userId = '')
{
    if(!$userId){
        $userId = session('adminUser')['user_id'];
    }
    $data['user_id'] = $userId;
    $data['create_time'] = date('Y-m-d H:i:s');
    $data['change_user_id'] = $changeId;
    $data['var'] = $var;
    $re = D('AdminLog')->addData($data);
    return $re;
}


/*
*共用方法
*/
function  show($code, $message,$data=array()) {
    $reuslt = array(
        'code' => $code,
        'message' => $message,
        'data' => $data,
    );
   return json_encode($reuslt);
}

  function getPassword($password=''){
		$password = md5($password);
		return $password;
	}
  
  function showKind($status,$data) {
    header('Content-type:application/json;charset=UTF-8');
    if($status==0) {
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}


/**
 * 分页工具
 * @param $lists  数组
 * @param $pageSize  每页显示条数
 * @return array
 */
function Page($lists,$pageSize)
{
    import('ORG.Util.Page');// 导入分页类
    $count=count($lists);//得到数组元素个数
    $Page= new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
    $lists = array_slice($lists,$Page->firstRow,$Page->listRows);
    $show = $Page->show();// 分页显示输出﻿
    $arr = array(
        'lists' =>$lists,
        'page'=>$show
    );
    return  $arr;
}



/*分页*/
/*
 * string $m 模型名称
 * int $pagesize 每页显示条数
 * array OR string OR int $map 查询条件
 */
function getpage( &$m, $map, $pagesize = 10){

    $m1    = clone $m;//浅复制一个模型

    $count = $m->where($map)->count();//连惯操作后会对join等操作进行重置

    $m     = $m1;//为保持在为定的连惯操作，浅复制一个模型

    $p     = new Think\Page($count,$pagesize);

    $p->lastSuffix = false;

    $p->rollPage   = 5;

    $p->setConfig('header','<li>共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>'.$pagesize.'</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');

    $p->setConfig('prev','上一页');

    $p->setConfig('next','下一页');

    $p->setConfig('last','末页');

    $p->setConfig('first','首页');

    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter  = I('get.');

    $m->limit($p->firstRow, $p->listRows);

    return $p;
}
/*curl操作
 *url---会话请求URL地址
 *method---请求方式，有POST和GET两种，默认get方式
 *res---返回数据类型，有json和array两种，默认返回json格式
 *data---POST请求时的参数，数组格式
 */
 function curlRequest($url,$method='get',$data=array()){
     //初始化一个会话操作
      $ch = curl_init();
     //设置会话操作的通用参数
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
      curl_setopt($ch, CURLOPT_URL , $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      //POST方式时参数设置
      if($method == 'post') curl_setopt($ch, CURLOPT_POST, 1);
      if(!empty($data)) curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
      //执行会话
      $data = curl_exec($ch);
      //关闭会话，释放资源
       curl_close($ch);
      if(curl_errno($ch)) {
         return curl_error($ch);//异常处理
        }
      //返回指定格式数据
      return $data;
} 

/*
 *数组查重
 *data---对象数组
 *有重复返回FALSE，没有重复返回TRUE
 */
 function array_repeat($data){
    $arr = array_count_values($data);
    foreach ($arr as $key => $value) {
      if($value >=2){
        return false;
      }
    }
    return true;
 }
