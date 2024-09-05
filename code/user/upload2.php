<?php
session_start();
include '../connector.php';
// new filename
$filename = 'pic_'.date('YmdHis') . '.jpeg';

$url = '';
/*require('vendor/cloudmersive/cloudmersive_imagerecognition_api_client/vendor/autoload.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', '688370a7-d795-4c24-9921-9a14fbbcf03f');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Apikey', 'Bearer');

$apiInstance = new Swagger\Client\Api\FaceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$input_image = "6.jpg"; // \SplFileObject | Image file to perform the operation on; this image can contain one or more faces which will be matched against face provided in the second image.  Common file formats such as PNG, JPEG are supported.
$match_face = "5.jpg"; // \SplFileObject | Image of a single face to compare and match against.
//echo '<table>
  //  <tr>
  //      <td><img src="'.$input_image.'" ></td>
        <td><img src="'.$match_face.'" ></td>
  //  </tr>
//</table>';

try {
    $result = $apiInstance->faceCompare($current_pic, $filename);
    print_r($result);
    echo "<br>";
    $result2 = $apiInstance->faceLocate($input_image);
    print_r($result2);
} catch (Exception $e) {
    echo 'Exception when calling FaceApi->faceCompare: ', $e->getMessage(), PHP_EOL;
}
$apiInstance = new Swagger\Client\Api\FaceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);*/
if( move_uploaded_file($_FILES['webcam']['tmp_name'],'../upload/'.$filename) ){
     $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
       $_SESSION['new_pic']='upload/'.$filename;  
    
	
}

// Return image url
echo $url;
?>