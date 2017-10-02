<?php

    private $host       ="";
    private $username   ="";
    private $password   ="";
    private $dbname     ="";

    private $conn   ="";
    private $result ="";
    
    //Phương thức khởi tạo
    function __construct(){
        $this->Connect();
    }

    //Hàm kết nối csdl
    function Connect(){
        $conn = mysqli_connect($host,$username,$password,$dbname);
        //Kiểm tra xem lỗi kết nối gần nhất
        if(mysqli_connect_errno()){
            //Xuất ra nội dung lỗi
            echo "Connect Failed: ".mysqli_connect_errror();
            die();
        }
    }

    // Hàm ngắt kết nối csdl
    function Disconnect(){
        //Kiểm tra nếu đang kết nối đến csdl thì đóng kết nối
        if($this->conn){
            mysqli_close($this->conn);
        }
    }

     // Hàm thực thi câu truy vấn
     function Query($sql){
         //Kiểm tra đã kết nối csdl chưa
        if($this->conn){
            $this->result=mysqli_query($this->conn,$sql);
        }
    }

     // Hàm đếm số dòng trả về khi thực hiện truy vấn
     function numRows(){
        //Kiểm tra đã có kết quả trả về từ câu truy vấn chưa
        if($this->result){
            $rows = mysqli_num_rows($this->result);
        }else{
            $rows = 0;
        }
        return $rows;
    }

     // Hàm lấy 1 dòng dữ liệu từ câu SELECT
     function fetch(){
        //Kiểm tra đã có kết quả trả về từ câu truy vấn chưa
        if($this->result){
            $data = mysqli_fetch_array($this->result);
        }
        return $data;
    }

     // Hàm lấy tất cả dòng dữ liệu từ câu SELECT
     function fetchAll(){
        if($this->result){
            //Lấy dữ liệu từng dòng
            while($row = mysqli_fetch_array()){
                $data[]= $row;
            }
        }
        return $data;
    }


    //Phương thưc hủy
     function __destruct(){
         $this->Disconnect();
     }
?>