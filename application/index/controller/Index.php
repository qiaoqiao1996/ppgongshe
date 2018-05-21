<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Index extends Controller
{
    public function index()
    {
    	return   view('index');
    }
    public function changePwd()
    {
    	return   view('changePwd');
    }
    //后台首页
    public function main()
    {
    	return  view('main');
    }
    public function userInfo()
    {
    	return view('userInfo');
    }
     public function message()
     {
     	return view('message');
     }
     //友情链接
     public function linksList()
     {
     	return view('linksList');
     }
//   //文章列表
     public function newsList()
     {
     	return view('newsList');
     }
     public function allUsers()
     {
     	return view('allUsers');
     }
     public  function systemParameter()
     {
     	return view('systemParameter');
     } 
     public function images()
     {
     	return view('images');
     }
     public function get404()
     {
     	return view('404');
     }
//   
}
