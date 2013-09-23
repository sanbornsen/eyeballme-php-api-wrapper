<?php 

/**
* THis is an wrapper class of Vindowshop.
*/
class Vindowshop
{
	//define version
	const version = 0.01;

	//define author
	const author = 'sanborn';	

	//define Vindowshop api baseurl
	const API_URL = "http://vindowshop.com:9999/";


	//app_id and and api key provided by Vindowshop
	protected $app_id = null;
	protected $api_key = null;

    /**
    * Default constructor
    * @param string $appId for Vindowshop application
    * @param string $apiKey for vindowshop application
    */

	function __construct($appId, $apiKey){
		$this->setAppId($appId);
		$this->setApiKey($apiKey);
	}

	/**
		* Get the version of the API wrapper.
		* @return string Version of the API wrapper.
	*/
	public function getVersion(){
		return self::version;
	}

	/**
	* Initializing user app ID
	* @param string $appId for Vindowshop application
	*/

	private function setAppId($appId){
		$this->app_id = (string)$appId;
	}

	/**
	* Initializing user api Key
	* @param string $apiKey for Vindowshop application
	*/

	private function setApiKey($apiKey){
		$this->api_key = (string)$apiKey;
	}


	/**
		* Authenticate the application.
		* @return array PHP array of the JSON response.
	*/
	public function apiAuth(){
		$response = $this->apiRequest('auth/', $data = array('appId' => $this->app_id, 'apiKey' => $this->api_key));
		$array = json_decode($response, true);
		die(var_dump($response));
	}


	/**
	* Extracting and Sending image for processing from a post
	* @param string $string The post where the images will be extracted from
	*/
	public function sendImages($string){
		$images = $this->getImageUrls($string);

	}

	
	/**
	* Getting all image urls from the string
	* @param string $string The post where the image urls will be extracted from
	* @return array $matches will return the all the image urls containing in a string
	*/

	private function getImagesUrls($string){
		$imageTags = $this->getImageTags($string);
		$imageTags = implode(" ", $imageTags);
	    $regex = '/https?\:\/\/[^\" ]+/i';
    	preg_match_all($regex, $string, $matches);
    	return ($matches[0]);
	}

	
	/**
	* Getting all image tags in an array from the string
	* @param string $string The post where the image tagss will be extracted from
	* @return array $matches will give all the image tags in a string i.e. <img> tags 
	*/

	private function getImageTags($string){
		$regex = '/<img\s+.*?src=[\"\']?([^\"\' >]*)[\"\']?[^>]*>/i';
		preg_match_all($regex, $string, $matches);
		return ($matches[0]);
	}

	/**
		* Create the absolute path for the request.
		* @param string $url The base URL (Here it is used by API_URL)
		* @param string $path The relative path.
		* @return string $url.$path the entire path to send request
	*/
	private function buildPath($url, $path){
		return $url . $path;
	}



	/**
	* Send request via this method
	* @param string $path The path to send the request
	* @param array $data Data to send to the api
	* @return json $result Json the reply from the request
	*/

	private function apiRequest($path, array $data = null){
		$path = (string) $path;
		$data = (array) $data;

		$url = 	$this->buildPath(self::API_URL,$path);
		$params = json_encode($data);
		
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		curl_close($ch);

		return $result;
	}
	
}


// Testing

$instance = new Vindowshop('123456789','987654321');
$instance->apiAuth();


?>