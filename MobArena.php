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

class MobArena extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Mob arenaya ışınlanmanı sağlar.");
    $this->setUsage("/mobarena");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $rand = mt_rand(1,5);
    switch($rand){
      case 1:
      $x = 261;
      $y = 118;
      $z = 280;
      $dunyaismi = "MobArena";
      $level = $this->p->getServer()->getLevelByName($dunyaismi);
      $cs->teleport(new Position($x, $y, $z, $level));
      break;
      case 2:
      $x = 259;
      $y = 118;
      $z = 247;
      $dunyaismi = "MobArena";
      $level = $this->p->getServer()->getLevelByName($dunyaismi);
      $cs->teleport(new Position($x, $y, $z, $level));
      break;
      case 3:
      $x = 283;
      $y = 119;
      $z = 225;
      $dunyaismi = "MobArena";
      $level = $this->p->getServer()->getLevelByName($dunyaismi);
      $cs->teleport(new Position($x, $y, $z, $level));
      break;
      case 4:
      $x = 306;
      $y = 116;
      $z = 229;
      $dunyaismi = "MobArena";
      $level = $this->p->getServer()->getLevelByName($dunyaismi);
      $cs->teleport(new Position($x, $y, $z, $level));
      break;
      case 5:
      $x = 316;
      $y = 116;
      $z = 263;
      $dunyaismi = "MobArena";
      $level = $this->p->getServer()->getLevelByName($dunyaismi);
      $cs->teleport(new Position($x, $y, $z, $level));
      break;
      
    }
    return true;
  }
}
