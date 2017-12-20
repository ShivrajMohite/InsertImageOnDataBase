

<!DOCTYPE html>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> Registration Form </title>
	
<!-- INSERT DATA -->

<?php
		if(isset($_POST["submit"])){
   		$check = getimagesize($_FILES["image"]["tmp_name"]);
    	if($check !== false){
    	$name = $_POST['name'];
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        $servername = "localhost";
		$username = "root";
		$password = "";
		$database = "imagedb";
        
        //Create connection and select DB
        $conn = new mysqli($servername, $username, $password, $database );
        
        // Check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        
       // $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $query = "INSERT into images (Name,image) VALUES ('$name','$imgContent')";
        $insert = mysqli_query($conn,$query);
        if($insert){
            echo "<script>alert('File uploaded successfully.');</script>";
            
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>

</head>
<body>
	<div class="container">
		<table class="table table-straped table-bordered table-hover" id="mydata">
		 <form method="post" enctype="multipart/form-data">
       <!--  Select image to upload: <br> -->
        <input id="name" type="text" value="Name" name="name"><br>
        Select image to upload: <br>
        <input type="file" name="image"/><br>
        <input type="submit" name="submit" value="UPLOAD"/>
    	</form>
		</table>
	</div>

	<div align="center"></div>

</body>
</html>