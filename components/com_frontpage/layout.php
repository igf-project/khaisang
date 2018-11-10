<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($objContent)) $objContent=new CLS_CONTENTS();
?>
<div class="box box-news">
    <div class="container">
        <div class="box-title">
            <h2 class="title-main"><a href="">Tin tức Poly</a></h2>
            <a href="#" class="link-readmore">Xem thêm</a>
        </div>
        <div class="row">
            <?php $objContent->getListItem(" WHERE cate_id='1'",'LIMIT 0,3');?>
        </div>
    </div>
</div>

<div class="box-group container">
    <div class="row">
        <div class="col-sm-4">
            <div class="box-title">
                <h2 class="title-main"><a href="">Sự kiện</a></h2>
            </div>
            <ul class="list list-event">
                <?php
                $sql="SELECT * FROM tbl_contents WHERE cate_id='1' AND `isactive`=1 LIMIT 0,8";
                $objdata=new CLS_MYSQL();
                $objdata->Query($sql);
                while($rows=$objdata->Fetch_Assoc()){
                    $img= getThumb($rows['thumb'], 'img-responsive thumb-avatar',$rows['title']);
                    $cdate=date('d-m-Y', strtotime($rows['cdate']));
                    $title=$rows['title'];
                    $intro=Substring($rows['title'],0,15);
                    $url=ROOTHOST.$rows['code'].".html";
                    ?>
                    <li class="item">
                        <div class="box-date">
                            <p class="title-date">Thứ 7</p>
                            <p class="date"><?php echo $cdate;?></p>
                        </div>
                        <div class="content">
                            <a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a>
                            <p><?php echo $intro;?></p>
                        </div>

                    </li>
                <?php }?>
            </ul>
        </div>
        <div class="col-sm-8">
            <div class="box-title">
                <h2 class="title-main"><a href="">Góc nhìn</a></h2>
            </div>
            <ul class="list list-view">
                <?php
                $sql="SELECT * FROM tbl_contents WHERE cate_id='1' AND `isactive`=1 LIMIT 0,8";
                $objdata=new CLS_MYSQL();
                $objdata->Query($sql);
                $i=0;
                while($rows=$objdata->Fetch_Assoc()){
                    $i++;
                    $img= getThumb($rows['thumb'], 'thumb-avatar',$rows['title']);
                    $cdate=$rows['cdate'];
                    $title=$rows['title'];
                    $intro=Substring($rows['intro'],0,38);
                    ?>
                    <?php if($i==1){?>
                        <li class="item item-first">
                            <div class="box-img"><?php echo $img;?></div>
                            <a class="name" href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a>
                            <p><?php echo $intro;?></p>
                        </li>
                    <?php }else {?>
                        <li class="item"> <a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a></li>
                    <?php }?>
                <?php }?>
                <div class="clearfix"></div>
            </ul>
            <div class="row box-gallery">
                <div class="col-md-7">
                    <div class="gallery">
                        <div class="box-title">
                        <h2 class="title-main"><a href="">Gallery</a></h2>
                        </div>
                        <div class="row row-item">
                            <?php $objAlbum=new CLS_ALBUMGALLERY();
                            $objAlbum->getListAlbum();
                            ?>
                        </div>

                    </div>


                </div>
                <div class="col-md-5">
                    <div class="gallery contact-us">
                        <div class="box-title">
                            <h2 class="title-main"><a href="">Contact Us</a></h2>
                        </div>
                        <div class="fb-page"
                             data-href="https://www.facebook.com/vieclamhumg/"
                             data-width="380"
                             data-hide-cover="false"
                             data-show-facepile="true"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-partner">
    <div class="container ">
        <div class="box-title">
            <h2 class="title-main"><a href="">Đối tác tuyển dụng</a></h2>
        </div>
        <div class="content-control">
            <button class="btn-control prev-control prev1"><i class="fa fa-angle-left"></i></button>
            <button class="btn-control next-control next1"><i class="fa fa-angle-right"></i></button>
            <div class="content-slider">
                <div id="slider_item1" class="owl-carousel">
                    <?php
                    $sql="SELECT * FROM tbl_partner WHERE `type`=1 ORDER BY `order` DESC LIMIT 0,8";
                    $objdata=new CLS_MYSQL();
                    $objdata->Query($sql);
                    while($rows=$objdata->Fetch_Assoc()){
                        $img= getThumb($rows['thumb'], 'img-responsive thumb-avatar',$rows['name']);
                        ?>
                        <div class="item">
                            <?php echo $img;?>
                        </div>
                    <?php }
                    ?>
                </div>
                <script>
                    $(document).ready(function(){
                        slider_item(1);
                    });
                </script>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
</div>
<div class="box box-feedback">
    <div class="container content-control">
        <h2 class="title-main">Testimonial</h2>
        <div class="group-btn">
            <button class="btn-control prev-control prev-feedback"><i class="fa fa-angle-left"></i></button>
            <button class="btn-control next-control next-feedback"><i class="fa fa-angle-right"></i></button>
        </div>

        <div id="slider_feedback" class="owl-carousel">
            <?php
            $sql="	SELECT * FROM tbl_feedback ORDER BY `order` DESC LIMIT 0,8";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);
            while($rows=$objdata->Fetch_Assoc()){
                $intro = Substring(stripslashes($rows['intro']),0,30);
                $img= getThumb($rows['thumb'], 'img-responsive thumb-avatar',$rows['name']);
                ?>
                <div class="item">
                    <?php echo $img;?>
                    <div class="content">
                        <p class="txt"><?php echo $intro;?></p>
                        <p class="txt-author"><span class="author"><?php echo $rows['name'];?></span> - <?php echo $rows['address'];?></p>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <script>
            $(document).ready(function(){
                slider_feedback();
            });
        </script>
    </div>
    <div class="clearfix"></div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=825527060821418";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
