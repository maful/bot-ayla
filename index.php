<?php 

require_once 'vendor/autoload.php';

try {
	$bot = new \TelegramBot\Api\Client('457882176:AAG-5Bt5hxITkuMQ2VX-B-2p7waL47QJ414');

	$bot->command('ping', function ($message) use ($bot) {
		if (check_user($message->getChat()->getUsername()) == TRUE) {
			$bot->sendMessage($message->getChat()->getId(), 'PING OK!');
			// $bot->sendMessage($message->getChat()->getId(), 'Username : ' . $message->getChat()->getUsername());
		} else {
			$bot->sendMessage($message->getChat()->getId(), 'Maaf Anda tidak memiliki akses untuk bot ini!');
		}
	});

	$bot->command('lampon', function ($message) use ($bot) {
		if (check_user($message->getChat()->getUsername()) == TRUE) {
			$bot->sendMessage($message->getChat()->getId(), 'Tunggu...');
			if (file_get_contents('https://api.ajikamaludin.id/apiv2/device/58/1/1') == 200) {
				$bot->sendMessage($message->getChat()->getId(), 'Lampu Nyala');
				$bot->sendMessage($message->getChat()->getId(), 'Watt : ' . file_get_contents('https://api.ajikamaludin.id/apiv2/watt/58/1'));
			} else {
				$bot->sendMessage($message->getChat()->getId(), 'Error request');
			}
		} else {
			$bot->sendMessage($message->getChat()->getId(), 'Maaf Anda tidak memiliki akses untuk bot ini!');
		}
	});

	$bot->command('lampoff', function ($message) use ($bot) {
		if (check_user($message->getChat()->getUsername()) == TRUE) {
			$bot->sendMessage($message->getChat()->getId(), 'Tunggu...');
			if (file_get_contents('https://api.ajikamaludin.id/apiv2/device/58/1/0') == 200) {
				$bot->sendMessage($message->getChat()->getId(), 'Lampu Mati');
			} else {
				$bot->sendMessage($message->getChat()->getId(), 'Error request');
			}
		} else {
			$bot->sendMessage($message->getChat()->getId(), 'Maaf Anda tidak memiliki akses untuk bot ini!');
		}
	});

	$bot->command('status', function ($message) use ($bot) {
		if (check_user($message->getChat()->getUsername()) == TRUE) {
			$bot->sendMessage($message->getChat()->getId(), 'Tunggu...');
			if (file_get_contents('https://api.ajikamaludin.id/apiv2/status/58/1') == 0) {
				$bot->sendMessage($message->getChat()->getId(), 'Lampu Mati');
			} else {
				$bot->sendMessage($message->getChat()->getId(), 'Lampu Nyala');
			}
		} else {
			$bot->sendMessage($message->getChat()->getId(), 'Maaf Anda tidak memiliki akses untuk bot ini!');
		}
	});

	$bot->run();

} catch (\TelegramBot\Api\Exception $e) {
	$e->getMessage();
}

function check_user($username = NULL) {
	$list = array("mafulprayoga", "ajikamaludin", "Evriyana", "tomble");
	if (in_array($username, $list, TRUE)) {
    	return TRUE;
	} else {
		return FALSE;
	}
}

?>