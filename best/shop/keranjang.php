<?php
include('inc/config.php');
session_start();

//Tambah Barang//
if(isset($_GET['add'])){
	$id = $_GET['add'];
	$qt = mysql_query("SELECT id_brg, jml_brg FROM barang WHERE id_brg='$id'");
	while($qt_row = mysql_fetch_assoc($qt)){
		if($qt_row['jml_brg'] != $_SESSION['cart_'.$_GET['add']] && $qt_row['jml_brg'] > 0){
			$_SESSION['cart_'.$_GET['add']]+='1';
			header("Location: keranjang.php");
		} else {
			echo '<script language="javascript">alert("Stok produk tidak mencukupi!"); document.location="index.php";</script>';
		}
	}
}

//Hapus 1 Barang//
if(isset($_GET['remove'])){
	$_SESSION['cart_'.$_GET['remove']]--;
	header("Location: keranjang.php");
}

//Hapus Barang//
if(isset($_GET['delete'])){
	$_SESSION['cart_'.$_GET['delete']]='0';
	header("Location: keranjang.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Keranjang Belanja</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="themes/js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">				
							<li><a href="keranjang.php">Keranjang Belanja</a></li>			
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Beranda</a></li>															
							<li><a href="products.php">Produk</a>
								<ul>									
									<li><a href="products.php">Kaos</a></li>
								</ul>
							</li>							
							<li><a href="about.php">Tentang Kami</a></li>
							<li><a href="contact.php">Kontak</a></li>
						</ul>
					</nav>
				</div>
			</section>				
			<section class="header_text sub">
			<img class="pageBanner" src="gambar-slide/pagebanner.jpg" alt="New products" >
				<h4><span>Keranjang Belanja</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div class="span12">					
						<h4 class="title"><span class="text"><strong>Keranjang</strong> Belanja</span></h4>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Gambar</th>
									<th>Nama Barang</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total</th>
                                    <th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								
                                <?php 
								$i=1;
								foreach($_SESSION as $name => $value){
									if($value > 0)
									{
										if(substr($name, 0, 5) == 'cart_')
										{
											$id = substr($name, 5, (strlen($name)-5));
											$get = mysql_query("SELECT * FROM barang WHERE id_brg='$id'");
											while($get_row = mysql_fetch_assoc($get)){
												$sub = $get_row['harga_brg'] * $value;
												$idBarang = $get_row['id_brg'];
												echo '
												<tr>
												<td>'.$i.'</td>
												<td><img alt="" src="admin/'.$get_row['gambar_brg'].'" width="100" height="200" ></td>
												<td>'.$get_row['nama_brg'].'</td>
												<td>'.$value.'</td>
												<td>'.$get_row['harga_brg'].'</td>
												<td>'.$sub.'</td>
												<td>
													<a href="keranjang.php?remove='.$id.'"><i class="icon-minus"></i></a> | 
													<a href="keranjang.php?add='.$id.'"><i class="icon-plus"></i></a> | 
													<a href="keranjang.php?delete='.$id.'"><i class="icon-remove"></i></a>
												</td>
												<br>
												</tr>';
												$i++;
											}		
										}
										@$total += $sub;
									}
								}
								/*
								if(@$total == 0){
									echo 'Keranjang Belanja Kosong!';
									echo '<br>
											<a href="index.php">Kembali Belanja</a>
										  </br>
										  <br>';
								} else {
									echo '<a href="detail.php">&raquo; Detail &laquo;</a>';
									echo '<strong>Total Belanja</strong>: '.@$total.'<br>';
								}
								*/
								?>
											  		  
							</tbody>
						</table>
						
						<p class="cart-total right">
							<?php //echo '<strong>Total Belanja</strong>: '.@$total.'<br>'; ?>
						</p>
						<hr/>
						<p class="buttons center">	
                        <?php 
							if(@$total == 0){
									echo 'Keranjang Belanja Kosong!';
									echo '<br>
											<a href="index.php">Kembali Belanja</a>
											
										  </br>
										  <br>';
								} else {
									//echo '<div style="text-align:right; font-size:11px;"><a href="detail.php">&raquo; Detail &laquo;</a></div>';
									echo '<strong>Total Belanja</strong>: '.@$total.'<br>';
									echo '<a href="index.php" class="btn" type="button">Kembali Belanja</a> ';
									echo '<a href="checkout.php?total='.$total.'" class="btn btn-inverse" type="submit">Checkout</a>';
								}
						?>			
							<!--<a href="index.php" class="btn" type="button">Kembali Belanja</a>
							<a href="<?php echo 'checkout.php?total='.$total.''; ?>" class="btn btn-inverse" type="submit">Checkout</a>
						--></p>					
					</div>
					
				</div>
			</section>			
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="index.php">Beranda</a></li>  
							<li><a href="about.php">Tentang Kami</a></li>
							<li><a href="contact.php">Kontak</a></li>
							<li><a href="keranjang.php">Keranjang Belanja</a></li>							
						</ul>					
					</div>
                    <div class="span4"></div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<p>Toko online kami menjual beberapa kaos</p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>		
    </body>
</html>