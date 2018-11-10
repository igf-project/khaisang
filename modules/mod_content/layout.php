<?php
$code=isset($_GET['code']) ? addslashes($_GET['code']):'';
$strWhere="WHERE isactive=1";
?>
<div class="mod list-category">
    <h3 class="title">
        Nhóm tin
    </h3>
    <ul>
        <?php
        $sql="SELECT * FROM tbl_category $strWhere";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $title=Substring($rows["name"], 0 , 50);
            $url=ROOTHOST.$rows['code'].'/';
            ?>
            <li>
                <a class="<?php if($code==$rows['code']) echo 'active';?>" href="<?php echo $url;?>" title="<?php echo $title;?>"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $title;?></a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="mod list-latest-news">
    <h3 class="title">
        Tin nổi bật
    </h3>
    <ul class="latest-post">
        <?php
        $sql="SELECT * FROM tbl_contents $strWhere /*AND ishot=1*/ LIMIT 0,8";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<1) echo 'Dữ liệu đang được cập nhật';
        while($rows=$objdata->Fetch_Assoc()){
            $title=Substring($rows["title"], 0 , 50);
            $date = date("d/m/Y", strtotime($rows['cdate']));
            $img= getThumb($rows['thumb'], 'img-responsive thumb-hot',$rows['title']);
            ?>
            <li>
                <a href="<?php echo $url;?>">
                    <?php echo $img;?>
                </a>
                <div class="recent-post-details">
                    <a class="post-title" href="<?php echo $url;?>"><?php echo $title;?></a>
                   <span class="txt-time"><i class="fa fa-clock-o"></i> <?php echo $date;?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
