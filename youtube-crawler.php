<?php

	class ytcrawler {
		
		static private $sUrl;
		static private $aLinks;
		
		public function new_video($sUrl) {
			
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
			
			for($i = 0; $i != count($links); $i++) {
				
				if(strcmp($links[$i], '/watch?v=') == 11)
					$aLinks[count($aLinks)] = 'youtube.com' . $links[$i];
					
			}
			
			return $aLinks;
			
		}
		
	}

?>