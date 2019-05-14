<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\commands\epin;

use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\level\Level;
use pocketmine\utils\Config;
use Rust\Main;

class CreatePin extends PluginCommand{

    private $long = 6;

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Epin oluşturmanı sağlar.");
        $this->setUsage("/epinolustur");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
        if($cs->isOp()){
            if(!(empty($args[0]) && empty($args[1]))){
                if(is_numeric($args[0]) && is_numeric($args[1])){
                    $code = $this->getRandomCode();
                    $epin = new Config($this->p->getDataFolder()."Pinler/".$code.".yml", Config::YAML);
                    $epin->set("Kullanıldımı", 0);
                    $epin->set("Para", (int)$args[0]);
                    $epin->set("Sure", (int)$args[1]);
                    $epin->save();
                    $cs->sendMessage("§8» §aElectronic Pin oluşturuldu. §f" . $code);
                }else{
                    $cs->sendMessage("§cGün ve Para sayısal bir değer olmalıdır.");
                }
            }else{
                $cs->sendMessage("§8» §e/epin <para> <gün>");
            }
        }else{
            $cs->sendMessage("§8» §cBu komutu kullanmak için yetkin yok.");
        }
        return true;
    }
    public function getRandomCode(){
        return base64_encode(random_bytes($this->long));
    }
}
