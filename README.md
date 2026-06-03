# LifeBots Standalone php SDK

A lightweight, expressive standalone file for interacting with the **LifeBots.cloud API**.  

---

## Installation
in the main LifeBots.php file, there are some configs to set.

$data['apikey'] is the developer key, once you get a life bot account theres a option to be a developer.

$data['botname'] is the name of your bot, their legacy/login name, NOT their display name.

$data['secret'] is the secret password you set in your bot's web config.

## Usage
```php
$name = new LifeBots()->key2name($uuid); // returns Error if failed
$key = new LifeBots()->name2key($name); // returns nullkey if failed
$displayName = new LifeBots()->displayname($uuid); // returns Error if failed
$botBalance = new LifeBots()->getBotBalance(); // returns a zero if failed
$avatarPic = new LifeBots()->getAvatarPic($uuid); // returns a nullkey if failed
new LifeBots()->sendim($legacyname, $message); // returns true if sent, false otherwise
new LifeBots()->sendchanmsg($channel, $message); // same as this one
new LifeBots()->groupinvite(string $user, string $group, string $role, integer $check = 1); // returns true|false
new LifeBots()->groupeject(string $user, string $group); // returns true|false
```
getAvatarPic() returns the UUID of the texture in the avatar's profile picture.
Please use a processor to get the texture from SL to display on a web page

More features will come in a future update.

## Credits

- NealB for making LifeBots for Second Life
- Venkellie for making this package to work with LifeBots.

Last Update: June 3 2026 (1.0.3)

## CHANGE LOGS

### 1.0.3 June 3 2026
- Added groupinvite and groupeject
- skipped 1 and 2 to align with the Laravel version
- Started recording these change logs

### 1.0.0 June 2 2026
- forked the Laravel version and converted it to be a standalone

