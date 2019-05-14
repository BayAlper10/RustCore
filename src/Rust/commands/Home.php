<?php

namespace Rust\commands\home;

use Rust\Main;
use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use pocketmine\utils\Vector3;
use pocketmine\level\Position;

class Home extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Evinize ışınlanmanızı sağlar.");
    $this->setUsage("/ev");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $evsorgu = $this->p->home->getNested(strtolower($cs->getName()).".home");
    $xsorgu = $this->p->home->getNested(strtolower($cs->getName())."X");
    $ysorgu = $this->p->home->getNested(strtolower($cs->getName())."Y");
    $zsorgu = $this->p->home->getNested(strtolower($cs->getName())."Z");
    $dsorgu = $this->p->home->getNested(strtolower($cs->getName())."Dunya");
    if($evsorgu == "Yok"){
      $cs->sendMessage("§7» §cEv belirlememişsiniz!");
    }else{
      $cs->teleport(new Position($xsorgu, $ysorgu, $zsorgu, $this->p->getServer()->getLevelByName($dsorgu)));
      $cs->addTitle("§l§aEvine Işınlandın");
    }
    return true;
  }
}
