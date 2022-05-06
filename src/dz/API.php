<?php

namespace dz;

use pocketmine\player\Player;
use dz\Loader;

class API{

    /** @var \dz\Loader $plugin */
    private $plugin;

    /**
     * @param \dz\Loader $plugin
     * @return void
     */
    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
    }

    /**
     * @param \pocketmine\player\Player $p
     * @param \pocketmine\player\Player $friend
     * @return bool
     */
    public function addFriends(Player $p, Player $friend){
        if($this->plugin->getDatabase()->query("SELECT * FROM friends WHERE name='$p'")->fetch_row() == null){
            $playername = $p->getName();
            $friends = $friend->getName();
            $this->plugin->getDatabase()->query("INSERT INTO friends VALUES(null, '$playername', '$friends', 1, 10)");
            return true;
        }
        return false;
    }

    /**
     * @param \pocketmine\player\Player $p
     * @return int
     */
    public function getFriends(Player $p): int{
        $pname = $p->getName();
        $fplayer = $this->plugin->getDatabase()->query("SELECT fplayer FROM friends WHERE name='$pname'")->fetch_row();
        return $fplayer[0];
    }

    /**
     * @param \pocketmine\player\Player $p
     * @return int
     */
    public function getMaxFriends(Player $p): int{
        $pname = $p->getName();
        $fmax = $this->plugin->getDatabase()->query("SELECT fmax FROM friends WHERE name='$pname'")->fetch_row();
        return $fmax[0];
    }
    
    public function getNameFriends(Player $p){
        $pname = $p->getName();
        $f = $this->plugin->getDatabase()->query("SELECT friend FROM friends WHERE name='$pname'")->fetch_row();
        if(isset($f[0])){
            return $f[0];
        }
        return "";
    }
}
?>
