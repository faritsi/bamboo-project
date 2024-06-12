<?php
/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */
// require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';
// D:\Software\XAMPP\htdocs\bamboo\public\php\midtrans\midtrans-php\Midtrans.php
//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-9zcBME8uz3JAPNkLONOYiCEa';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $_POST['total'],
    ),
    'item_details' => array(
        array(
            'id' => rand(), // you might want to include an ID or name for each item
            'name' => $_POST['produk'], // uncomment and provide product name if needed
            'quantity' => $_POST['qty'],
            'price' => $_POST['harga'],
        )
    ),
    'customer_details' => array(
        'first_name' => $_POST['name'],
        'address' => $_POST['alamat'],
        'postal_code' => $_POST['pos'],
        'phone' => $_POST['nohp'],
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo $snapToken;
?>