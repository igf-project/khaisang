<?php
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
if($objmem->isLogin()){
    $username=$objmem->getInfo('username');
    $driver=$objmem->getInfo('driver');
    ?>
    <div class="itemb">
        <?php
        $objmem->getList("WHERE `username`='$username'");
        $rows=$objmem->Fetch_Assoc();
        $thumb=$rows['avata']!=''? $rows['avata']:ROOTHOST.AVATAR_DEFAULT;
        ?>
        <div class="media">
            <img class="media-object" src="<?php echo $thumb;?>"/>
            <div class="media-heading">
                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                <p>LV: Học viên</p>
            </div>
        </div>
        <?php if($driver =='system'){?>
            <ul class="list-group">
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/tutorial"><i class="fa fa-refresh"></i> Tutorial</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/course"><i class="fa fa-book"></i> Khóa học của tôi</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/subject"><i class="fa fa-server"></i> Quản lý chủ đề</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/topic"><i class="fa fa-tasks"></i> Quản lý Topic</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/software"><i class="fa fa-file-code-o"></i> Quản lý phần mềm</a></li>

            </ul>
        </div>
        <div class="itemb">
            <ul class="list-group">
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/profiles"><i class="fa fa-info-circle"></i> Thông tin cá nhân</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/changepass"><i class="fa fa-user"></i> Đổi mật khẩu</a></li>
                <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/feedback"><i class="fa fa-sign-in"></i> Ý kiến, phản hồi</a></li>
                <li id='cmd_logout' class="list-group-item"><a href="#" rel='nofollow,noindex'><i class="fa fa-power-off"></i> Đăng xuất</a></li>
            </ul>
        </div>
    <?php }else{?>
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/profiles"><i class="fa fa-info-circle"></i> Thông tin cá nhân</a></li>
            <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/changepass"><i class="fa fa-user"></i> Đổi mật khẩu</a></li>
            <li class="list-group-item"><a href="<?php echo ROOTHOST;?>member/feedback"><i class="fa fa-sign-in"></i> Ý kiến, phản hồi</a></li>
            <li id='cmd_logout' class="list-group-item"><a href="#" rel='nofollow,noindex'><i class="fa fa-power-off"></i> Đăng xuất</a></li>
        </ul>
        </div>
    <?php }?>
    <script>
        $(document).ready(function(){
            $('#cmd_logout').click(function(){
                $.get('<?php echo ROOTHOST;?>ajaxs/mem/logout.php',function(req){
                    location.href='<?php echo ROOTHOST;?>';
                    return false;
                })
            });
        })
    </script>
    <?php
}
?>
