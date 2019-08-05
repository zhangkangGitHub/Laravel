<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

    <link type="text/css" rel="stylesheet" href="/h/css/style.css" />
  </head>

  <body>

    <div class="soubg">
      <div class="sou">
        <span class="fr">
          <span class="fl">你好，请<a href="/home/user/login">登录</a>&nbsp; <a href="home/ register" style="color:#ff4e00;">免费注册</a>&nbsp; </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/h/images/s_tel.png" align="absmiddle" /></a></span>
        </span>
      </div>
    </div>

    <div class="res-banner">
      <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/h/images/l_img.png" /></div>

            <div class="login-box">

              <h3 class="title">登录商城</h3>

              <div class="clear"></div>
            
            <div class="login-form">
              <form method="post" action="/home/user/login">
              {{ csrf_field() }}
                 <div class="user-name">
                    <label for="user"><i class="am-icon-user"></i></label>
                    <input type="text" name="user" id="user" placeholder="邮箱/手机/用户名">
                 </div>
                 <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="upass" id="password" placeholder="请输入密码">
                 </div>
                 <div class="am-cf">
                  <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
                </div>
              </form>
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
                <a href="#" class="am-fr">忘记密码</a>
                <a href="/home/register" class="zcnext am-fr am-btn-default" style="width:55px;">&nbsp;&nbsp;注册</a>
                <br />
            </div>
                
            <div class="partner">   
                <h3>合作账号</h3>
              <div class="am-btn-group">
                <li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
                <li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
                <li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
              </div>
            </div>  

        </div>

      </div>
      
          <div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="/h/images/b_1.gif" width="98" height="33" /><img src="/h/images/b_2.gif" width="98" height="33" /><img src="/h/images/b_3.gif" width="98" height="33" /><img src="/h/images/b_4.gif" width="98" height="33" /><img src="/h/images/b_5.gif" width="98" height="33" /><img src="/h/images/b_6.gif" width="98" height="33" />
    </div>      
</div>
  </body>

</html>