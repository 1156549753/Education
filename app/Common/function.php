<?php

//自定义函数库文件

function testt(){
    echo "这是测试函数";
}

/**
 * 获取当前"控制器"名
 */
function getCurrentControllerName()
{
    return getCurrentAction()['controller'];
}
/**
 * 获取当前"方法"名
 */
function getCurrentMethodName()
{
    return getCurrentAction()['method'];
}
/**
 * 获取当前控制器与方法
 */
function getCurrentAction()
{
    $action = \Route::current()->getActionName();
    list($class, $method) = explode('@', $action);
    $class = str_replace('Controller','',substr(strrchr($class,DIRECTORY_SEPARATOR),1));
    return ['controller' => $class, 'method' => $method];
}


/***********递归方式获取上下级权限信息****************/
//$data :被要求做上下级排序
function generateTree($data){
    $items = array();
    foreach($data as $v){
        $items[$v['ps_id']] = $v;
    }
    $tree = array();
    foreach($items as $k => $item){
        if(isset($items[$item['ps_pid']])){
            $items[$item['ps_pid']]['son'][] = &$items[$k];
        }else{
            $tree[] = &$items[$k];
        }
    }
    return getTreeData($tree);
}
function getTreeData($tree,$level=0){
    static $arr = array();
    foreach($tree as $t){
        $tmp = $t;
        unset($tmp['son']);
        //$tmp['level'] = $level;
        $arr[] = $tmp;
        if(isset($t['son'])){
            getTreeData($t['son'],$level+1);
        }
    }
    return $arr;
}
/***********递归方式获取上下级权限信息****************/

