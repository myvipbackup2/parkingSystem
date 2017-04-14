<?php
$login_user = $this->session->userdata('admininfo');
if (!$login_user) {
    redirect('login');
}
?>
<div class="header-section">

    <!--toggle button start-->
    <a class="toggle-btn"><i class="fa fa-bars"></i></a>
    <!--toggle button end-->

    <!--search start-->
    <!--<form class="searchform" action="index.html" method="post">
        <input type="text" class="focss
fonts
lessrm-control" name="keyword" placeholder="全文搜索..." />
    </form>-->
    <!--search end-->

    <!--notification menu start -->
    <div class="menu-right">
        <ul class="notification-menu">
            <li>
                <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge">
                        <?php
                        $unread = $this->session->userdata('unread');
                        echo count($unread);
                        ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-head pull-right">
                    <h5 class="title">You have 5 Mails </h5>
                    <ul class="dropdown-list normal-list">
                        <li class="new">
                            <a href="">
                                <span class="thumb"><img src="images/photos/user1.png" alt=""/></span>
                                <span class="desc">
                                          <span class="name">John Doe <span
                                                      class="badge badge-success">new</span></span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="thumb"><img src="images/photos/user2.png" alt=""/></span>
                                <span class="desc">
                                          <span class="name">Jonathan Smith</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="thumb"><img src="images/photos/user3.png" alt=""/></span>
                                <span class="desc">
                                          <span class="name">Jane Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="thumb"><img src="images/photos/user4.png" alt=""/></span>
                                <span class="desc">
                                          <span class="name">Mark Henry</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="thumb"><img src="images/photos/user5.png" alt=""/></span>
                                <span class="desc">
                                          <span class="name">Jim Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                            </a>
                        </li>
                        <li class="new"><a href="">Read All Mails</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $login_user->img_src; ?>" alt=""/>
                    管理员
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="admin/update"><i class="fa fa-user"></i> 更改个人信息</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> 设置</a></li>
                    <li><a href="admin/logout"><i class="fa fa-sign-out"></i> 退出系统</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!--notification menu end -->

</div>