<?php 
      include_once('db.php');
 
		$sql = "SELECT * FROM people";
		$res = mysql_query($sql);
		$result = array();
 
		while( $row = mysql_fetch_array($res) )
		    array_push($result, array('name' => $row[0],
			                          'age'  => $row[1],
						           'company' => $row[2],
						            'sex' => $row[3]));
 
		echo json_encode(array("result" => $result));
?>