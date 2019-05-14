<?php

namespace Rust\commands;

use Rust\Main;
use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;

class Feed extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setPermission("Açlık doldurmanı sağlar.");
    $this->setUsage("/feed");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $tagsorgu = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
    if($tagsorgu == "vip"){
      $cs->setFood(20);
      $cs->sendMessage("§aAçlığın başarı ile dolduruldu.");
    }else{
      $cs->sendMessage("§cKomutu kullanmak için yetkin yok.");
    }
    return true;
  }
}
