<?php

namespace dz;

use pocketmine\player\Player;
use pocketmine\Server;
use dz\Loader;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\CustomForm;

class AddFriends{

    private $bgst = [];

    /**
     * @param \dz\Loader $plugin
     * @param \pocketmine\player\Player $p
     * @return void
     */
    public function __construct(Loader $plugin, Player $p){
        $this->plugin = $plugin;
        $this->addFriends($p);
    }

    /**
     * @param \pocketmine\player\Player $p
     * @return \jojoe77777\FormAPI\CustomForm
     */
    public function addFriends(Player $p){
        $list = [];
        $kon = [];
        foreach($this->plugin->getServer()-getOnlinePlayers() as $pl){
            $list[] = $pl->getDisplayName();
        }
        foreach($this->plugin->getServer()->getOnlinePlayers() as $anj){
            $kon[] = $anj->getName();
        }
        $this->bgst[$p->getDisplayName()] = $list;
        $this->bgst[$p->getName()] = $kon;
        $form = new CustomForn(function(Player $p, array $data){
            if($data === null){
                return true;
            }
            if($this->plugin->getAPI()->getFriends($p) >= $this->plugin->getAPI()->getMaxFriends($p)){
                $p->sendMessage("§cyour friends has full!");
            }else{
                $index = $data[0];
                $test = $this->bgst[$p->getName()][$index];
                $anjg = $this->bgst[$p->getDisplayName()][$index];
                $kontols = $this->plugin->getServer()->getPlayerExact($test);
                $this->plugin->getAPI()->addFriends($p, $kontols);
                $p->sendMessage("§ase d a friend request {$anjg}");
            }
        });
        $form->setTitle("Friend");
        $form->addDropdown("Select a player", $this->bgst[$p->getDisplayName()]);
        $form->sendToPlayer($p);
        return $form;
    }
}
?>
