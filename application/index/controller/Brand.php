<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
use app\index\model\Brands;
class Brand extends Controller{

	/** 品牌列表 */
	public function brand()
	{

		$data = Db('brand')->select();
		
		return $this->fetch('brand',['data'=>$data]);

	}

	/** 品牌添加 */
	public function brandAdd()  
	{
		if(request()->post()){

			$file = request()->file('brand_logo');

			// if(!file_exists(ROOT_PATH.'public'.DS.'uploads'))
			// {
			// 	mkdir('../../uploads',777);
			// }


			$info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move('../../uploads');

			if($info){

			  $info->getExtension();
			  // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg        
			  $info->getSaveName();
			  // 输出 42a79759f284b767dfcb2a0197904287.jpg
	          $info->getFilename(); 

	 		}else{
	 			echo $file->getError();
	 		}

	 		$brand_logo = $info->getSaveName();
	 		
			$request = Request::instance();

			$data['brand_logo'] = $brand_logo;

			$data['brand_name'] = $request->post('brand_name');

			$data['brand_desc'] = $request->post('brand_desc');

			$data['sort_order'] = $request->post('sort_order');

			$data['is_show'] = $request->post('is_show');

			$brand= new Brands;

			$result=$brand->insertData($data);
			
			if($result){
				return $this->redirect('brand/brand');
			}
			else{
				$this->error('添加失败');
			}
		}else{
			return $this->fetch('brandAdd');
		}	
	}

	/** 品牌删除页面 */
	public function brandDelete()
	{

		$request = Request::instance();
		
		$brand_id = $request->get();
		
		$brand = new Brands;
		
		$res = $brand->deleteData($brand_id['id']);
	
		if($res){
			return $this->redirect('Brand/brand');
		}else{
			$this->error('删除失败');
		}
	}

	/** 品牌修改页面 */
	public function brandUpdate()
	{

		$request = Request::instance();

		$brand_id = $request->get();
		
		$brand = new Brands;

		$res = $brand->findData($brand_id['id']);
		
		return view('brandUpdate',['res'=>$res]);
	}

	/** 品牌修改数据 */
	public function brandSave()
	{

		$brand_id = $_POST['brand_id'];
		
		$request = Request::instance();
		$brand =  Db::table('pp_brand')->where("brand_id",$brand_id)->find();

		$data = $request->post();
		$file = request()->file('brand_logo');
		if(isset($file)){  
         
       		$info = $file->move('../../uploads');
  
			if($info){  
				// 成功上传后 获取上传信息  
				$a=$info->getSaveName();  
				// $imgp= str_replace("\\","/",$a);
				// $imgpath='uploads/'.$a;  

				$data['brand_logo']= $a;  
				// unlink(ROOT_PATH . 'public\\uploads\\'.$brand['brand_logo']);
			}else{
			  	//上传错误信息
			  	echo $file->getError();
		   	}
		}

		$brand = new Brands;

		$result = $brand->updateData($data,$brand_id);

		if($result){
			return $this->redirect('brand/brand');
		}else{
			$this->error('修改失败');
		}
	}
}