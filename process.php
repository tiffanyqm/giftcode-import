<?php

include_once('functions.php');

/* 
 * Upload a file called giftcards.csv (formatted like giftcards_sample.csv) to the same directory as this script. 
 */
$data = csv_to_array('giftcards.csv');

if($data) {
	foreach($data as $row) {
		if($row['initial_value'] > 0 && $row['code']!="") {
			$postdata = array(
				"gift_card" => $row
				);
			print_r(createGiftCard($postdata));
		}
		echo "<br />***<br />";
		/* TODO: Make output pretty? */
	}
}




?>