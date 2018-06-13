<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Buurt extends Controller
{
	/*
		*社区添加
	*/
	public function slideshow()
	{
		//查询社区名称
		$data = Db('community')->select();
		//传值
		$this->assign([
			'data'=>$data
		]);
		//渲染
		return $this->fetch('slideshow');
	}
	/*
		*提交数据
	*/
	public function img_at()
	{
		/*接收传值信息*/
        $data = Request()->post();
      	$com_id = $data['com_id'];
      	unset($data['com_id']);
    	$files = Request()->file('adv_img');
        /*循环获取图片名称及后缀*/
        foreach ($files as $file) {
            $info = $file->move('../../uploads');
            if($info){
                $comm_logo = $info->getSaveName();
                $data['adv_img'][] = str_replace('\\','/',$comm_logo);
            }else{
                $file->getError();
            }
        }
        /*组合*/
        $arr = array();
        foreach($data as $key=>$val){
            foreach($val as $k=>$v){
                $arr[$k][$key] = $v;
            }
        }
        //添加字段值
        foreach($arr as $key=>$val)
        {	
        	$arr[$key]['com_id']=$com_id;
        }
        /*添加入库*/
        $res = Db('advertisin')->insertAll($arr);
        if($res){
        	return $this->redirect('buurt/slidestrate');
        }else{
        	return $this->redirect('buurt/slideshow');
        }
	}
	/*
		*广告的展示页面
	*/
	public function slidestrate()
	{
		//查询数据
		$data = Db('advertisin')->select();
		//传值
		$this->assign([
			'data'=>$data
		]);
		//渲染
		return $this->fetch('slidestrate');
	}

	 /*
    *添加我的社区分类
    */ 
    public function comm_type()
     {
        return view('comm_type');
     }
    /*
    *执行添加分类
    */ 
    public function comm_type_exec()
     {
        $comm_name = $_POST['comm_name'];  
         $file = request()->file('comm_logo');
        $info = $file->move('../../uploads');
        if($info){
            $image = $info->getSaveName();
             $comm_logo = str_replace('\\','/',$image);
         }
         $sql = "INSERT INTO pp_comm_type VALUES(NULL,'$comm_name','$comm_logo')";
         $res = Db::execute("INSERT INTO pp_comm_type VALUES(NULL,'$comm_name','$comm_logo')");
         
         if ($res) 
         {
            echo "<script>location.href='comm_type_show';</script>";         
         }
     }
        /*
        *我的分类展示
        */
        function comm_type_show()
        {
            // $ip = $_SERVER["SERVER_ADDR"];
//            echo $ip;exit;
            $list = Db::table("pp_comm_type")->paginate(5);
            $this->assign('list', $list);
            // $this->assign('ip',$ip);
            return $this->fetch();
            // $data = Db::query("SELECT * FROM pp_comm_type");
            // return view('comm_type_show',['data'=>$data]);
        }
        /*
        *我的分类修改
        */
        function update_type()
        {
            $id = $_POST['id'];
            $val = $_POST['val'];
            $res = Db::execute("UPDATE pp_comm_type SET comm_name ='$val' WHERE comm_id='$id'");
            if ($res) 
            {
                echo 1;
            }
        }
        /*
        *我的分类删除
        */
        public function comm_type_del()
        {
            $id = $_GET['id'];
            $res = Db::execute("DELETE FROM pp_comm_type WHERE comm_id='$id'");
            if ($res) 
            {
                echo "<script>location.href='comm_type_show'</script>";
            }
        }
}