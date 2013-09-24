<?php 

/**
* THis is a wrapper class of Vindowshop.
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

	//This token will issued from vindowshop server while authorising the api
	protected $app_token = null;

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
		if(!$array['error']){
			$this->app_token = $array['token'];
		}
		else{
			throw new Exception('Exception : There is some error authorizing the application.');
		}
	}

	/**
		* This method helps to get the authorization information
		* @return array of appId and appToken
	*/
	protected function getAuthInfo(){
		return array('appId'=>$this->app_id, 'appToken'=>$this->app_token);
	}

	/**
		* Extracting and Sending image for processing from a post
		* @param string $string The post where the images will be extracted from
	*/
	public function sendImages($string){
		$images = $this->getImagesUrls($string);
		$data = array('from_wrapper',$images);
		$response = $this->apiRequest('',$data);
		die(var_dump($response));
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
		$data[] = $this->getAuthInfo();
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

$instance = new Vindowshop('123456788','987654321');
$instance->apiAuth();
$instance->sendImages('<a href="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/ws-space-apple-logo1.jpg"><img class="alignnone size-medium wp-image-15" alt="ws-space-apple-logo1" src="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/ws-space-apple-logo1-300x187.jpg" width="300" height="187" /></a>

<a href="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/yii_wallpaper_dark.jpg"><img class="alignnone size-medium wp-image-13" alt="yii_wallpaper_dark" src="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/yii_wallpaper_dark-300x240.jpg" width="300" height="240" /></a>

<a href="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/code-EAT-SLEEP-800x10001.jpg"><img class="alignnone size-medium wp-image-10" alt="code EAT SLEEP-800x1000" src="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/code-EAT-SLEEP-800x10001-240x300.jpg" width="240" height="300" /></a>

<a href="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/coding_alamy_2365972b.jpg"><img class="alignnone size-medium wp-image-7" alt="B93X8G / Luminous Keyboard" src="http://www.vindowshop.com/wordpress/wp-content/uploads/2013/09/coding_alamy_2365972b-300x194.jpg" width="300" height="194" /></a>

&nbsp;

&nbsp;');


?>