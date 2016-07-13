<?php 

require_once("config.php");

/* 
 * Get all enabled gift cards.
 */
function getGiftCards(){
	$url = 'https://'.SHOPIFY_API_KEY.':'.SHOPIFY_PASSWORD.'@'.SHOPIFY_DOMAIN.'/admin/gift_cards.json?status=enabled';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPGET, 1); 
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	if(ereg("^(https)",$url)){
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	}
	$curl_response = curl_exec($curl);
	curl_close($curl);

	$response = json_decode($curl_response);
	return $response;
}

/* 
 * Add a new gift card to Shopify.
 *
 * $postdata = array(
 *			"gift_card" => array(
 *				"note" => "Imported from MM",
 *				"initial_value" => "10.00",
 *				"code" => "ABCD1234THISISATEST"
 *			));
 */
function createGiftCard($postdata){
	$url = 'https://'.SHOPIFY_API_KEY.':'.SHOPIFY_PASSWORD.'@'.SHOPIFY_DOMAIN.'/admin/gift_cards.json';
	$curl_post_data = json_encode($postdata);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json'
		)
	);
	if(ereg("^(https)",$url)){
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	}
	$curl_response = curl_exec($curl);
	curl_close($curl);

	$response = json_decode($curl_response);
	return $response;
}

/* 
 * Helper function to translate uploaded CSV to array for easy processing.
 */
function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

