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

use Rust\Main;
use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as R;

class Coordinat extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Seçtiğin bir oyuncunun konumunu gösterir.");
    $this->setUsage("/konumu");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $tagsorgu = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
    if($tagsorgu == "vip+"){
      $target = array_shift($args);
      if(is_null($target)){
        $cs->sendMessage(R::DARK_GRAY . "» " . R::YELLOW . "/konumu {oyuncu}");
        return true;
      }
      $player = $this->p->getServer()->getPlayer($target);
      if($player instanceof Player){
        $x = $player->getX();
        $y = $player->getY();
        $z = $player->getZ();
        $cs->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Oyuncunun tahmini kordinatları " . R::WHITE . "$x $y $z");
        $player->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Bir oyuncu kordinatlarını gördü hemen uzaklaş.");
      }
    }else{
      $cs->sendMessage("§cKomut şuanda bakımda.");
    }
    return true;
  }
}
