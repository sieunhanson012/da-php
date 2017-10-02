<?php 
	/**
	* 
	*/
	class accountModel extends database
	{
		// Mặc định khi đk tiền = 0 , quyền = 1 , trạng thái = 0
		public function Register($name,$password,$email,$phone){
			$sql="SELECT * FROM taikhoan WHERE Email='$email'";
			$this->Query($sql);
			// Kiểm tra email đã tồn tại chưa
			if($this->numRows()>0){
				return false;
			}else{
				$sql = "INSERT INTO taikhoan VALUES('$name','$password','$email','$phone','0','1','0')";
				$this->Query($sql);	
			}
        }
        
		public function Login($email,$password){
			$sql="SELECT * FROM taikhoan WHERE Email='$email' and MatKhau='$password' ";
			$this->Query($sql);
			//kiểm tra nhập mật khẩu hoặc email có đúng k
			if($this->numRows()>0){
				$row = $this->Fetch();
				//lưu lại tên người đăng nhập và quyền
				$_SESSION['name_lg']=$row['HoTen'];
				$_SESSION['type_lg']=$row['Quyen'];
			}else{
				return false;
			}
        }
        
		public function Logout(){
			session_destroy();
        }
        
		public function Edit($id,$name,$email,$password,$phone,$money,$type,$status){
			$sql = "UPDATE taikhoan SET HoTen  ='$name',
				Email      	='$email',
				MatKhau   	='$password',
				SDT      	='$phone',
				Tien    	='$money',
				Quyen     	='$type',
				TrangThai  	='$status'
			WHERE id = '$id'";
			$this->Query($sql);
        }
        
		public function Delete($id){
			$sql = "DELETE FROM taikhoan WHERE MaTK = '$id'";
			$this->Query($sql);
		}

		public function Lock($id){
			$sql = "UPDATE  taikhoan SET TrangThai = '1' WHERE id = '$id'";
            $this->Query($sql);
		}
			
		public function Unlock($id){
			$sql = "UPDATE  taikhoan SET TrangThai = '0' WHERE id = '$id'";
            $this->Query($sql);		
		}

		public function PayWithCard(){
			// Mặc định là 500k
			$sql = "INSERT INTO taikhoan (Tien) VALUES ('500000') WHERE MaTK = '$id'";
			$this->Query($sql);
		}

	}

 ?>