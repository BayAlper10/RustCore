<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class JoinEvent implements Listener{

   /* public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
    }

    public function onJoin(PlayerJoinEvent $e): void{
        if(!$this->p->money->exists(strtolower($player->getName()))){
	    	$this->p->money->setNested(strtolower($player->getName()).".money", 0);
	    	$this->p->money->save();
	    }
    }*/
}