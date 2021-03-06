<?php
require_once('Exchange.php');

class BittrexExchange extends Exchange {
	protected function _updateMarketList() {
		$result = array();
		$markets = json_decode(file_get_contents('https://bittrex.com/api/v1.1/public/getmarkets'));
		if(!is_array($markets->result)) return false;
		if(count($markets->result) == 0) return false;
		foreach($markets->result as $market) {
			if($market->IsActive) {
				$result[$market->MarketName] = 1;
			}
			else {
				$result[$market->MarketName.' (desactivé)'] = 1;
			}
		}
		$this->tLastUpdate = time();
		return $result;
	}

	public function getName() {
		return 'BITTREX';
	}
}

