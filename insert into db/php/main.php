<?php 
       include_once('db.php');
       $name = $_POST['name'];
       $age = $_POST['age'];
   

       if(mysql_query("INSERT INTO user VALUES('$name','$age')"))
       	     echo "successfully inserted";
       	else
       		 echo "insertion failed";
?>