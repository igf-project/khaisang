<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `id`='".$id."'");
$row=$obj->Fetch_Assoc();
?>
<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>js/searchableOptionList.js"></script>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            if($("#cbo_group").val()==""){
                $("#cbo_group_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng chọn Group sản phẩm').fadeTo(900,1);
                });
                $("#cbo_group").focus();
                return false;
            }
            if($("#cbo_cataloggroup").val()==""){
                $("#cbo_cataloggroup_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng chọn chuyên mục').fadeTo(900,1);
                });
                $("#cbo_cataloggroup").focus();
                return false;
            }
            return true;
        }
    </script>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-sm-3 form-control-label">Tên nhóm*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="" value="<?php echo $row['name'];?>">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-sm-3 form-control-label">Group*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cbo_group" name="cbo_group">
                                        <option value="">--- Chọn Group sản phẩm ---</option>
                                        <?php
                                        include_once(LIB_PATH.'cls.group.php');
                                        $objCb=new CLS_GROUP();
                                        $objCb->getListCbItem($row['group_id']);
                                        ?>
                                    </select>
                                    <div id="cbo_group_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-sm-3 form-control-label">Chuyên mục*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cbo_cataloggroup" name="cbo_cataloggroup">
                                        <option value="">--- Chọn chuyên mục sản phẩm ---</option>

                                        <?php
                                        include_once(LIB_PATH.'cls.cataloggroup.php');
                                        $objCb=new CLS_CATALOGGROUP();
                                        $objCb->getListCbItem($row['catagroup_id']);
                                        ?>
                                    </select>
                                    <div id="cbo_cataloggroup_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>
