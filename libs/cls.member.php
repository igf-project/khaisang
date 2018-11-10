<?php
class CLS_MEMBER{
	private $pro=array(
		'Username'=>'',
		'Password'=>'',
		'Driver'=>'system',
		'Uid'=>'',
		'First_name'=>'',
		'Last_name'=>'',
		'Birthday'=>'',
		'Gender'=>'',
		'Avata'=>'',
		'Address'=>'',
		'CDate'=>'',
		'City'=>0,
		'Country'=>0,
		'Tel'=>'',
		'Email'=>'',
		'Facebook'=>'',
		'Twitter'=>'');
	private $objmysql=null;
	public function CLS_MEMBER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_member_profile` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function getNameByUser($user){
		$sql="SELECT CONCAT(last_name,' ',first_name) AS fullname FROM `tbl_member_profile` WHERE username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['fullname'];
	}
	public function getAvarByUser($user){
		$sql="SELECT avata FROM `tbl_member_profile` WHERE username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		if($row['avata']!='') return $row['avata'];
		else return ROOTHOST.AVATAR_DEFAULT;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	//--------------------------------------------------------------------------
	public function ChangePass($user,$pass){
		$pass=md5(sha1($pass));
		$sql="UPDATE tbl_member_account SET password='$pass' WHERE username='$user' ";
		return $this->objmysql->Exec($sql);
	}
	public function SystemLogin($user,$pass){
		$pass=md5(sha1($pass));
		$sql="SELECT * FROM tbl_member_account WHERE isactive=1 AND username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$r=$objdata->Fetch_Assoc();
		if($pass==$r['password']){
			// login success
			$this->setUserLogin($r);
			$this->setActionTime();
			// update thông tin
			$this->setInfoLogin($user);
			return true;
		}else{
			/*return false;*/
            return true;
		}
	}
	public function isLogin(){
		if(!isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]))
			return false;
		if(!isset($_SESSION['ACTION_TIME']))
			return false;
		$this_time=time();
		if($this_time-$_SESSION['ACTION_TIME']>10*60){
			$this->Logout();
			return false;
		}
		return true;
	}
	public function Logout(){
		unset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]);
		unset($_SESSION['ACTION_TIME']);
	}
	public function setInfoLogin($user){
		$this_time=time();
		$sess_id=session_id();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="UPDATE tbl_member_account SET iplogin='$ip', session_id='$sess_id', lastlogin=$this_time, WHERE username='$user'";
		$this->objmysql->Exec($sql);
	}
	public function setActionTime(){
		$_SESSION['ACTION_TIME']=time();
	}
	public function setUserLogin($r){
		$_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]=$r;
	}
	public function getUserLogin(){
		if(isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]))
			return json_decode($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]);
		else return;
	}

    public function checkSystem($driver){
        if($driver=='system') return true;
        else return false;
    }
    public function isAdmin($driver){
        if($driver=='system') return true;
        else return false;
    }
    public function getInfo($name){
		if(isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])][$name]))
			return $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])][$name];
		return '';
	}
	//-----------------------------------------------------------------
	Public function Add_new(){
		$sql="INSERT INTO tbl_member_account(`username`,`password`,`driver`,`uid`, `cdate`) VALUES ('{$this->Username}','{$this->Password}','{$this->Driver}','{$this->Uid}', '{$this->CDate}')";
	
		$result1=$this->objmysql->Exec($sql);
		$sql="INSERT INTO `tbl_member_profile`(`username`, `first_name`, `last_name`, `birthday`, `gender`, `avata`, `address`, `city`, `country`, `tel`, `email`, `facebook`, `twitter`) VALUES ('{$this->Username}','{$this->First_name}','{$this->Last_name}','{$this->Birthday}','{$this->Gender}',
			'{$this->Avata}','{$this->Address}','{$this->City}','{$this->Country}','{$this->Tel}','{$this->Email}','{$this->Facebook}','{$this->Twitter}')";

		$result2=$this->objmysql->Exec($sql);
		if($result1==true && $result2==true)
			return true;
		else
			return false;
	}
    /*public function Update(){
        $sql="UPDATE tbl_member_profile SET username='{$this->Username}',first_name='{$this->First_name}',last_name='{$this->Last_name}',birthday='{$this->Birthday}',gender='{$this->Gender}',
			avata='{$this->Avata}',address='{$this->Address}',city='{$this->City}',country='{$this->Country}',tel='{$this->Tel}',email='{$this->Email}',facebook='{$this->Facebook}',twitter='{$this->Twitter}')";
        $this->objmysql->Exec($sql);
    }*/
	public function Update(){
		$sql="UPDATE tbl_member_profile SET first_name='{$this->First_name}',last_name='{$this->Last_name}',birthday='{$this->Birthday}',gender='{$this->Gender}',
			avata='{$this->Avata}',address='{$this->Address}', tel='{$this->Tel}', email='{$this->Email}', facebook='{$this->Facebook}', twitter='{$this->Twitter}' WHERE `username`='{$this->Username}'";
		$this->objmysql->Exec($sql);
	}
	public function UpdateAvar(){
		$sql="UPDATE `tbl_member_profile` SET `avata`='".$this->Avata."' ";
		$sql.=" WHERE `username`='{$this->Username}'";
	}
    public function getListTeacher($strwhere="", $limit=""){
        global $stt;
        $sql="SELECT *
			FROM `tbl_member_profile` ".$strwhere." ".$limit."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $stt++;
            $name=$rows['first_name']." ".$rows['last_name'];
            $url='';
            $link_face='<a href="'.$rows["facebook"].'" class="fa fa-facebook"></a>';
            /*$url=ROOTHOST."giang-vien/".$rows['code'].".html";*/
            ?>
            <div class="col-md-4 col-sm-4 item prof">
                <a href="<?php echo $url;?>" title="<?php echo $name;?>"><img src="<?php echo $rows['avata'];?>" class="img-responsive img-circle");?></a>
                <h4><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $name;?></a></h4>
                <p class="cc">Team Leader</p>
                <div class="tb-socio">
                    <?php if($rows["facebook"]!=''){
                        echo '<a href="'.$rows["facebook"].'" class="fa fa-facebook"></a>';
                    }
                    if($rows["email"]!=''){
                        echo '<a href="'.$rows["email"].'" class="fa fa-envelope"></a>';
                    }
                    if($rows["twitter"]!=''){
                        echo '<a href="'.$rows["twitter"].'" class="fa fa-twitter"></a>';
                    }
                    ?>
                </div>
            </div>
        <?php endwhile;
    }
}
?>