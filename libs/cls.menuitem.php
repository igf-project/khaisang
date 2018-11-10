<?php
class CLS_MENUITEM{
	private $objmysql=null;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($mnuid=0,$where=""){
		if($where!="")
			$where=" WHERE `mnu_id`='$mnuid' AND ".$where;
		$sql="SELECT * FROM `view_menuitem` ".$where;
		return $this->objmysql->Query($sql);
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function ListTopmenu($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order` ASC, mnuitem_id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$total = $objdata->Num_rows();
		if($total<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
			
		$str='<ul>';  	
		while($rows=$objdata->Fetch_Assoc()){
		
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList("AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
                $objcon=new CLS_CONTENTS;
				$objcat->getList("AND cat_id = '".$rows['cat_id']."' ");
				$objcat=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$objcat['code'].'/';
			}
			$cls='';
			$curmenu=$_SESSION['CUR_MENU'];
			$cursub=$_SESSION['CUR_SUB_MENU'];
			if(isset($curmenu) && $curmenu!='')
				$cls='';
			if($curmenu==$rows['mnuitem_id'] || $cursub==$rows['mnuitem_id'])
				$cls=' class="active" ';
				
			$cls.='class="'.$rows['class'].'"';
			$str.="<li $cls><a href=\"$urllink\" title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			$str.=$this->ListTopmenu($mnuid,$rows["mnuitem_id"],$level+1);
			$str.='</li>';	
		}
		$str.='</ul>';  
		return $str;
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=0){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		 //echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style="";$str='';
		if($level>=1) $str.="<ul class=\"dropdown-menu\">";
		else $str="
			<div class='navbar-header'>
				<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
	                                    <span class=\"sr-only\">Toggle navigation</span>
	                                    <span class=\"icon-bar\"></span>
	                                    <span class=\"icon-bar\"></span>
	                                    <span class=\"icon-bar\"></span>
	                             </button>
				<a class='navbar-brand' href='".ROOTHOST."'>".
					"<img src='". ROOTHOST.THIS_TEM_PATH."images/logo.png' \" class=\"logo\"></a> ".
				 "
			</div>
			 <div id=\"navbar\" class=\"navbar-collapse collapse menu\">
			
			<ul class='nav navbar-nav '>";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
            //echo $rows['cat_id'];
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList(" WHERE id = '".$rows['con_id']."'");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList(" WHERE id = '".$rows['cat_id']."'");
				$row_cat=$objcat->Fetch_Assoc();
				$urllink=ROOTHOST.$row_cat['code'].'/';
			}
		   $curmenu=isset($_SESSION['CUR_MENU']) ? $_SESSION['CUR_MENU']:'';
            $cursub=isset($_SESSION['CUR_SUB_MENU']) ? $_SESSION['CUR_SUB_MENU']:'';
            if(isset($curmenu) && $curmenu!='')
                $cls='';
			$cls='';
			if($curmenu==$rows['mnuitem_id'] || $cursub==$rows['mnuitem_id']) $cls.=' active ';
			$cls.=" ".$rows['class']." ";
			$child = $this->ListMenuItem($mnuid,$rows["mnuitem_id"],$level+1);
			if($child) $cls.=" dropdown ";	
			$cls = $cls!=''?"class='".$cls."'":'';
			
			$str.="<li $cls>";
			if(!$child)
				$str.="<a href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			else {
				$str.="<a class='dropdown-toggle'  role='button' aria-haspopup='true'  aria-expanded='false' href='".$urllink."' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
                $str.="<span class='bulet-dropdown'></span>";
				$str.=$child;
			}
			$str.='</li>';			
		}
		$str.='</ul>';  
		return $str;
		// data-toggle=\"dropdown\" 
	}
}
?>