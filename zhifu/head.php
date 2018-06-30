<?php
include("includes/common.php");
$my=isset($_GET['my'])?$_GET['my']:null;
$count1=$DB->query("SELECT * from pay_order")->rowCount();
$count2=$DB->query("SELECT * from pay_user")->rowCount();
$count3=file_get_contents(SYSTEM_ROOT.'all.txt');
$count4=file_get_contents(SYSTEM_ROOT.'settle.txt');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="renderer" content="webkit" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title><?=$title?>-<?php echo $conf['web_name']?>-行业领先的免签约支付平台dibei.org</title>
    <meta name="author" content="<?php echo $conf['web_name']?>旗下免签约支付平台，致力于为更多用户提供稳定而又易用的支付平台！" />
    <meta name="keywords" content="<?php echo $conf['web_name']?>,玖陆易支付,易支付,免签约支付平台,支付宝,财付通,QQ钱包,微信支付,第三方支付接口，聚会支付平台,彩虹易支付,hack易支付" />
    <meta name="description" content="<?php echo $conf['web_name']?>旗下免签约支付平台，致力于为更多用户提供稳定而又易用的支付平台！" />
    <link rel="shortcut icon" id="favicon" href="http://www.it96.top/images/favicon.png" />
    <link rel="stylesheet" href="http://www.it96.top/css/home.css" />
    <link rel="stylesheet" href="http://www.it96.top/css/main.css" />
    <link rel="stylesheet" href="http://www.it96.top/css/animation.css" />
    <style type="text/css">
        #intro {
            padding: 0;
            margin: 0;
            height: 0 !important;
            width: 0;
            overflow: hidden !important;
        }
        #intro .logo {
            float: left;
            margin: 0 10px 10px 0;
        }
        h1,
        h2,
        h3,
        h4,
        p,
        li {
            font-family: microsoft yahei;
        }
        @media screen and (min-width: 600px) {
            .slide1 {
                background-image: url(http://www.it96.top/images/1441951809.jpg);
            }
            .slide2 {
                background-image: url(http://www.it96.top/images/1441949934.jpg);
            }
            .slide3 {
                background-image: url(http://www.it96.top/images/1441956136.jpg);
            }
            .slide4 {
                background-image: url(http://www.it96.top/images/1441947138.jpg);
            }
        }
        @media screen and (max-width: 600px) {
            .slide1 {
                background-image: url(http://www.it96.top/images/1443615946.jpg);
            }
            .slide2 {
                background-image: url(http://www.it96.top/images/1443618672.jpg);
            }
            .slide3 {
                background-image: url(http://www.it96.top/images/1443618099.jpg);
            }
            .slide4 {
                background-image: url(http://www.it96.top/images/1443619355.jpg);
            }
        }
        @media screen and (min-width: 600px) {
            .page2 {
                background-image: url(http://www.it96.top/images/1441949348.jpg);
            }
            .page3 {
                background-image: url(http://www.it96.top/images/1441956805.jpg);
            }
            .page4 {
                background-image: url(http://www.it96.top/images/1443609696.jpg);
            }
            .page5 {
                background-image: url(http://www.it96.top/images/1443614947.jpg);
            }
            .page6 {
                background-image: url(http://www.it96.top/images/1443608806.jpg);
            }
            .page7 {
                background-image: url(http://www.it96.top/images/1443610575.jpg);
            }
            .page8 {
                background-image: url(http://www.it96.top/images/1443608078.jpg);
            }
        }
        @media screen and (max-width: 600px) {
            .page2 {
                background-image: url(http://www.it96.top/images/1443621700.jpg);
            }
            .page3 {
                background-image: url(http://www.it96.top/images/1443621784.jpg);
            }
            .page4 {
                background-image: url(http://www.it96.top/images/1443620091.jpg);
            }
            .page5 {
                background-image: url(http://www.it96.top/images/1443623011.jpg);
            }
            .page6 {
                background-image: url(http://www.it96.top/images/1443620778.jpg);
            }
            .page7 {
                background-image: url(http://www.it96.top/images/1443619787.jpg);
            }
            .page8 {
                background-image: url(http://www.it96.top/images/1443617380.jpg);
            }
        }
        @media screen and (min-width: 1050px) {
            #index_x {
                display: none
            }
        }
    body,td,th {
	font-family: "宋体";
}
    </style>
</head>
<script src="http://www.it96.top/js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#index_x").click(function() {
            $("#menu").hide();
        });
        $("#index_xs").click(function() {
            $("#menu").show();
        });
    });
</script>

<body>
    <header id="header">
        <div class="container clearfix">
            <h1 id="logo"><a href="/" style=" font-size: 3.8em; position: relative; color: #fff; margin: 15px 0; text-transform: uppercase; "><?php echo $conf['web_name']?></a></h1>
            <nav>
                <a class="icon_menu" id="index_xs"><img alt="菜单" src="http://www.it96.top/picture/caidan.png">
                </a>
                <ul id="menu">
                    <li data-menuanchor="page1" class="active"><a data-name="home" href="#page1"><span>首页</span></a>
                    </li>
                    <li data-menuanchor="page2"><a href="#page2"><span>服务</span></a>
                    </li>
                    <li data-menuanchor="page3"><a href="#page3"><span>特色</span></a>
                    </li>
                    <li data-menuanchor="page4"><a href="#page4"><span>增值</span></a>
                    </li>
                    <li data-menuanchor="page5"><a href="#page5"><span>关于</span></a>
                    </li>
                    <li data-menuanchor="page6"><a href="#page6"><span>联系</span></a>
                    </li>
                    <li data-menuanchor=""><a href="/doc.php" target="_blank"><span>开发</span></a>
                    <li data-menuanchor=""><a href="/cxjc.php" target="_blank"><span>集成</span></a>
                    <li data-menuanchor=""><a href="/SDK/" target="_blank"><span>测试</span></a>
                        </li>
                     
                    <li style=" width:100%;float:right" id="index_x"><img alt="close" src="http://www.it96.top/picture/close.png" style="padding-right:15px; float:right; margin-top:10px">
                    </li>
                </ul>
            </nav>
            <div class="nav-tel" style="font-size:16px"><a href="/user/login.php" target="_blank">商户登录 </a><a href="/user/reg.php?my=add" target="_blank">申请商户 </a>
                <!-- | <a style="color:#fff" href="indexen.php">English</a>-->
            </div>
        </div>
</header>