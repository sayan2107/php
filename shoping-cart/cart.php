<?php
	session_start();
	include('connect.php');

	/*display products*/
	function display_product(){
		global $dbc;
		$q = mysql_query("SELECT `id`, `image`, `name`, `desc`, `price` FROM kart WHERE `quantity` > 0 ");
		$num = mysql_num_rows($q);
		while($fetch = mysql_fetch_assoc($q)){
			echo '<img src="images/'.$fetch['image'].'" width="120" height="120"/> <br /><span id="name">'.$fetch['name']. '</span><br />'.$fetch['desc'].'<br />$'.$fetch['price'].' <a href="cart.php?add='.$fetch['id'].'">Add to Cart</a><br /><br />';
		}
	}

	if(isset($_GET['add']) && !empty($_GET['add'])){
		$id = $_GET['add'];
		$q = mysql_query("SELECT `id`, `quantity` FROM kart WHERE `id`='".$id."'  ");
		$num = mysql_num_rows($q);
		while($quantity = mysql_fetch_assoc($q)){
			if($quantity['quantity'] != @$_SESSION['cart_'.$id]){
		        echo @$_SESSION['cart_'.$id]++;
			}
			header('Location:index.php');
		}
	}

	if(isset($_GET['remove'])){
		$_SESSION['cart_'.$_GET['remove']]--;
		header('Location:index.php');
	}

	if(isset($_GET['delete'])){
		$_SESSION['cart_'.$_GET['delete']]= 0;
		header('Location:index.php');
	}

	/*display paypal button*/
	function paypal_item(){
		$num = 0;
  foreach($_SESSION as $name => $value){

		if($value !=0){
		if(substr($name,0,5) == 'cart_'){
			 $id = substr($name,5, strlen($name)-5);
			 $get = mysql_query('SELECT id,name, price , shipping FROM kart WHERE id = '.$id.'');
			 while($get_row = mysql_fetch_assoc($get)){
		$num++;
		echo '<input type ="hidden" name="item_number_'.$num.'" value="'.$id.'">';
		echo '<input type ="hidden" name="item_name_'.$num.'" value="'.$get_row['name'].'">';
		echo '<input type ="hidden" name="amount_'.$num.'" value="'.$get_row['price'].'">';
		echo '<input type ="hidden" name="shipping_'.$num.'" value="'.$get_row['shipping'].'">';
		echo '<input type ="hidden" name="shipping2_'.$num.'" value="'.$get_row['shipping'].'">';
		echo '<input type ="hidden" name="quantity_'.$num.'" value="'.$value.'">';
	 }}
}
}
}

	/*display cart*/
	function product(){
	$net_payment =0;
		foreach($_SESSION as $name => $value){
			if($value > 0){
				if(substr($name,0,5) == 'cart_'){
					$id = substr($name,5,(strlen($name)-5));
					$q = mysql_query("SELECT `id`, `shipping`, `name`, `price` FROM kart WHERE `id` = '".$id."' ");
					$num = mysql_num_rows($q);
					while($get = mysql_fetch_assoc($q)){
					$total = $value*$get['price'];
						echo $get['name'].' X '.$value.' @ '.$get['price'].' = $' .$total.'  <a href="cart.php?add='.$id.'">[ + ]</a><a href="cart.php?remove='.$id.'">[ - ]</a><a href="cart.php?delete='.$id.'"> Delete</a><br/><br/>';
					}
    }
				$net_payment+=$total;
   }
		}
		if($net_payment == 0){
		echo "<h5>Your cart is empty</h5>";
		}else{
			echo "Total = $".$net_payment.'<br /><br />';
			?>

			<span style="text-align:center;">
				<form action= "https://www.paypal.com/cgi-bin/webscr" method ="post">
					<input type ="hidden" name="cmd" value="_cart">
					<input type ="hidden" name="upload" value="1">
					<input type ="hidden" name="business" value="theprogrammingvids@gmail.com">
					<?php paypal_item();?>
					<input type ="hidden" name="item_name" value="Item_Name">
					<input type ="hidden" name="currency_code" value="USD">
					<input type ="hidden" name="amount" value="<?php echo $net_payment;?>">
					<input type ="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with Paypal">
				</form>
			</span>

			<?php
		}


	}



?>