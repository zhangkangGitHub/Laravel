<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Userinfo;
use Hash;
use Mail;

class RegisterController extends Controller 
{
	//显示注册页面
	public function index() 
	{
		//显示页面
		return view("home.register.register");
	}

	//处理邮箱注册数据
	public function store(Request $request) 
	{
		// dd($request->all());
		// 判断两次密码输入是否一致
		if($request->input('upass') != $request->input('repass')){
    		echo "<script>alert('两次密码不一致');location.href='/home/register';</script>";
    		exit;
    	}

		// 注册
		$users = new Users;
		$users->email = $request->input('email','');
		$users->uname = $request->input('email','');
		$users->upass = Hash::make($request->input('upass',''));
		$users->token = str_random(30);
		// return $users->save();
		if($users->save()){
			// return $users->id;
			$uid = $users->id;
			$usersinfo = new Userinfo;
			$usersinfo->profile ='20190725/hq2WMI1ILn7dfN3vZ9WG4F22wRpPLPVmaYKhmQQm.jpeg';
			$usersinfo->uid=$uid;
			if($usersinfo->save()){
				// 发送邮件 mail::send()=>return view()
    			Mail::send('home.email.email', ['id' => $users->id,'token'=>$users->token], function ($m) use ($users) {
		            $m->to($users->email)->subject('【lamp软件学院】注册激活邮件！');
		        });
			}
			echo "添加成功";
		}else{
			echo "添加失败";
		}	
	}

	//激活
	public function changestatus(Request $request)
	{
		$id = $request->input('id',0);
		$token = $request->input('token',0);
		$user = Users::find($id);
		if($user->token != $token){
			dd("链接失效");
		}
		$user->status = 1;
		$user->token = str_random(30);
		if($user->save()){
			echo "<script>alert('激活成功，请登录');location.href='/home/user/login';</script>";
		}else{
			echo "<script>alert('激活失败，请重新注册');location.href='/home/user/login';</script>";
		}
	}

	//处理手机号注册数据
	public function insert(Request $request)
	{
		// dd($request->all());
		//验证手机验证码
		$phone = $request->input('phone',0);

		//获取发送到手机上的验证码
		$k = $phone.'_code';

		$phone_code = session($k);

		$code = $request->input('code',0);

		//判断发送到手机上的验证码与输入的验证码是否一致
		if($phone_code != $code){
			echo "<script>alert('验证码输入错误');location.href='/home/register';</script>";
			exit;
		}                                           

		//压入到数据库
		$user = new Users;
		$user->uname = $request->input('phone','');
		$user->phone = $request->input('phone','');
		$user->upass = Hash::make($request->input('upass',''));
		if($user->save()){
			echo "<script>alert('注册成功,请登录');location.href='/home/user/login';</script>";
		}else{
			echo "<script>alert('注册失败,请重新注册');location.href='/home/user/login';</script>";
		}
	}

	//发送手机号验证码
	public function sendPhone(Request $request) 
	{
		//接受手机号
		$phone = $request->input('phone');
		
		$code = rand(1234,4321);
		//如果存入到redis中 注意键名覆盖
		$k = $phone.'_code'; 
		
		session([$k=>$code]);
		// exit;

		$url = "http://v.juhe.cn/sms/send";
		$params = array(
		    'key'   => '0c6d380d1dd9bcd0a2ab2f6b236db6fa', //您申请的APPKEY
		    'mobile'    => $phone, //接受短信的用户手机号码
		    'tpl_id'    => '177539', //您申请的短信模板ID，根据实际情况修改
		    'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
			'dtype'	=> 'json'
		);

		$paramstring = http_build_query($params);
		$content = self::juheCurl($url, $paramstring);
		// echo $content; 
		$result = json_decode($content, true);  //将json格式转化成数组
		//返回结构
		// if ($result) {
		// 	var_dump($result);
		// }
	}

	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	public static function juheCurl($url, $params = false, $ispost = 0)
	{
	    $httpInfo = array();
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if ($ispost) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	        curl_setopt($ch, CURLOPT_URL, $url);
	    } else {
	        if ($params) {
	            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
	        } else {
	            curl_setopt($ch, CURLOPT_URL, $url);
	        }
	    }
	    $response = curl_exec($ch);
	    if ($response === FALSE) {
	        //echo "cURL Error: " . curl_error($ch);
	        return false;
	    }
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
	    curl_close($ch);
	    return $response;
	} 
}