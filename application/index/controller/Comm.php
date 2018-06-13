<?php 
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Comm extends Controller
{

    //小区添加
    public function community()
    {   

       //判断是不是post
    	if (Request::instance()->isPost())
    		{
                //接表单参数
                $data=$_POST;
                $comm_id=$data['comm_id'];
                $data['comm_id']=implode(',',$comm_id);
                $data['com_time']=time();
                $res = DB::table('pp_community')->insert($data);
                if ($res) {
                    $this->redirect('comm/community_show');
                }else
                {
                	$this->redirect('comm/community');
                }
    		}else
    		{
    			$data=DB::table('pp_comm_type')->select();
    	        $this->assign('data',$data);
    	        return view('community');
    		}
    	
    }
    //社区分类
    public function comm_type()
    {
    	return view('comm_type');
    }
    //社区广告
    public function advertising()
    {
    	return view('advertising');
    }
    //小区列表展示
    public function community_show()
    {   
        // $data=DB::table('pp_community')->alias('c')->join('pp_comm_type type','c.comm_id=type.comm_id')->paginate(5, false, ['query' => request()->get()]);
        // $page=$data->render();
        // $this->assign('page',$page);
         $data=DB::table('pp_community')->alias('c')->join('pp_comm_type type','c.comm_id=type.comm_id')->limit(5)->select();
    	$this->assign('data',$data);
    	return $this->fetch();
    }
    //删除
    public function del()
    {
    	// $id=base64_decode($_GET['id'],true);
    	$id=$_GET['id'];
    	if (is_array($id)) {
    		$id=implode($id,',');
    	}
    	$res = DB::table('pp_community')->where("com_id in($id)")->delete();
    	// $data=DB::table('pp_community')->alias('c')->join('pp_comm_type type','c.comm_id=type.comm_id')->paginate(5, false, ['query' => request()->get()]);
        //$page=$data->render();
        // $this->assign('page',$page);
        $data=DB::table('pp_community')->alias('c')->join('pp_comm_type type','c.comm_id=type.comm_id')->limit(5)->select();
        $this->assign('data',$data);
        $data = $this->fetch('com');
        // var_dump($data);die;
    	echo json_encode(array('ms'=>1,'data'=>$data));
    }
     //修改
}