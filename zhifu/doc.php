<?php
$wname = '地北支付';
$kfqq = '869618744';
$apiurl = 'zhifu.icu';
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
<title><?=$wname?> - 一站式免签约支付方案</title>
<meta name="keywords" content="<?=$wname?>,支付宝免签约即时到账,财付通免签约,微信免签约支付,QQ钱包免签约,免签约支付,武汉秒赞吧网络科技有限公司"/>
<meta name="description" content="<?=$wname?>是阿洋网络科技有限公司旗下的免签约支付产品，可以助你一站式解决网站签约各种支付接口的难题，现拥有支付宝、财付通、QQ钱包、微信支付等免签约支付功能，并有开发文档与SDK，可快速集成到你的网站"/>
<meta name="viewport"content="user-scalable=no, width=device-width">
<meta name="viewport"content="width=device-width, initial-scale=1"/>
<meta name="renderer"content="webkit">
<link rel="stylesheet"href="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/font-awesome/css/font-awesome.min.css"type="text/css"/>
<link rel="stylesheet"href="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/bootstrap/dist/css/bootstrap.css"type="text/css"/>
<link rel="stylesheet"href="https://template.down.swap.wang/template/spay/common.css">
<link rel="stylesheet"href="https://template.down.swap.wang/template/spay/index-top.css">
<!--[if IE 9 ]><style type="text/css">#ie9{ display:block; }</style><![endif]-->
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="https://template.down.swap.wang/template/spay/jquery-ujs.js"async="true"></script>
<link rel="stylesheet"type="text/css"href="https://template.down.swap.wang/template/spay/index.css"/>
<style type="text/css">body{color:#000;}header { position: relative; }</style>
</head>
<body>
<!--[if (gt IE 6)&amp;(lt IE 9)]>
<h1 style='color:red;text-align:center;'>
      你好，浏览器版本过低，升级可正常访问,点击<a style="color:blue"href="http://browsehappy.com/">升级您的浏览器</a>
</h1>
<style type="text/css">#ielt9{ display: none; }h1{ height:300px;line-height: 300px;display:block; }header{ display: none; }#ie9{ display: block; }.tenxcloud-logo{ margin:50px auto 0;display:block}</style>
<![endif]--><link rel="stylesheet"href="https://template.down.swap.wang/template/spay/common1.css"/>
<script type="text/javascript">

function aclos(){
document.getElementById("q_Msgbox").style.display="none";
}
</script>


<div id="ielt9"style="height:100%">
<header>
<nav id="main-nav"class="navbar navbar-default"role="navigation">
<div class="container">
<div class="row">
<div class="navbar-header">
<button type="button"class="toggle navbar-toggle collapsed"data-toggle="collapse"data-target=".navbar-top-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="/"><span class="logo" style="background:url(assets/img/logo.png) no-repeat;height: 45px"></span></a>
</div>
<div class="navbar-collapse navbar-top-collapse collapse"style="height: 1px;">
<ul class="nav navbar-nav navbar-right c_navbar">

</ul>
<ul class="nav navbar-nav navbar-right z_navbar">
<li><a href="/">首页</a></li>
<li><a href="doc.php">开发文档</a></li>
<li><a href="/user/">用户中心</a></li>
<!--li><a href="http://bbs.buguaiwl.com/forum.php?mod=forumdisplay&fid=49">问题反馈</a></li>-->
<li class="dropdown"><a class="dropdown-toggle"data-toggle="dropdown" href="/index.php/user/index/">用户中心<b class="caret"></b></a>
<ul  class="dropdown-menu"style="width: 100%;">
<li><a style="line-height:30px;" href="user/">登陆</a></li>
<li><a style="line-height:30px;" href="user/reg.php">注册</a></li>
</ul>

</li
                    
                </ul>
</div>
</div>
</div>
</nav>
</header>

<div id="ie9">你当前的浏览器版本过低，请您升级至IE9以上版本，以达到最佳效果，谢谢！<span class="closeIE">X</span></div>
<div id="scroll_Top">
<i class="fa fa-arrow-up"></i>
<a href="javascript:;"title="去顶部"class="TopTop">TOP</a></div>
<script>

  $('.closeIE').click(function(event) {
    $('#ie9').fadeOut();
  });
</script>

<style type="text/css">
.bann{ content:'';background-size:100%;background:#4280cb;background:-webkit-gradient(linear,0 0,0 100%,from(#4585d2),to(#4280cb));background:-moz-linear-gradient(top,#4585d2,#4280cb);background:linear-gradient(to bottom,#4585d2,#4280cb);top:0;left:0;z-index:-1;min-height:50px;width:100%}.fl .active{ color:#3F5061;background:#fff;border-color:#fff}
</style>

<div class="bann">


<div class="col-xs-12"style="text-align:center;">
<div class="h3"style="color:#ffffff;margin-top: 35px;margin-bottom: 30px;">开发文档</div>
                  
<div style="clear:both;"></div>
</div><div style="clear:both;"></div>
</div>


<div class="container">

  <!-- Docs nav
  ================================================== -->
  <div class="row">
    <div class="col-md-3 ">
      <div id="toc" class="bc-sidebar">
		<ul class="nav">
			<li class="toc-h2 toc-active"><a href="#toc0">支付接口介绍</a></li>
			<li class="toc-h2"><a href="#toc1">接口申请方式</a></li>
			<li class="toc-h2"><a href="#toc2">协议规则</a></li>
			<hr/>
			<li class="toc-h2"><a href="#api0">[API]创建商户</a></li>
			<li class="toc-h2"><a href="#api1">[API]查询商户信息</a></li>
			<li class="toc-h2"><a href="#api2">[API]修改结算账号</a></li>
			<li class="toc-h2"><a href="#api3">[API]查询结算记录</a></li>
			<li class="toc-h2"><a href="#api4">[API]查询单个订单</a></li>
			<li class="toc-h2"><a href="#api5">[API]批量查询订单</a></li>
			<hr/>
			<li class="toc-h2"><a href="#pay0">发起支付请求</a></li>
			<li class="toc-h2"><a href="#pay1">支付结果通知</a></li>
			<hr/>
			<li class="toc-h2"><a href="#sdk0">SDK下载</a></li>
			<hr/>
		</ul>
	</div>
   </div>

    <div class="col-md-9">
      <article class="post page">
      	<section class="post-content">
              <h2 id="toc0">支付接口介绍</h2>
<blockquote><p>使用此接口可以实现支付宝、QQ钱包、微信支付与财付通的即时到账，免签约，无需企业认证。</p></blockquote>
<p>本文阅读对象：商户系统（在线购物平台、人工收银系统、自动化智能收银系统或其他）集成<?=$wname?> 涉及的技术架构师，研发工程师，测试工程师，系统运维工程师。</p>
<h2 id="toc1">接口申请方式</h2>
<p>共有两种接口模式：</p>
<p>（一）普通支付商户<br/>可以获得一个支付商户，完全免费申请。公测期间请联系人工申请QQ<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$kfqq?>&amp;site=qq&amp;menu=yes"><?=$kfqq?></a>，申请之后会将商户ID和商户KEY给你！</p>
<p>（二）合作支付商户<br/>获得一个合作者身份TOKEN，可以集成到你开发的程序里面，通过接口无限申请普通支付商户，并且每个普通支付商户单独结算，相对独立。公测期间请联系人工申请QQ<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$kfqq?>&amp;site=qq&amp;menu=yes"><?=$kfqq?></a>，申请之后会将合作者身份TOKEN给你！</p>
<h2 id="toc2">协议规则</h2>
<p>传输方式：HTTP</p>
<p>数据格式：JSON</p>
<p>签名算法：MD5</p>
<p>字符编码：UTF-8</p>
<hr/>
<h2 id="api0">[API]创建商户</h2>
<p>API权限：该API只能合作支付商户调用</p>
<p>URL地址：https://<?=$apiurl?>/api.php?act=apply&amp;token={合作者身份TOKEN}&amp;url={商户域名}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>apply</td><td>此API固定值</td></tr>
  <tr><td>合作者TOKEN</td><td>token</td><td>是</td><td>String</td><td>9ddab6c4f2c87ce442de371b04f36d68</td><td>需要事先申请</td></tr>
  <tr><td>商户域名</td><td>url</td><td>是</td><td>String</td><td>pay.cccyun.cc</td><td></td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>添加支付商户成功！</td><td></td></tr>
  <tr><td>商户ID</td><td>pid</td><td>Int</td><td>1001</td><td>所创建的商户ID</td></tr>
  <tr><td>商户密钥</td><td>key</td><td>String(32)</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td>所创建的商户密钥</td></tr>
  <tr><td>商户类型</td><td>type</td><td>Int</td><td>1</td><td>此值暂无用</td></tr>
  </tbody>
</table>

<h2 id="api1">[API]查询商户信息与结算规则</h2>
<p>URL地址：https://<?=$apiurl?>/api.php?act=query&amp;pid={商户ID}&amp;key={商户密钥}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>query</td><td>此API固定值</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>Int</td><td>1001</td><td>所创建的商户ID</td></tr>
  <tr><td>商户密钥</td><td>key</td><td>String(32)</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td>所创建的商户密钥</td></tr>
  <tr><td>商户类型</td><td>type</td><td>Int</td><td>1</td><td>此值暂无用</td></tr>
  <tr><td>商户状态</td><td>active</td><td>Int</td><td>1</td><td>1为正常，0为封禁</td></tr>
  <tr><td>商户余额</td><td>money</td><td>String</td><td>0.00</td><td>商户所拥有的余额</td></tr>
  <tr><td>结算账号</td><td>account</td><td>String</td><td>pay@cccyun.cn</td><td>结算的支付宝账号</td></tr>
  <tr><td>结算姓名</td><td>username</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr>
  <tr><td>满多少自动结算</td><td>settle_money</td><td>String</td><td>30</td><td>此值为系统预定义</td></tr>
  <tr><td>手动结算手续费</td><td>settle_fee</td><td>String</td><td>1</td><td>此值为系统预定义</td></tr>
  <tr><td>每笔订单分成比例</td><td>money_rate</td><td>String</td><td>98</td><td>此值为系统预定义</td></tr>
  </tbody>
</table>

<h2 id="api2">[API]修改结算账号</h2>
<p>URL地址：https://<?=$apiurl?>/api.php?act=change&amp;pid={商户ID}&amp;key={商户密钥}&amp;account={结算账号}&amp;username={结算姓名}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>change</td><td>此API固定值</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
  <tr><td>结算账号</td><td>account</td><td>是</td><td>String</td><td>pay@cccyun.cn</td><td>结算的支付宝账号</td></tr>
  <tr><td>结算姓名</td><td>username</td><td>是</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>修改收款账号成功！</td><td></td></tr>
  </tbody>
</table>

<h2 id="api3">[API]查询结算记录</h2>
<p>URL地址：https://<?=$apiurl?>/api.php?act=settle&amp;pid={商户ID}&amp;key={商户密钥}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>settle</td><td>此API固定值</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr>
  <tr><td>结算记录</td><td>data</td><td>Array</td><td>结算记录列表</td><td></td></tr>
  </tbody>
</table>

<h2 id="api4">[API]查询单个订单</h2>
<p>URL地址：https://<?=$apiurl?>/api.php?act=order&amp;pid={商户ID}&amp;key={商户密钥}&amp;out_trade_no={商户订单号}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>order</td><td>此API固定值</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询订单号成功！</td><td></td></tr>
  <tr><td>易支付订单号</td><td>trade_no</td><td>String</td><td>2016080622555342651</td><td>彩虹易支付订单号</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr>
  <tr><td>支付方式</td><td>type</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>Int</td><td>1001</td><td>发起支付的商户ID</td></tr>
  <tr><td>创建订单时间</td><td>addtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr>
  <tr><td>完成交易时间</td><td>endtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr>
  <tr><td>商品名称</td><td>name</td><td>String</td><td>VIP会员</td><td></td></tr>
  <tr><td>商品金额</td><td>money</td><td>String</td><td>1.00</td><td></td></tr>
  <tr><td>支付状态</td><td>status</td><td>Int</td><td>0</td><td>1为支付成功，0为未支付</td></tr>
  </tbody>
</table>

<h2 id="api5">[API]批量查询订单</h2>
<p>URL地址：https://<?=$apiurl?>/api.php?act=orders&amp;pid={商户ID}&amp;key={商户密钥}</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>orders</td><td>此API固定值</td></tr>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
  <tr><td>查询订单数量</td><td>limit</td><td>否</td><td>Int</td><td>20</td><td>返回的订单数量，最大50</td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr>
  <tr><td>订单列表</td><td>data</td><td>Array</td><td></td><td>订单列表</td></tr>
  </tbody>
</table>
<hr/>

<h2 id="pay0">发起支付请求</h2>
<p>URL地址：https://<?=$apiurl?>/submit.php?pid={商户ID}&amp;type={支付方式}&amp;out_trade_no={商户订单号}&amp;notify_url={服务器异步通知地址}&amp;return_url={页面跳转通知地址}&amp;name={商品名称}&amp;money={金额}&amp;sitename={网站名称}&amp;sign={签名字符串}&amp;sign_type=MD5</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr>
  <tr><td>异步通知地址</td><td>notify_url</td><td>是</td><td>String</td><td>http://域名/notify_url.php</td><td>服务器异步通知地址</td></tr>
  <tr><td>跳转通知地址</td><td>return_url</td><td>是</td><td>String</td><td>http://域名/return_url.php</td><td>页面跳转通知地址</td></tr>
  <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr>
  <tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr>
  <tr><td>网站名称</td><td>sitename</td><td>否</td><td>String</td><td>彩虹云任务</td><td></td></tr>
  <tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1" target="_blank">支付宝签名算法</a>相同</td></tr>
  <tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr>
  </tbody>
</table>

<h2 id="pay1">支付结果通知</h2>
<p>通知类型：服务器异步通知（notify_url）、页面跳转通知（return_url）</p>
<p>请求方式：GET</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
  <tr><td>易支付订单号</td><td>trade_no</td><td>是</td><td>String</td><td>20160806151343349021</td><td>彩虹易支付订单号</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr>
  <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
  <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr>
  <tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr>
  <tr><td>支付状态</td><td>trade_status</td><td>是</td><td>String</td><td>TRADE_SUCCESS</td><td></td></tr>
  <tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1" target="_blank">支付宝签名算法</a>相同</td></tr>
  <tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr>
  </tbody>
</table>
<hr/>
<h2 id="sdk0">SDK下载</h2>
<blockquote>
<a href="./SDK/SDK.zip" style="color:blue">SDK.zip</a><br/>
SDK版本：V1.0
</blockquote>

          </section>
      </article>
    </div>
  </div>

</div>


<div class="address">
<footer>
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-8 col-lg-9">
<ul class="porduct">
<h4>合作伙伴</h4>
<li><a href="http://www.qzoner.cn/" target="_blank">阿洋网络</a></li>
<li><a href="http://www.aaais.top/" target="_blank">阿洋发卡网</a></li>
</ul>
<ul class="price">
<h4>关于我们</h4>
<li><?=$wname?>是爱微网络科技有限公司旗下的免签约支付产品</li>
</ul>
<ul class="about"style="width: 40%;padding-left: 22px;">
<h4>联系我们</h4>
<li><strong>客服QQ:</strong><a target="_blank"href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$kfqq?>&amp;site=qq&amp;menu=yes"><?=$kfqq?></a></li>
<li><strong>Email:</strong><a name="baidusnap4"></a><a href="mailto:<?=$kfqq?>@qq.com"><?=$kfqq?>@qq.com</a></li>
</ul>
</div>

</div>
<div class="xinxi">
<p>Copyright © 2018 <?=$wname?>  | Powered by <a href="http://www.ivzfpt.com/">ivzfpt.com</a></p>
</div>
<script type="text/javascript">
        if('ontouchend' in document.body &amp;&amp; $(window).width() < 996){
          $('.col-xs-12 .h2').css('text-align','center');
        }
      </script>
</div>
</footer>
</div>
</div>
</body>
</html> 