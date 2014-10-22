<?php


    function topx_get() {
        
        // actions here
        
    }
    
    function topx_display() {
        
        
    }
    
    function import_data_from_file($_array_dummy_data) {
        foreach ($_array_dummy_data as $key=>$row) {
            $order_id       = $row[0];
            $order_date     = strtotime($row[1]);
            $product_id     = $row[2];
            $quantity       = $row[3];
            $customer_email = $row[4];
            $shop_id        = $row[5];
            
            $_query_insert = "INSERT INTO `topx` (`order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`)
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