<?php
	class Data
	{
		private static $servername = "localhost";
		private static $username = "root";
		private static $password = "";
		private static $databaseName = "datahuemobi";

		private static $conn = null;

		public function __construct() {
			exit('Init function is not allowed');
		}
		
		public static function connect()
		{
		   // One connection through whole application
	       if ( null == self::$conn )
	       {      
		        self::$conn = mysqli_connect(self::$servername, self::$username, self::$password, self::$databaseName);
		        self::$conn->set_charset("utf8");
		        if (!self::$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}
	       } 
	       return self::$conn;
		}
		
		public static function disconnect()
		{
			mysqli_close(self::$conn);
		} 

		public static function selectTable($conn,$nametable,$id,$dataid)//lấy dữ liệu từ $nametable có điều kiện hoặc không, nếu có điều kiện thì theo $id có dữ liệu kiểm tra là $dataid, ngược lại không có diều kiện các biến chuổi rổng "" xảy ra lổi nếu có kết quả null -> dùng để kiểm tra mã id
		{
			if ($conn!=null&&$nametable!=null) {
				if($id!="")
				{
					$sql="SELECT * FROM ".$nametable." WHERE ".$id."='$dataid'";
				}
				else
				{
					$sql="SELECT * FROM ".$nametable;
				}
				$results=mysqli_query($conn,$sql);
				if($results!=null){
					if(mysqli_num_rows($results)>0){
						return $results;
					}
					else
						return null;
				}
				else
					return null;
			}
			else
				return null;
		}
	}
?>