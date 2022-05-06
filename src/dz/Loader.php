<?php

namespace dz;

use mysqli;
use mysqli_result;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use dz\FriendsCommand;
use dz\API;

class Loader extends PluginBase{

    /** @var \dz\Loader $instance */
    private static Loader $instance;

    /** @var mixed $config */
    public $config;

    /**
     * @return \dz\Loader
     */
    public static function getInstance(): Loader{
        return self::$instance;
    }

    public function onLoad(): void{
        self::$instance = $this;
    }

    public function onEnable(): void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        $this->getDatabase()->query("CREATE TABLE IF NOT EXISTS friends ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(255) NOT NULL, friend VARCHAR(255) NOT NULL , fplayer INT(11) NOT NULL, fmax INT(11) NOT NULL);");
        $this->getServer()->getCommandMap()->register("dz-friends", new FriendsCommand("friend", "Friend a Command", $this));
        $this->getLogger()->info("plugin has enable");
    }

    /** @return \mysqli */
    public function getDatabase(){
        return new \mysqli($this->getConfig()->getNested("mysql.host"), $this->getConfig()->getNested("mysql.user"), $this->getConfig()->getNested("mysql.password"), $this->getConfig()->getNested("mysql.database"));
    }
    
    public function getAPI(){
        return new API($this);
    }
}
?>
