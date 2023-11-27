<?php 
require('../../../../wp-load.php');
	$postid = $_GET['postID'];

	// post: 89: /wp-ufree/lua-chon-ufree/
    $b_items = get_field( 'selection_items_step3',89);
	$product_type = $b_items[$postid];
	// var_dump($b_items[$id]);

	// $rs = "";

	// $rs->text = $product_type["text"];
	// $rs->desc = $product_type["desc"];
	// $rs->price = $product_type["price"];
	// $rs->img = $product_type["img"]["sizes"]["large"];


    // $rs = {
    // 	"text": $product_type["text"],
    // 	"desc": $product_type["desc"],
    // 	"price": $product_type["price"],
    // 	"img": $product_type["img"]["sizes"]["large"]

    // }

	//echo json_encode($b_items[$id]);

    echo json_encode(array('text' => $product_type["text"], "desc" => $product_type["desc"], "price" => $product_type["price"], "img"=> $product_type["img"]["sizes"]["large"]));

	return;
?>

