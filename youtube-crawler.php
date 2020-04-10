<?php

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
				
				if($bCh != 0) {
					
					$aHTML[count($aHTML)] = $un_HTML[$i];
					
				} elseif($un_HTML[$i] == '/div>') {
					
					$bCh = 1;
				}
			
			}
			
			$links = explode('"', implode(' ', $aHTML));
			$aLinks = [];
			$iCount = 0;
			$last = '';
			
			for($i = 0; $i != count($links); $i++) {
				
				if(strcmp($links[$i], '/watch?v=') == 11) {
					
					if($last != 'https://youtube.com' . $links[$i]) {
						
						if(strcmp($links[$i + 1], ' rel=') == 0) {
							
							$aLinks[count($aLinks)] = [ 'link' => 'https://youtube.com' . $links[$i], 'name' => substr($links[$i + 3], 1, -16) ];
							$last = 'youtube.com' . $links[$i];
							$iCount++;
							
						}
						
					}
					
				}
				
				if($iCount == self::$count)
					return $aLinks;
				
			}
			
			return $aLinks;
			
		}
		
	}

?>