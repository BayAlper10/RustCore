<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\commands\economy;

use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use Rust\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\utils\TextFormat as R;

class MyMoney extends PluginCommand implements Listener{

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Parana bakmanı sağlar");
        $this->setUsage("/param");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
        if($this->p->money->exists(strtolower($cs->getName()))){
            if($cs instanceof Player){
                $cs->sendMessage(R::DARK_GRAY . "» " . R::WHITE . $this->getMoney($cs) . R::GOLD . " paran var.");
            }
        }
        return true;
    }

    public function checkLogin(PlayerPreLoginEvent $e){
        $player = $e->getPlayer();
        if(!$this->p->money->exists(strtolower($player->getName()))){
            $this->addPlayer($player);
        }
    }

    public function getMoney($player){
        return $this->p->money->getNested(strtolower($player->getName()).".money");
    }
}
