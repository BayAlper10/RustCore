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

class SendMoney extends PluginCommand{

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Bir oyuncuya para göndermenizi sağlar.");
        $this->setUsage("/paragonder");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
        $target = array_shift($args);
        $money = array_shift($args);
        if(is_null($target) or is_null($money)){
            $cs->sendMessage(R::DARK_GRAY . "» " . R::YELLOW . "/paragonder {oyuncu} {miktar}");
            return true;
        }
        $player = $this->p->getServer()->getPlayer($target);
        if($player instanceof Player){
            $gonderenpara = $this->p->money->getNested(strtolower($cs->getName()).".money");
            if($money <= $gonderenpara){
            $cs->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Başarıyla para gönderdin.");
            $player->sendMessage(R::DARK_GRAY . "» " . R::GREEN . "Hesabına " . $money . " para gönderildi.");
            $gonderenpara = $this->p->money->getNested(strtolower($cs->getName()).".money");
            $this->p->money->setNested(strtolower($cs->getName()).".money", $gonderenpara - $money);
            $this->p->money->save();
            $gonderilenpara = $this->p->money->getNested(strtolower($player->getName()).".money");
            $this->p->money->setNested(strtolower($player->getName()).".money", $gonderilenpara + $money);
            $this->p->money->save();
            }else{
                $cs->sendMessage(R::DARK_GRAY . "» " . R::RED . "Paran yetersiz");
                return true;
            }
        }
        return true;
    }
}
