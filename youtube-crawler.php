<?php

	if(isset($_POST['yt_Request'])) {
		
		header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
		
		$yt_Req = new ytcrawler;
		echo json_encode($yt_Req->new_video($_POST['yt_Request'], $_POST['count']));
		
	}

	class ytcrawler {
		
		static private $sUrl;
		static private $aLinks;
		static private $count;
		
		public function new_video($sUrl, $count) {
			
			self::$count = $count;
			self::$sUrl = self::control_url($sUrl);
			self::$aLinks = self::get_HTML_code();
			
			return self::$aLinks;
			
		}
		
		private static function control_url($sUrl){
			
			$aUrl = explode('/', $sUrl);
			
			switch($aUrl[count($aUrl) - 1]) {
				
				case '':
					$aUrl[count($aUrl) - 1] = 'videos';
				break;
				
				case 'videos':
				break;
				
				default:
					$aUrl[count($aUrl)] = 'videos';
				break;
				
			}
			
			return implode('/', $aUrl);
			
		}
		
		private static function get_HTML_code() {
			
			$file = file(self::$sUrl);
			$un_HTML = explode('<', implode(' ', $file));
			$aHTML = [];
			$bCh = 0;
			
			for($i = 0; $i != count($un_HTML); $i++) {
				
				if(strlen($un_HTML[$i]) > 87) {
					
					if(strcmp(substr($un_HTML[$i], 0, 87), 'a class="yt-uix-sessionlink yt-uix-tile-link spf-link yt-ui-ellipsis yt-ui-ellipsis-2') == -1) {
						
						$t = explode('"', $un_HTML[$i]);
						
						if(isset($t[1])) {
							
							if(strlen($t[1]) == 78) {
								
								if($bCh == self::$count)
									return $aHTML;
									
								$b = explode('"', $un_HTML[$i - 21]);
								
								for($co = 0; $co != count($b); $co++) {
									
									if(strcmp(substr($b[$co], 0, 5), 'https') == 0) {
										
										$aHTML[count($aHTML)] = [ 'link' => 'https://youtube.com' . $t[11], 'name' => substr($t[14], 1, strlen($t[14]) - 1), 'thumbnail' => $b[$co] ];
										$bCh++;
										
									}
									
								}
								
							}
						
						}
						
					}
				}
				
			}
		
			return $aHTML;
		
		}
		
	}

?>