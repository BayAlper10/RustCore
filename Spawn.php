<?php

namespace Rust\commands;

use Rust\Main;
use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\level\Position;

class Spawn extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Spawna ışınlanmanızı sağlar.");
    $this->setUsage("/spawn");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $this->p->getServer()->loadLevel("world");
    $x = $this->p->getServer()->getDefaultLevel()->getSafeSpawn()->getX();
		$y = $this->p->getServer()->getDefaultLevel()->getSafeSpawn()->getY();
		$z = $this->p->getServer()->getDefaultLevel()->getSafeSpawn()->getZ();
		$world = $this->p->getServer()->getDefaultLevel();
		$cs->setLevel($world);
		$cs->teleport(new Vector3($x, $y, $z, $world));
		$cs->setRotation(270, 0);
    $cs->addTitle("§aSPAWNA DÖNDÜN!");
    return true;
  }
}
