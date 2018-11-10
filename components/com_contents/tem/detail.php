<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
	$code=addslashes($_GET['code']);
    /*Update view*/
    $obj->updateView($code);

}
else die("PAGE NOT FOUND");
    $strWhere='WHERE `code`="'.$code.'"';
    $obj->getList($strWhere);
    $row=$obj->Fetch_Assoc();
    $intro=strip_tags(Substring($row['intro'], 0, 100));
    $fulltext=html_entity_decode($row['fulltext']);
?>
<div class="page-content">
    <div class="detail-news">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="detail-content">
                        <div class="box-breadcrumb">
                            <ul class="breadcrumb">
                                <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ">Trang chủ</a></li>
                                <li><a href="<?php echo ROOTHOST;?>tin-tuc" title="Tin tức">Tin tức</a></li>
                                <li><?php echo $row['title'];?></li>
                            </ul>
                        </div>
                        <div class="box-item">
                            <h3 class="title">
                                <?php echo $row['title'];?>
                            </h3>
                            <p class="intro">
                                <?php echo $intro;?>
                            </p>
                            <div class="fulltext">
                                <?php echo $fulltext;?>
                            </div>
                            <div class="author">
                                Tác giả: <?php echo $row['author'];?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?php include_once(MOD_PATH.'mod_content/layout.php');?>

                </div>
            </div>
        </div>
    </div>
    <div class="blog-relater">
        <div class="container">
            <h3 class="title">Tin liên quan</h3>
            <div class="row">
                    <?php
                    $strWhere="INNER JOIN tbl_category
                    ON `tbl_contents`.`cate_id`=`tbl_category`.`id` AND `tbl_contents`.`id` NOT IN (1,2)
                    WHERE `tbl_contents`.`id` LIMIT 0,6";
                    $obj->getList($strWhere);
                    $i=0;
                    while($rows=$obj->Fetch_Assoc()){
                    $i++;
                    $date = date("d/m/Y", strtotime($rows['cdate']));
                    $img=getThumbNews($rows['thumb'],'img-responsive thumb-blog');
                    $url=ROOTHOST."tin-tuc/".$rows['code'].".html";
                    /*if($i!=3){*/
                    ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="item">
                            <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $img;?></a>
                            <div class="col-content">
                                <h3 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></h3>
                                <span class="date">Ngày <?php echo $date;?></span>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
        </div>
    </div>
</div>
