<?php

	define ('HMAC_SHA256', 'sha256');
	//define ('SECRET_KEY', 'd2df13a8f75d430398a3b97a87372c5f280df7c2d56947df9200b3cbf4647229ba3a5f34e4f0414aaa8c422f86fce6e86ad0e0ae6c704da2bb3d94e1141a86a39723b92396e6446385bfae3a33f082bf61d5bfe2595e40a2a12651ae47b31c1abd362341716d48ee831d40cabb679e08f4fc78ee1bac445c91a6f9aa97bf62c6');//TESTING

	define('SECRET_KEY', '77c2c4d4db3842639ba1891a7faed6fbda77df6e8c3346e28299c88ce416f17042c2d54715ee407ca1af58a43b2b0b6d47d820fe683a4970b5af2884e0cb5eb712c06e3afdc0447ca567f00667e17c2c03c540a53dcd41a6bda7123765c3d70cbc7e2fbe1cf349b9981af4f179fa4200c24dccd1e1fd4e33b0d5abde37322223');//PRODUCCION

	function sign ($params) {
	  return signData(buildDataToSign($params), SECRET_KEY);
	}

	function signData($data, $secretKey) {
	    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
	}

	function buildDataToSign($params) {
	        $signedFieldNames = explode(",",$params["signed_field_names"]);
	        foreach ($signedFieldNames as $field) {
	           $dataToSign[] = $field . "=" . $params[$field];
	        }
	        return commaSeparate($dataToSign);
	}

	function commaSeparate ($dataToSign) {
	    return implode(",",$dataToSign);
	}
