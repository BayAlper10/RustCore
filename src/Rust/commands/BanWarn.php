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
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use Rust\Main;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as R;

class BanWarn extends PluginCommand{

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Oyunculara puan vermenizi sağlar.");
        $this->setUsage("/pban");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
      $tagsorgu = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
        if($tagsorgu == "mod" or $tagsorgu == "admin" or $tagsorgu == "yetkili"){
            $target = array_shift($args);
            $puan = array_shift($args);
            if(is_null($target) or is_null($puan)){
                $cs->sendMessage(R::DARK_GRAY . "» " . R::YELLOW . "/pban {oyuncu} {puan}");
                return true;
            }
            $player = $this->p->getServer()->getPlayer($target);
            if($player instanceof Player){
                $cs->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Başarıyla puan eklendi.");
                $player->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Siciline " . $puan . " puan eklendi");
                $this->addPuan($player, $puan);
            }
        }else{
          $cs->sendMessage("...");
        }
        return true;
    }

    public function addPuan($player, $puan){
        if($puan<0){
            return self;
        }
        $aa = $this->p->banwarn->getNested(strtolower($player->getName()).".puan");
        $this->p->banwarn->setNested(strtolower($player->getName()).".puan", $aa+$puan);
        $this->p->banwarn->save();
    }
}
