<?php

namespace dz;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use dz\Loader;
use dz\AddFriends;
use dz\DashFriends;
use dz\FriendsList;

class FriendsCommand extends Command{
    
    /** @var \dz\Loader $plugin */
    private $plugin;
    
    /**
     * @param String $name
     * @param String $description
     * @param \dz\Loader $plugin
     * @return void
     */
    public function __construct(string $name, string $description, Loader $plugin){
        parent::__construct($name, $description);
        parent::setAliases(["f"]);
        $this->plugin = $plugin;
    }
    
    /**
     * @param \pocketmine\command\CommandSender $sender
     * @param String $commandLabel
     * @param Array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            new DashFriends(Loader::getInstance(), $sender);
        } else {
            $sender->sendMessage("You not a player");
        }
    }
}
?>
