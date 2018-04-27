<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz - Quiz List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include("header.php");
include("database.php");
echo "<h2 class=head1> Select Subject to Give Quiz </h2>";?>
<form action="sublist.php" method="POST">
<input type="text" name="search" placeholder="search subject here"/>
<input type="submit" value =">>"/>
</form>
<?php


if(isset($_POST['search'] ))
{
		$rs=mysql_query("select * from mst_subject");
		$searchq=$_POST['search'];
		$searchq=preg_replace("#[^0-9a-z]#i","",$searchq);
		$query=mysql_query("SELECT * FROM mst_subject where sub_name like '%$searchq%'") or die("could not search");
		$count=mysql_num_rows($query);
		if($count==0)
		{
			$output='there is no search result';
			$rs=mysql_query("select * from mst_subject");
echo "<table align=center>";
while($row=mysql_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=showtest.php?subid=$row[0]><font size=4>$row[1]</font></a>";
}
echo "</table>";
		}
		else
		{
			while($row=mysql_fetch_array($query))
			{
				echo "<tr><td align=center ><a href=showtest.php?subid=$row[0]><font size=4>$row[1]</font></a>";
			}
		}
}
print($output);

?>
</body>
</html>
