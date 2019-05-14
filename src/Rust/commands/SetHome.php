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

class SetHome extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Bulunduğunuz bölgeyi eviniz olarak işaretler.");
    $this->setUsage("/evayarla");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $x = $cs->getX();
    $y = $cs->getY();
    $z = $cs->getZ();
    $dunya = $cs->getLevel()->getName();
    $this->p->home->setNested(strtolower($cs->getName()).".home", "Var");
    $this->p->home->setNested(strtolower($cs->getName())."X", $x);
    $this->p->home->setNested(strtolower($cs->getName())."Y", $y);
    $this->p->home->setNested(strtolower($cs->getName())."Z", $z);
    $this->p->home->setNested(strtolower($cs->getName())."Dunya", $dunya);
    $cs->sendMessage("§7» §aEvin X: $x Y: $y Z: $z kordinatlarına belirlendi!");
    $this->p->home->save();
    return true;
  }
}
