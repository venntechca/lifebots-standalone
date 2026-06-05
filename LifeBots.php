<?php
class LifeBots
{
	public $NULL_KEY = "00000000-0000-0000-0000-000000000000";

	public function __construct() {}

	protected function request(string $action, array $data = [])
	{
	    $data['action'] = $action;
	    $data['apikey'] = ''; // API dev key
	    $data['botname'] = ''; // yourbot resident
	    $data['secret'] = ''; // secret access code
	    $data['dataType'] = 'json';

	    $lifeboturl = "https://api.lifebots.cloud/api/bot.html";

	    $ch = curl_init($lifeboturl);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$response = json_decode($result, true);
		if ($response['result'] == 'OK') {
		    return $response;
		}else{
		    return ['error' => $response['resulttext']];
		}
	    return ['error' => 'Unable to connect'];
	}

	public function name2key(string $name)
	{
	    $api = $this->request('name2key', ['name' => $name]);
	    if (array_key_exists('error', $api)) {
	        return $this->$NULL_KEY;
	    }
	    return $api['key'];
	}

	public function key2name(string $uuid)
	{
	    $api = $this->request('key2name', ['key' => $uuid]);
	    if (array_key_exists('error', $api)) {
	        return "Error";
	    }
	    return $api['name'];
	}

	public function displayname(string $uuid)
	{
	    $api = $this->request('getDisplayName', ['uuid' => $uuid]);
	    if (array_key_exists('error', $api)) {
	        return "Error";
	    }
	    return $api['displayName'];
	}

	public function getBotBalance()
	{
	    $api = $this->request('get_balance', []);
	    if (array_key_exists('error', $api)) {
	        return 0;
	    }
	    return $api['balance'];
	}

	public function getAvatarPic(string $uuid)
	{
	    $api = $this->request('avatar_info', ['avatar' => $uuid]);
	    if (array_key_exists('error', $api)) {
	        return $this->$NULL_KEY;
	    }
	    return $api['image'];
	}
	public function sendim(string $user, string $msg) {
	    $api = $this->request('im', ['slname' => $user, 'message' => $msg]);
	    if (array_key_exists('error', $api)) {
	        return false;
	    }
	    return true;
	}
	public function sendchanmsg(integer $chan, string $msg) {
	    $api = $this->request('say_chat_channel', ['channel' => $chan, 'message' => $msg]);
	    if (array_key_exists('error', $api)) {
	        return false;
	    }
	    return true;
	}
	public function groupinvite(string $user, string $group, string $role, $check = 1) {
	    $api = $this->request('group_invite', ['avatar' => $user, 'groupuuid' => $group, 
	    	'roleuuid' => $role, 'check_membership' => $check]);
	    if (array_key_exists('error', $api)) {
	        return false;
	    }
	    return true;
	}
	public function groupeject(string $user, string $group) {
	    $api = $this->request('group_invite', ['avatar' => $user, 'groupuuid' => $group]);
	    if (array_key_exists('error', $api)) {
	        return false;
	    }
	    return true;
	}
}
