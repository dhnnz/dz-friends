<?php

namespace dz;

use pocketmine\player\Player;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use dz\Loader;
use dz\AddFriends;
use dz\API;

class DashFriends{

    private $plugin;

    /**
     * @param \dz\Loader $plugin
     * @param \pocketmine\player\Player $p
     * @return void
     */
    public function __construct(Loader $plugin, Player $p){
        $this->plugin = $plugin;
        $this->dash($p);
    }

    /**
     * @param \pocketmine\player\Player $p
     * @return \jojoe77777\FormAPI\SimpleForm
     */
    public function dash(Player $p){
        $form = new SimpleForm(function(Player $p, $data){
            if($data === null){
                return true;
            }
            if($data == "close"){
                return false;
            }
            if($data == "add"){
                new AddFriends(Loader::getInstance(), $p);
                return false;
            }
            if($data == "request"){
                $p->sendMessage("§cCommingsoon");
                return false;
            }
            if($data == "list"){
                new FriendsList(Loader::getInstance(), $p);
                return false;
            }
        });
        $form->setTitle("Friends");
        foreach($this->plugin->getAPI()->getNameFriends($p) as $player){
            $kontol = $this->plugin->getServer()->getPlayerExact($player);
            if($kontol->isOnline()){
                $total = count($kontol);
                $mem = count($this->plugin->getAPI()->getFriends($p));
                $maxmem = $this->plugin->getAPI()->getMaxFriends($p) ?? "10";
                $form->addButton("§eFriend List\n§7Online: §a{$total} §7| Total: §a{$member}/{$maxmem}", "list");
            }
        }
        $form->addButton("Friend Requests\n§7Current requests: §a0", "request");
        $form->addButton("§eAdd a friend", "add");
        $form->addButton("Close", 0, "textures/blocks/barrier", "close");
        $form->sendToPlayer($p);
        return $form;
    }
}
?>
