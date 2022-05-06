<?php

namespace dz;

use pocketmine\player\Player;
use dz\Loader;
use dz\API;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class FriendsList{

    /**
     * @param \dz\Loader $plugin
     * @param \pocketmine\player\Player $p
     * @return void
     */
    public function __construct(Loader $plugin, Player $p){
        $this->plugin = $plugin;
        $this->listf($p);
    }

    /**
     * @param \pocketmine\player\Player $p
     * @return \jojoe77777\FormAPI\SimpleForm
     */
    public function listf(Player $p){
        $form = new SimpleForm(function(Player $p, $data){
            if($data === null){
                return true;
            }
        });
        $form->setTitle("Friend");
        foreach($this->plugin->getAPI()->getPlayerFriends($p) as $kontol){
            if($kontol instanceof Player){
                $on = $this->plugin->getServer()->getPlayerByPrefix(strval(($kontol))) ? "§aOnline" : "§cOffline";
                $form->addButton("{$kontol->getName()}\n{$on}", -1,  "", "{$kontol->getName()}");
            }
        }
        $form->sendToPlayer($p);
        return $form;
    }
}
?>
