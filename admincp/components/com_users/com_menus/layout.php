<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','menus');
	
	// Begin Toolbar
	include_once(LAG_PATH.'vi/lang_menu.php');
	include_once(libs_path.'cls.menu.php');
	
	$objlang=new LANG_MENU;
	$obj=new CLS_MENU();
	
	$title_manager = $objlang->MENUS_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->MENU_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->MENU_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
	if(isset($_POST['txttask']) && $_POST['txttask']==1){
		$obj->Code=addslashes($_POST['txtcode']);
		$obj->Name=addslashes($_POST['txtname']);
		$sContent=addslashes($_POST['txtdesc']);
		$obj->Desc=addslashes(encodeHTML($sContent));
		$obj->isActive=(int)$_POST['optactive'];
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		?>
		<script language="javascript">window.location='index.php?com=<?php echo COMS;?>'</script>
		<?php
		}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=$_POST['txtids'];
		$ids=str_replace(',',"','",$ids);
		switch ($_POST['txtaction'])
		{
			case 'public': 		$obj->setActive($ids,1); 		break;
			case 'unpublic': 	$obj->setActive($ids,0); 		break;
			case "edit": 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				exit();
				break;
			case 'delete': 		$obj->Delete($ids); 			break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}

	define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task);	unset($ids);
	unset($obj);	unset($objlag);
?>