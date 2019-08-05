<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
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
          <span class="fl">你好，请<a href="/home/user/login">登录</a>&nbsp; <a href="home/register" style="color:#ff4e00;">免费注册</a>&nbsp; </span>
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

            <div class="am-tabs" id="doc-my-tabs">
              <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                <li class="am-active"><a href="">邮箱注册</a></li>
                <li><a href="">手机号注册</a></li>
              </ul>

              <div class="am-tabs-bd">
                <div class="am-tab-panel am-active">
                  <form method="post" action="/home/register">
                  {{ csrf_field() }}
                   <div class="user-email">
                      <label for="email"><i class="am-icon-envelope-o"></i></label>
                      <input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                   </div>          
                      <div class="user-pass">
                        <label for="password"><i class="am-icon-lock"></i></label>
                        <input type="password" name="upass" id="password"placeholder="设置密码">
                      </div>                   
                      <div class="user-pass">
                        <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                        <input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
                      </div> 
                    <div class="am-cf">
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                  </form>
                 
                  <div class="login-links">
                    <label for="reader-me">
                      <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                    </label>
                  </div>
                  

                </div>

                <div class="am-tab-panel">
                  <form method="post" action="/home/register/insert">
                  {{ csrf_field() }}
                    <div class="user-phone">
                      <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                      <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                    </div>                                     
                    <div class="verification">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码">
                      <a class="btn" href="javascript:void(0);" onClick="sendMobileCode();" id="sendMobileCode">
                        <span id="dyMobileButton" style="width: 55px;">获取</span>
                     </a> 
                    </div>
                    <div class="user-pass">
                      <label for="password"><i class="am-icon-lock"></i></label>
                      <input type="password" name="upass" id="password" placeholder="设置密码">
                    </div>                   
                    <div class="user-pass">
                      <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                      <input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
                    </div> 
                    <div class="am-cf">
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                  </form>
                 <div class="login-links">
                    <label for="reader-me">
                      <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                    </label>
                  </div>
                </div>

                <script>
                  $(function() {
                      $('#doc-my-tabs').tabs();
                    })
                </script>
                <script>
                  function sendMobileCode()
                  {  
                    //获取用户的验证码
                    let phone = $('#phone').val();    
                    //验证格式
                    let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;

                    if(!phone_preg.test(phone)){
                      alert('手机号格式不正确');
                      return false;
                    }

                    let dyMobileButton = $('#dyMobileButton');
                    let con = dyMobileButton.html();
                    // 设置按钮样式
                    dyMobileButton.attr('disabled',true);
                    dyMobileButton.css('color','#ccc');
                    dyMobileButton.css('cursor','not-allowed');
                    let time = null;

                    if(con == '获取'){
                      let i = 60;
                      time = setInterval(function(){
                        i--;
                        dyMobileButton.html('('+i+')发送');

                        if(i <= 0){
                          clearInterval(time);
                          // 设置按钮样式
                          dyMobileButton.attr('disabled',false);
                          dyMobileButton.css('color','#333');
                          dyMobileButton.css('cursor','pointer');
                          dyMobileButton.html('获取');
                        }
                      },1000);

                      //发送ajax 发送验证码
                      $.get('/home/register/sendPhone',{phone},function(res){
                        if(res.error_code == 0){
                          alert('发送成功,验证码10分钟之内有效');  
                        }else{
                          alert('发送失败');
                        }
                      },'json');
                    }
                  }
                </script>
              
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