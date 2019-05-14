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
use pocketmine\utils\TextFormat as R;

class RemoveMoney extends PluginCommand{

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Oyuncunun parasını silmenizi sağlar.");
        $this->setUsage("/parasil");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
        if($cs->isOp()){
            $target = array_shift($args);
            $money = array_shift($args);
            if(is_null($target) or is_null($money)){
                $cs->sendMessage(R::DARK_GRAY . "» " . R::YELLOW . "/parasil {oyuncu} {miktar}");
                return true;
            }
            $player = $this->p->getServer()->getPlayer($target);
            if($player instanceof Player){
                $cs->sendMessage(R::DARK_GRAY . "» " . R::RED . "Başarıyla para silindi.");
                $player->sendMessage(R::DARK_GRAY . "» " . R::RED . "Hesabından " . $money . " para silindi.");
                $this->removeMoney($player, $money);
            }
        }
        return true;
    }

    public function removeMoney($player, $money){
        if($money<0){
            return self;
        }
        $aa = $this->p->money->getNested(strtolower($player->getName()).".money");
        $this->p->money->setNested(strtolower($player->getName()).".money", $aa-$money);
        $this->p->money->save();
    }
}