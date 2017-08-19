<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- refresh script setiap 10 detik -->
<meta http-equiv="refresh" content="10; url=<?php $_SERVER['PHP_SELF']; ?>">
<title>AutoReply</title>
</head>

<body>
<?php

/*Menampilkan produk prestashop*/
$doc = new DOMDocument();
$doc->load('http://XNTER7SXUS6W0J8W8JPWZLOMON9BS0S6:@localhost/prestashop/api/products/?display=[id,name,price]');
$arrFeeds = array();
foreach ($doc->getElementsByTagName('products') as $node) {
	$itemRSS = array ( 
		'id_1' => $node->getElementsByTagName('id')->item(0)->nodeValue,
		'name_1' => $node->getElementsByTagName('name')->item(0)->nodeValue,
		'price_1' => $node->getElementsByTagName('price')->item(0)->nodeValue,
		'id_2' => $node->getElementsByTagName('id')->item(1)->nodeValue,
		'name_2' => $node->getElementsByTagName('name')->item(1)->nodeValue,
		'price_2' => $node->getElementsByTagName('price')->item(1)->nodeValue,
		'id_3' => $node->getElementsByTagName('id')->item(5)->nodeValue,
		'name_3' => $node->getElementsByTagName('name')->item(5)->nodeValue,
		'price_3' => $node->getElementsByTagName('price')->item(5)->nodeValue,
		'id_4' => $node->getElementsByTagName('id')->item(6)->nodeValue,
		'name_4' => $node->getElementsByTagName('name')->item(6)->nodeValue,
		'price_4' => $node->getElementsByTagName('price')->item(6)->nodeValue,
		'id_5' => $node->getElementsByTagName('id')->item(2)->nodeValue,
		'name_5' => $node->getElementsByTagName('name')->item(2)->nodeValue,
		'price_5' => $node->getElementsByTagName('price')->item(2)->nodeValue,
		'id_6' => $node->getElementsByTagName('id')->item(3)->nodeValue,
		'name_6' => $node->getElementsByTagName('name')->item(3)->nodeValue,
		'price_6' => $node->getElementsByTagName('price')->item(3)->nodeValue,
		'id_7' => $node->getElementsByTagName('id')->item(4)->nodeValue,
		'name_7' => $node->getElementsByTagName('name')->item(4)->nodeValue,
		'price_7' => $node->getElementsByTagName('price')->item(4)->nodeValue,
		);
		array_push($arrFeeds, $itemRSS);
}
/*----------------------------------------------------------------------------------*/
			
mysql_connect("localhost","root","");

mysql_select_db("sms");

$query = "SELECT * FROM inbox WHERE Processed = 'false'";

$hasil = mysql_query($query);

//Menampilkan id, nama produk dan harga
$p1 = $itemRSS['id_1'] . " Nama : " . $itemRSS['name_1'] . " $ " . $itemRSS['price_1'];
$p2 = $itemRSS['id_2'] . " Nama : " . $itemRSS['name_2'] . " $ " . $itemRSS['price_2'];
$p3 = $itemRSS['id_3'] . " Nama : " . $itemRSS['name_3'] . " $ " . $itemRSS['price_3'];
$p4 = $itemRSS['id_4'] . " Nama : " . $itemRSS['name_4'] . " $ " . $itemRSS['price_4'];
$p5 = $itemRSS['id_5'] . " Nama : " . $itemRSS['name_5'] . " $ " . $itemRSS['price_5'];
$p6 = $itemRSS['id_6'] . " Nama : " . $itemRSS['name_6'] . " $ " . $itemRSS['price_6'];
$p7 = $itemRSS['id_7'] . " Nama : " . $itemRSS['name_7'] . " $ " . $itemRSS['price_7'];
//----------------------------//


while($data= mysql_fetch_array($hasil)){
	
	$id = $data['ID'];

    $noPengirim = $data['SenderNumber'];

    $msg = strtoupper($data['TextDecoded']);

    $pecah = explode(" ",$msg);
	
	$prestahop = $pecah[1]; 
	
	if($pecah[0]=="PRODUCTS")
	{
		if($pecah[1] != "")
		{
			if($pecah[1] == "PRESTASHOP")
			{	
				$judul = "Products di Prestashop";
				$p8 = "untuk memilih balas sms dengan kirim nomer id products";
	
				$isi = $judul . " " . $p1 . " " . $p2 . " " . $p3 . " " . $p4 . " " . $p5 . " " . $p6 . " " . $p7. " " . $p8;
				
				$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      
				exec('c:\xampp\htdocs\smsgw\gammu-smsd-inject.exe -c c:\xampp\htdocs\smsgw\smsdrc EMS '.$noPengirim.' -text "'.$isi.'"');
			}
			else
			{
				$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('".$noPengirim."', 'Format SMS Salah', '1')");

        	}
		}
		else
		{
			$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', 'Format SMS Salah', '1')");
		}
	}
	
	if($msg == "1"){
		$isi = $p1 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "2"){
		$isi = $p2 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "3"){
		$isi = $p3 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "4"){
		$isi = $p4 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "5"){
		$isi = $p5 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "6"){
		$isi = $p6 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	else if($msg == "7"){
		$isi = $p7 . "\nSilakan melakukan pembayaran ke rekening 00011111 dengan biaya tersebut";
		$query=mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('".$noPengirim."', '".$isi."')");      		
	}
	
	
	$query3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
    mysql_query($query3);
}

?> 
</body>
</html>