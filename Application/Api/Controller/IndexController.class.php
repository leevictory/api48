<?php
namespace Api\Controller;
use \Think\Controller;
class IndexController extends Controller {
    public function index(){
    	echo 'bigbang is php';
     
    }
    //数组转化为json的demo
    public function createJson()
    {
    	//生成一个数组
    	$bigbang = array(
    		'GD' => 'g-dragon',
    		'vi' => 'victory',
    		'top' => 'TOP'
    		);
    	dump($bigbang);
    	//把数组转化为一个json字符串
    	$BIGBANG = json_encode($bigbang);
    	//输出生成好的json
    	echo $BIGBANG;
    }
    //json字符串转化为对象或者数组
    public function jsonToObj()
    {
    	//创建一个json字符串
    	$bbjson = '{"GD":"g-dragon","vi":"victory","top":"TOP"}';
    	//把json转化成一个对象
    	$bbObj = json_decode($bbjson);
    	dump($bbObj);
    	//把json转化为一个数组
    	$bbArr = json_decode($bbjson,true);
    	dump($bbArr);
    }
    //测试请求方法
    public function testUrl()
    {
    	//1.确定url地址
    	$url = 'https://www.baidu.com';
    	//调用请求方法
    	$content = request($url);
    	//3.保存获取的源代码到一个文件
    	file_put_contents('./baidu.html', $content);
    }
    //获取简单的天气信息
    public function tianqi()
    {
    	$city = '北京';
    	//1.接口url地址
    	$url = 'http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
    	//2.判断是否是post
    	//3.发送请求
    	$content = request($url,false);
    	//处理返回值
    	$contentobj = simplexml_load_string($content);//解析xml代码
    	$todayobj = $contentobj->results->result[0]->date;//获取星期
    	$weatherobj - $contentobj->results->result[0]->weather;//获取天气
    	$winobj = $contentobj->results->result[0]->wind;//获取风力
    	$temobj = $contentobj->results->result[0]->temperature;//获取温度
    	$contentStr = "{$city}\n{$todayobj}\n天气：{$weatherobj}\n风力：{$winobj}\n温度：{$temobj}";
    	echo $contentStr;
    }
    //测试调用归属地获取方法
    public function testTel()
    {
        $this -> getTel('18338763127');
    }
    //获取号码归属地
    public function getTel($tel)
    {
    	//1.url地址
    	$url = 'http://cx.shouji.360.cn/phonearea.php?number='.$tel;
    	//2.查看是都是posg
    	//3.发送请求
    	$content = request($url,false);
    	//4.处理返回值
    	$content = json_decode($content);
    	echo '省份：'.$content->data->province.'<br />';
    	echo '城市：'.$content->data->city.'<br />';
    	echo '运营商：'.$content->data->sp.'<br />';
    }
}