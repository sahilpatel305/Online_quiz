<html>
<head>
	<title> add questions</title>
</head>
<body>
<?php include("../database.php");?>
<?php 
if(isset($_POST['uploadbtn']))
{
	$filename=$_FILES['myfile']['name'];
	$filetempname=$_FILES['myfile']['tmp_name'];
	$fileextension=pathinfo($filename,PATHINFO_EXTENSION);
	$allowedtype=array('csv');
	if(!in_array($fileextension,$allowedtype))
	{
		echo " invalid extension ";
	}
	else
	{
		$handel=fopen($filetempname,'r');
		while(($mydata=fgetcsv($handel,1000,',')) !==FALSE)
		{
			$test_id=$mydata[0];
			$que_desc=$mydata[1];
			$ans1=$mydata[2];
			$ans2=$mydata[3];
			$ans3=$mydata[4];
			$ans4=$mydata[5];
			$true_ans=$mydata[6];
			$marks=$mydata[7];
			$query="insert into mst_question(test_id,que_desc,ans1,ans2,ans3,ans4,true_ans,marks)
			values ('".$test_id."','".$que_desc."','".$ans1."','".$ans2."','".$ans3."','".$ans4."','".$true_ans."','".$marks."')";
			$run=mysql_query($query);
			
		}
		if(!$run)
		{
			die("error in uploading".mysql_error());
		}
		else
		{
			echo"file uploaded successfully";
		}
	}
}
?>
	<form action="" method="post" enctype="multipart/form-data" >
	<h3> upload your file </h3>
	<hr/>
		<input type="file" name="myfile" >
		<input type ="submit" name="uploadbtn" value="submit">
	</form>


</body>
</html>