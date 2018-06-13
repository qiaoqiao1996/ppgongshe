<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use app\index\model\NumberCard;
use app\index\model\SetMealDetails;
use think\cache\driver\Redis;
use PHPExcel_IOFactory;
use PHPExcel;

class Mobilecard extends Controller
{
	public function cardList()
	{
		return $this->fetch('card_list');
	}
//	查看手机号
	public function cardData()
	{
		$card = new NumberCard();
		return $card->showCard();
	}
//	添加手机号
	public function cardAdd()
	{
		if (Request::instance()->isPost()){
			$file = request()->file('cardFile');

			$type_id = isset($_POST['type_id'])?$_POST['type_id']:1;
			$meal_id = $_POST['meal_id'];
			if($meal_id == 0){
				return $this->error('请选择套餐');
			}
	        $info = $file->validate(['ext' => 'xlsx,xls'])->move(ROOT_PATH . 'public' . DS . 'excel');

			if($info){
				$exclePath = $info->getSaveName();  //获取文件名
	            $file_name = ROOT_PATH . 'public' . DS . 'excel' . DS . $exclePath;
				$res = $this->getExcel($file_name,$type_id,$meal_id);			
				if(isset($res['data'])){
					$numbercard = new NumberCard();
					$numbercard->cardAddAll($res['data']);
				}
				
			}
			
			$setmeal = new SetMealDetails();
			$data = $setmeal->getMeal(['t_id'=>1],['details_id','d_name']);
			$this->assign('data',$data);
			if(isset($res['error'])){
				$this->assign('error',$res['error']);
			}
			
			return $this->fetch('card_add');
		}

		$setmeal = new SetMealDetails();
		$data = $setmeal->getMeal(['t_id'=>1],['details_id','d_name']);
		$this->assign('data',$data);
		return $this->fetch('card_add');
	}
	
	//	获取套餐
	public function getdeta()
	{
		$type_id = $_POST['type_id'];
		$setmeal = new SetMealDetails();
		$data = $setmeal->getMeal(['t_id'=>$type_id],['details_id','d_name']);
		return json_encode($data);
	}
	
	//将Excel文件转为数组
	public function getExcel($filename,$type_id,$meal_id)
	{
		$extension = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
		if($extension == 'xlsx') {
            $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
        }else if($extension == 'xls'){
            $objReader =\PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
        }
        $excel_array=$objPHPExcel->getsheet(0)->toArray();
//      去掉表头
        unset($excel_array[0]);
        $arr = [];
//      去重
        foreach($excel_array as $k => $v){
        	if(in_array($v[0],$arr)){
        		unset($excel_array[$k]);
        	}else{
        		$arr[] = $v[0];
        	}
        }
        $returnData = [];
        foreach($excel_array as $k => $v){
        	if($v[2]==''){
        		$returnData['error'][$k]['tel'] = $v[0];
        		$returnData['error'][$k]['error'] = '未填写预存金额';
        	}else if($v[2]==0){
        		$returnData['error'][$k]['tel'] = $v[0];
        		$returnData['error'][$k]['error'] = '预存金额为0';
        	}else if($v[3]==''){
        		$returnData['error'][$k]['tel'] = $v[0];
        		$returnData['error'][$k]['error'] = '未填写号码归属地';
        	}else{
        		$tel = trim($v[0]);
        		$numbercard = new NumberCard();
        		$where = ['card_number'=>$tel];
        		$reg = $numbercard->findOne($where);
        		if($reg){
        			$returnData['error'][$k]['tel'] = $v[0];
        			$returnData['error'][$k]['error'] = '号码已存在';
        		}else{
        			$returnData['data'][$k]['card_number'] = $tel;
	        		$returnData['data'][$k]['type_id'] = $type_id;
	        		$returnData['data'][$k]['details_id'] = $meal_id;
	        		$returnData['data'][$k]['card_money'] = $v[1];
	        		$returnData['data'][$k]['pre_price'] = $v[2];
	        		$returnData['data'][$k]['city'] = $v[3];
        		}
        	}
        	
        }
        return $returnData;
	}
	
//	删除
	public function cardDel()
	{
		$card_id = $_POST['card_id'];
		$numbercard = new NumberCard();
		if($numbercard->del($card_id)){
			return 1;
		}else{
			return 0;
		}
	}
	
//	类型搜索
	public function getTypeNum()
	{
		$type_id = $_POST['type_id'];
		$numbercard = new NumberCard();
		$data = $numbercard->showCard(['c.type_id'=>$type_id]);
		return json_encode($data);
	}
}