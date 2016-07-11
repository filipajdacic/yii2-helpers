<?php

namespace filipajdacic\yii2helpers;

use yii\base\Component;
use \Exception;


/**
 * Helper
 * --------------------------------------------
 * @package Helpers
 * @version 1.0
 * @author Filip Ajdacic <ajdasoft@gmail.com>
 * @license MIT
 * */


class Helper extends Component {
 
   /**
     * validateEmail()
     * This function validates a given email address
     * @param  string $email Email address for validate
     * @return boolean          Return true when email is valid and return false when email is invalid
     */
	    
	    public function validateEmail($email) {
	        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	            return true;
	        }
	        return false;
	    }

	/**
	 * encode_email()
	 * With this method, you can encode any email address into HTML entities so that spam bots do not find it.
	 * @param string $email Email address to encode
	 * @param string $linkText Text Link that will be displayed
	 * @param string $class CSS class for the link
	 * @return mixed
	 * */

	 public function encode_email($email='info@domain.com', $linkText='Contact Us', $attrs ='class="emailencoder"' ) {  
			    
		$email = str_replace('@', '&#64;', $email);  
		$email = str_replace('.', '&#46;', $email);  
		$email = str_split($email, 5);  
			  
		$linkText = str_replace('@', '&#64;', $linkText);  
		$linkText = str_replace('.', '&#46;', $linkText);  
		$linkText = str_split($linkText, 5);  
			      
		$part1 = '<a href="ma';  
		$part2 = 'ilto&#58;';  
		$part3 = '" '. $attrs .' >';  
		$part4 = '</a>';  
			  
		$encoded = '<script type="text/javascript">';  
		$encoded .= "document.write('$part1');";  
		$encoded .= "document.write('$part2');";  
		foreach($email as $e)  {  $encoded .= "document.write('$e');";  }  
		$encoded .= "document.write('$part3');";  
		foreach($linkText as $l){ $encoded .= "document.write('$l');";  }  
		$encoded .= "document.write('$part4');";  
		$encoded .= '</script>';  
			  
		return $encoded;  
		
	}  


	/**
	 * highlight_text()
	 * It becomes convenient for user, when he searches something and in the result he can see his keyword highlighted.
	 * @param string $text The text where we will search for the words to highlight
	 * @param string $words Words to be highlighted in a text
	 * @param string $color The color of the highlighted text
	 * @return string;
	 * */

		public function highlight_text($text, $words, $color = '#4285F4') {
		    $split_words = explode( " " , $words );
		    foreach($split_words as $word)
		    {
		       
		        $text = preg_replace("|($word)|Ui" ,
		            "<span style=\"color:".$color.";\"><b>$1</b></span>" , $text );
		    }
		    return $text;
		}

    /**
     * truncateText()
     * You can truncate text and specify number of characters you want to show
     * @param  string $text   Input the text that you want to cut
     * @param  int    $number Number of characters you want to show
     * @param  string $suffix What do you want to show at the end
     * @return mixed          Return truncated text with suffix
     */
	    
	    public function truncateText($text, $number, $suffix = ' read more...') {
	        if (!empty($text) && intval($number)) {
	            return substr($text, 0, $number) . $suffix;
	        }
	        return false;
	    }

    /**
     * cleanText()
     * This function clean any text by removing unwanted tags
     * @param  string $string Text for removing unwanted tags
     * @return mixed          Return cleaned text
     */
	    public function cleanText($string) {
	        if (!empty($string)) {
	            $string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
	            $string = htmlspecialchars(strip_tags($string, $this->_allowableTags));
	            $string = str_replace('href=', 'rel="nofollow" href=', $string);
	            return $string;
	        }
	        return false;
	    }

    /**
     * encryptString()
     * Create an encrypted string with a special algorithm and key
     * @param  string $algorithm   The algorithm to use
     * @param  string $string The string to encrypt
     * @param  string $key    A salt to apply to the encryption
     * @return string         Return encrypted key
     */
	    
	    public function encryptString($algorithm, $string, $key = null) {     
	        if (!empty($algorithm) && !empty($string)) {   
	            if ($key == null) {
	                $ctx = hash_init($algorithm);
	            } else {
	                $ctx = hash_init($algorithm, HASH_HMAC, $key);
	                hash_update($ctx, $string);
	            }
	            return hash_final($ctx);
	        }
	        return false;
	    }



    /**
     * generateSlug()
     * This function is useful if you would like to generate clean a URL
     * @param  string $string The text that you want to convert
     * @return mixed          Return slug-clean-url
     */
	    
	    public function generateSlug($string) {
	        if (!empty($string)) {
	            return strtolower(
	                preg_replace(
	                    array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
	                    array('', '-', ''), $string)
	                );
	        }

	        return false;
	    }


	/**
	 * getTinyurl()
	 * URL SHORTENER using tinyurl which returns a tinyurl short url for provided long url
	 * @param string $url;
	 * @return string
	 * */

		public function getTinyurl($url) {
			$ch = curl_init();  
			$timeout = 5;  
				curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
				curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
			
			$data = curl_exec($ch);  
			curl_close($ch);  
			
			return $data;  
		}

	/**
	 * base64url_encode()
	 * Encodes a URL string to a Base64 URL.
	 * @param string $plainText;
	 * @return string
	 * */

		public function base64url_encode($plainText) {
			$base64 = base64_encode($plainText);
			$base64url = strtr($base64, '+/=', '-_,');
			return $base64url;
		}

	/**
	 * base64url_decode()
	 * Decodes a Base64 URL to plain text.
	 * @param string $plainText
	 * @return string
	 * */

		public function base64url_decode($plainText) {
			$base64url = strtr($plainText, '-_,', '+/=');
			$base64 = base64_decode($base64url);
			return $base64;
		} 

    /**
     * timeAgo()
     * This function convert a date and time string into xx time ago
     * Give the data and time string in this format: yyyy-mm-dd hh:ii:ss and it will return you the time ago
     * @param  string  $datetime Date and time string
     * @param  boolean $full     true for full time ago e.g: 6 months, 1 week, 23 hours, 51 minutes, 21 seconds ago
     *                           false for only first time e.g: 6 months ago
     * @return mixed             Return converted date and time in xx time ago format
     */
	    
	    public function timeAgo($datetime, $full = false) {
	        if (!empty($datetime)) {
	            $now  = new DateTime;
	            $ago  = new DateTime($datetime);
	            $diff = $now->diff($ago);
	            $diff->w = floor($diff->d / 7);
	            $diff->d -= $diff->w * 7;
	            $string = array(
	                'y' => 'year',
	                'm' => 'month',
	                'w' => 'week',
	                'd' => 'day',
	                'h' => 'hour',
	                'i' => 'minute',
	                's' => 'second',
	            );
	            foreach ($string as $k => &$v) {
	                if ($diff->$k) {
	                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	                } else {
	                    unset($string[$k]);
	                }
	            }
	            if (!$full) $string = array_slice($string, 0, 1);
	            return $string ? implode(', ', $string) . ' ago' : 'just now';
	        }
	        return false;
	    }

    /**
     * showYoutube()
     * This function replaces all youtube link into videos
     * @param  string  $url    The url to the video
     * @param  integer $width  The width of the player in pixels
     * @param  integer $height The height of the player in pixels
     * @param  string  $theme  Color of the player "dark" or "light"
     * @return mixed           Return youtube video player
     */

	    public function showYoutube($url, $width = 400, $height = 250, $theme = 'dark') {
	        if (!empty($url) && intval($width) && intval($height) && !empty($theme)) {
	            preg_match('/(?<=v(\=|\/))([-a-zA-Z0-9_]+)|(?<=youtu\.be\/)([-a-zA-Z0-9_]+)/', $url, $v);
	            return "<iframe src=\"http://www.youtube.com/embed/{$v[0]}?theme={$theme}&amp;iv_load_policy=3&amp;wmode=transparent\"
	                    allowfullscreen=\"\" frameborder=\"0\" width=\"{$width}\" height=\"{$height}\" ></iframe>
	            ";
	        }
	        return false;
	    }

    /**
     * showVimeo()
     * This function replaces all vimeo link into videos
     * @param  string  $url    The url to the video
     * @param  integer $width  The width of the player in pixels
     * @param  integer $height The height of the player in pixels
     * @return mixed           Return vimeo video player
     */
	    
	    public function showVimeo($url, $width = 400, $height = 250) {
	        if (!empty($url) && intval($width) && intval($height)) {
	            preg_match('(\d+)', $url, $id);
	            return "<iframe src=\"http://player.vimeo.com/video/$id[0]?title=0&amp;byline=0&amp;portrait=0\"
	                    webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\" frameborder=\"0\"
	                    width=\"{$width}\" height=\"{$height}\"></iframe>
	            ";
	        }
	        return false;
	    }

    /**
     * showGravatar()
     * Get either a Gravatar URL or complete image tag for a specified email address.
     * @param  string $email The email address
     * @param  string $s     Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param  string $d     Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param  string $r     Maximum rating (inclusive) [ g | pg | r | x ]
     * @param  bool   $img   True to return a complete IMG tag False for just the URL
     * @param  array  $atts  Optional, additional key/value attributes to include in the IMG tag
     * @return string        Containing either just a URL or a complete image tag
     * @source               http://gravatar.com/site/implement/images/php/
     */
	    public function showGravatar($email, $s = 100, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
	        if (!empty($email)) {
	            $url = 'http://www.gravatar.com/avatar/';
	            $url .= md5(strtolower(trim($email)));
	            $url .= "?s={$s}&d={$d}&r={$r}";
	            if ($img) {
	                $url = "<img src=\"{$url}\"";
	                foreach ($atts as $key => $val)
	                $url .= " {$key}=\"{$val}\"";
	                $url .= " />";
	            }
	            return $url;
	        }
	        return false;
	    }

    /**
     * getExtension()
     * Get filename last extension
     * @param  string $file File name
     * @return mixed        Return last file name extension
     */
	    public function getExtension($file) {
	        if (!empty($file)) {
	            return substr(strrchr($file, '.'), 1);
	        }
	        return false;
	    }


    /**
     * showIP()
     * This function get real ip address
     * @return int return ip
     */
	    public function showIP()  {
	        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
	                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
	                return trim($addr[0]);
	            } else {
	                return $_SERVER['HTTP_X_FORWARDED_FOR'];
	            }
	        } else {
	            return $_SERVER['REMOTE_ADDR'];
	        }
	    }

	/**
	 * qr_code();
	 * This method can be used to crate a simple QR code image.
	 * @param string $data
	 * @param string $type
	 * @param int $size
	 * @param string $ec
	 * @param int $margin
	 * @see $this->qr_code("http://google.rs", "URL");
	 * @return string;
	 * */

		public function qr_code($data, $type = "TXT", $size ='150', $ec='L', $margin='0') {
		     $types = array("URL" =--> "http://", "TEL" => "TEL:", "TXT"=>"", "EMAIL" => "MAILTO:");
		    if(!in_array($type,array("URL", "TEL", "TXT", "EMAIL")))
		    {
		        $type = "TXT";
		    }
		    if (!preg_match('/^'.$types[$type].'/', $data))
		    {
		        $data = str_replace("\\", "", $types[$type]).$data;
		    }
		    $ch = curl_init();
		    $data = urlencode($data);
		    curl_setopt($ch, CURLOPT_URL, 'http://chart.apis.google.com/chart');
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'chs='.$size.'x'.$size.'&cht=qr&chld='.$ec.'|'.$margin.'&chl='.$data);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_HEADER, false);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		    $response = curl_exec($ch);

		    curl_close($ch);
		    return $response;
		}


	/**
	 * getDistanceBetweenCordinates()
	 * This method can be used to calculate distance between two coordinates.
	 * @param int $latitude1 
	 * @param int $longitude1
	 * @param int $latitude2
	 * @param int $longitude2
	 * 
	 * Usage:
	 * -------------
	 * $distance = $this->getDistanceBetweenCoordinates($latitude1, $longitude1, $latitude2, $longitude2);
	 * foreach ($distance as $unit => $value) {
     *    echo $unit.': '.number_format($value,4).'<br />';
	 * }
	 * -------------
	 * 
	 * @return array
	 * */

		public function  getDistanceBetweenCoordinates($latitude1, $longitude1, $latitude2, $longitude2) {
		    $theta = $longitude1 - $longitude2;
		    
		    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		    $miles = acos($miles);
		    $miles = rad2deg($miles);
		    $miles = $miles * 60 * 1.1515;
		    
		    $feet = $miles * 5280;
		    $yards = $feet / 3;
		    $kilometers = $miles * 1.609344;
		    $meters = $kilometers * 1000;
		   
		    return compact('miles','feet','yards','kilometers','meters'); 
		}

	/**
	 * pre_dump()
	 * This method is a simply pretty dump.
	 * @param $dump
	 * @return string
	 * */

	    public function pre_dump($dump) {
	    	echo '<pre>';
	    		var_dump($dump);
	    	echo '</pre>';
	    }

	


}
