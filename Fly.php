<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\commands;

use pocketmine\{Player, Server};
use Rust\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat as R;

class Fly extends PluginCommand implements Listener{

    public $players = array();

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Uçmanı sağlar.");
        $this->setUsage("/fly");
    }

    public function execute(CommandSender $cs, string $label, array $args): bool{
        $permmanager = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
        if($permmanager == "mod" or $permmanager == "admin" or $permmanager == "yetkili"){
            if($cs instanceof Player){
                if(!$cs->isSurvival()){
                    return true;
                }
                if($this->isPlayer($cs)){
                    $this->removePlayer($cs);
                    $cs->setFlying(false);
                    $cs->setAllowFlight(false);
                    $cs->sendMessage(R::RED . "Uçma modu kapatıldı");
                    return true;
                }else{
                    $this->addPlayer($cs);
                    $cs->setAllowFlight(true);
                    $cs->sendMessage(R::GREEN . "Uçma modu açıldı");
                    return true;
                }
            }else{
                $cs->sendMessage(R::RED . "Oyunda kullan.");
            }
        }
        return true;
    }

    public function addPlayer(Player $player){
        $this->players[$player->getName()] = $player->getName();
    }
    public function removePlayer(Player $player){
        unset($this->players[$player->getName()]);
    }
    public function isPlayer(Player $player){
        return in_array($player->getName(), $this->players);
    }

    public function onDamage(EntityDamageEvent $e){
        if($e instanceof EntityDamageByEntityEvent){
            $damager = $e->getDamager();
            $harmed = $e->getEntity();
            if(($damager instanceof Player and $this->isPlayer($damager) and $damager->isFlying() and $harmed instanceof Player) or ($harmed instanceof Player and $this->isPlayer($harmed) and $harmed->isFlying() and $damager instanceof Player)){
                $damager->sendTip(R::RED . "Uçarken kimseye vuramazsın.");
                $e->setCancelled(true);
            }
        }
    }
}