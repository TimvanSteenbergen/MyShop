<?php

    // GET THE TOP X FROM ORDER_DATA AND STORE IN TOPX TABLE

    function topx_process() {
        $query = mysql_query("SELECT count(id) as `top_x`, product_id FROM order_data GROUP BY product_id HAVING `top_x` > 1");
    	while($row=mysql_fetch_array($query)) {
            $_array[] = array($row[0],$row[1]);
    	}
        foreach ($_array as $key => $row) {
            mysql_query("INSERT INTO topx SET top_x = {$row[0]}, product_id = {$row[1]}, process_date = UNIX_TIMESTAMP(NOW())");
        }
    }
    
    // QUERY TOPX TABLE ONLY

    function topx_display() {
        
        $_query = mysql_query("SELECT top_x, product_id FROM topx ORDER BY top_x DESC, process_date DESC LIMIT 3");
        while ($_row = mysql_fetch_array($_query)) {
            echo $_row[1]." | ";
        }
        
    }
    
    // PARSE FILE/ARRAY TO ENTER NEW DATA IN ORDER_DATA TABLE
    // FIELD ALSO_BOUGHT IS OMITTED
    
    function import_order_data($_array_dummy_data) {
        foreach ($_array_dummy_data as $key=>$row) {
            $order_id       = $row[0];
            $order_date     = strtotime($row[1]);
            $product_id     = $row[2];
            $quantity       = $row[3];
            $customer_email = $row[4];
            $shop_id        = $row[5];
            
            $_query_insert = "INSERT INTO `order_data` (`order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`)
            VALUES ('$order_id', '$order_date', '$product_id', '$quantity', '$customer_email', '$shop_id')";
            
            mysql_query($_query_insert);
        }
    }

    function getelementfromXMLstring($element, $XMLstring) {
        /* @param string $var the retrieved value
         * @param string $str element to retrieve out of $XMLstring
         * @param string $XMLstring contains the XMLdata
         */
        //Check the presence of the element in the string.
        if (!strpos($XMLstring, "<" . $element . ">")) {
            return '';
        };
        
        $my_startpos = strpos($XMLstring, "<" . $element . ">") + strlen($element) + 2;
        if ($my_startpos >= 1) {
            $my_length = strpos($XMLstring, "</" . $element . ">") - $my_startpos;
            return substr($XMLstring, $my_startpos, $my_length);
        }
        else {
            return '';
        };
    }
    
    function getparameterfromXMLstring($parametername, $XMLstring) {
        /* @param string $var the retrieved value
         * @param string $str element to retrieve out of $XMLstring
         * @param string $XMLstring contains the XMLdata
         */
        //Check the presence of the element in the string.
        if (!strpos($XMLstring, $parametername)) {
            return '';
        };
        
        if (strpos($XMLstring, $parametername) > 0) {
            $my_startpos = strpos($XMLstring, $parametername) + strlen($parametername) + 3;
            $my_length = strpos($XMLstring, "</", $my_startpos) - $my_startpos;
            return substr($XMLstring, $my_startpos, $my_length);
        }
        else {
            return 'getparameterfromXMLstring failed';
        };
    }