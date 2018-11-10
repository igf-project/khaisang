<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/jquery.lightbox.css">
<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/demo.css">
<script>
    function submitFrm(value){
        $('#frm_cate').submit();
    }
</script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.gallery.php');
$obj=new CLS_GALLERY();
if(isset($_POST['cbo_album']))
    $_SESSION['CBO_ALBUM']=addslashes($_POST['cbo_album']);
$album_id=isset($_SESSION['CBO_ALBUM']) ? $_SESSION['CBO_ALBUM']:'';
?>
<div class="box-gallery">
    <div class="container">
        <div class="box-cate">
            <form id="frm_cate" method="POST">
                <h3 class="title-main">
                    <?php echo $obj->getName($album_id);?>
                </h3>
                <select name="cbo_album" onchange="submitFrm(this.value)">
                    <?php $obj->getListCbAlbum($album_id);?>
                </select>
            </form>
        </div>

        <div class="gallery">
            <div class="row">
                <?php

                $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                $start='';
                if($album_id=='')
                    $sql="SELECT * FROM `tbl_gallery` INNER JOIN `tbl_album` ON tbl_gallery.album_id=tbl_album.id WHERE `isactive`=1";
                else
                    $sql="SELECT * FROM tbl_gallery WHERE isactive=1 AND `album_id`='$album_id'";
                $objdata=new CLS_MYSQL();
                $objdata->Query($sql);
                $total_rows=$objdata->Num_rows();
                $total_page=ceil($total_rows/MAX_ROWS_GALLERY);
                $start=($cur_page-1)*MAX_ROWS_GALLERY;
                $sql.=" LIMIT ".$start.",".MAX_ROWS_GALLERY."";
                $objdata->Query($sql);
                WHILE($rows=$objdata->Fetch_Assoc()){?>
                    <div class="col-md-3 col-sm-3 col-xs-6 col-item">
                        <a href="<?php echo ROOTHOST.PATH_GALLERY.$rows['link'];?>"><img src="<?php echo ROOTHOST.PATH_GALLERY.$rows['link'];?>" alt="Image" class="img-responsive"></a>
                    </div>
                <?php }?>
            </div>

        </div>
        <div class="text-center">
            <?php
            paging($total_rows, MAX_ROWS_GALLERY, $cur_page);
            ?>
        </div>
    </div>
</div>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery.lightbox.min.js"></script>
<script>
    // Initiate Lightbox
    $(function() {
        $('.gallery a').lightbox();
    });
</script>

