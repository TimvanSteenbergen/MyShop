<?php

	$_array_dummy_data = array(
		array('260300_03486','20141021','3031','1','loomanrenee@gmail.com','260309'),
		array('260300_03486','20141021','3032','1','loomanrenee@gmail.com','260309'),
		array('260300_03486','20141021','3615','1','loomanrenee@gmail.com','260309'),
		array('260300_03485','20141020','3011','1','s.f.stoffels@online.nl','260303'),
		array('260300_03484','20141020','3051','1','alzirenebarbosa@hotmail.com','260318'),
		array('260300_03483','20141022','3024','1','overloon@thomashuis.nl','260315'),
		array('260300_03483','20141022','3032','1','overloon@thomashuis.nl','260315'),
		array('260300_03482','20141023','3024','1','overloon@thomashuis.nl','260315'),
		array('260300_03482','20141023','3032','1','overloon@thomashuis.nl','260315'),
		array('260300_03481','20141020','3619','1','info@rimpelconsult.nl','260315'),
		array('260300_03481','20141020','3676','1','info@rimpelconsult.nl','260315'),
		array('260300_03481','20141020','3606','1','info@rimpelconsult.nl','260315'),
		array('260300_03481','20141020','3024','1','info@rimpelconsult.nl','260315'),
		array('260300_03480','20141020','3607','1','ine.berkelmans@gmail.com','260302')
	);
	
	
	mysql_connect("localhost","root","root") or die(mysql_error());
	mysql_selectdb("my_addon_topx") or die(mysql_error());
	
	
	foreach ($_array_dummy_data as $key=>$row) {
		
		$order_id       = $row[0];
		//$order_date     = date('Y-m-d', strtotime($row[1]));
		$order_date     = strtotime($row[1]);
		$product_id     = $row[2];
		$quantity       = $row[3];
		$customer_email = $row[4];
		$shop_id        = $row[5];
		
		/*
		$_query_insert = "INSERT INTO `topx` (`order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`)
		VALUES ('$order_id', '".strtotime($order_date)."', '$product_id', '$quantity', '$customer_email', '$shop_id')";
		*/
		
		$_query_insert = "INSERT INTO `order_data` (`order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`)
		VALUES ('$order_id', '$order_date', '$product_id', '$quantity', '$customer_email', '$shop_id')";
		
		echo $_query_insert."<br />";
		
		
		mysql_query($_query_insert);
		
	}
	
	$query = mysql_query("SELECT count(id) as `top_x`, product_id FROM order_data GROUP BY product_id HAVING `top_x` > 1");
	while($row=mysql_fetch_array($query)) {
        $_array[] = array($row[0],$row[1]);
	}
    
    foreach ($_array as $key => $row) {
		echo "INSERT INTO topx SET top_x = {$row[0]}, product_id = {$row[1]}, process_date = UNIX_TIMESTAMP(NOW())<br />";
        mysql_query("INSERT INTO topx SET top_x = {$row[0]}, product_id = {$row[1]}, process_date = UNIX_TIMESTAMP(NOW())");
    }
	
	
	
	// display Top X
	
	$_query = mysql_query("SELECT top_x, product_id FROM topx ORDER BY top_x DESC, process_date DESC LIMIT 3");
    while ($_row = mysql_fetch_array($_query)) {
        echo $_row[1]." | ";
    }
	
	
	
	
	