<?php include('cart.php'); ?>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Shopping cart</title>
		<link rel="icon" type="image" href="images/cart.png" />
		<link rel="stylesheet" href="css/main.css" type = "text/css" />
	</head>
	<body style="background-image:url('images/Black-and-white-girls-pattern-[Converted].jpg')">
	<header id="heading">
	<!-- <img id ="logo" src="images/l.png" height="65" width="140"/> -->
	<h1><span id="color_me">My</span>shoping cart</h1></header><br />
		<div id="main_div">
			
			<br />
				<h3>shopping cart</h3><br />
			<div id="division">
			<section id="main_section">
				<?php display_product();?>
				<!-- <img src="images/i.jpeg" height ="150" width="100"/><br />
				<p>Moto X</p><p>Greatest Android mobile in amazing price.</p><p>$ 300 <a href="index.php">Add to Cart</a></p> -->
			</section>
			
			<aside id="side">
				<span class="your_cart">Your Cart</span>&nbsp;&nbsp;<img src="images/t.png"  height="45" width="45" /><br /><br />
				<?php product(); ?>
			</aside>
			</div>
		</div>
	</body>
</html>