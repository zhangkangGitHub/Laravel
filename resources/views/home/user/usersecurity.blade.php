@extends('home.layout.userds')
@section('content')
		<div class="m_right">
            <p></p>
            <div class="mem_tit">个人资料</div>
            <div class="m_des">
              <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="115"><a href="/home/user/usersecurity"><img src="/uploads/{{$_SESSION['home_userinfo']->profile}}" width="90" height="90" /></a></td>
                    <td>
                      <div class="m_user">{{$_SESSION['home_users']->uname}}</div>
                        <p>
                            等级：注册用户 <br />
                            <font color="#ff4e00">您还差 270 积分达到 分红100</font><br />
                        </p>
                    </td>
                  </tr>
                </table>  
            </div>
            <div>
                <form method="post" action="/home/user/phone">
                {{ csrf_field() }}
                <table border="0" style="width:880px;"  cellspacing="0" cellpadding="0">
                  <tr height="45">
                    <td width="80" align="right">昵称 &nbsp; &nbsp;</td>
                    <td><input type="text" value="{{$_SESSION['home_users']->uname}}" class="add_ipt" name="uname" style="width:180px;" />&nbsp; <font color="#ff4e00">*</font></td>
                  </tr>
                  <tr height="45">
                    <td align="right">密码 &nbsp; &nbsp;</td>
                    <td><input type="password" value="" class="add_ipt" style="width:180px;" name="pass" />&nbsp; <font color="#ff4e00">*</font></td>
                  </tr>
                  <tr height="45">
                    <td width="80" align="right">手机号 &nbsp; &nbsp;</td>
                    <td><input type="tel" value="{{$_SESSION['home_users']->phone}}" class="add_ipt" name="phone" style="width:180px;" />&nbsp; <font color="#ff4e00">*</font></td>
                  </tr>
                  <tr height="45">
                    <td width="80" align="right">邮箱 &nbsp; &nbsp;</td>
                    <td><input type="email" value="{{$_SESSION['home_users']->email}}" class="add_ipt" name="email" style="width:180px;" />&nbsp; <font color="#ff4e00">*</font></td>
                  </tr>
                  <tr height="50">
                    <td>&nbsp;</td>
                    <td><input type="submit" value="保存修改" class="btn_tj" /></td>
                  </tr>
                </table>
                </form>
            </div>
        </div>
    </div>
	<!--End 用户中心 End--> 
    @endsection    