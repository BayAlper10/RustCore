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
use pocketmine\item\Item;
use Rust\Main;

class UsePin extends PluginCommand{


    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Epin kullanmanı sağlar.");
        $this->setUsage("/epin");
    }

    public function execute(CommandSender $cs, string $commandLabel, array $args): bool{
        if(!empty($args[0])){
            if(file_exists($this->p->getDataFolder()."Pinler/".$args[0].".yml")){
                $epin = new Config($this->p->getDataFolder()."Pinler/".$args[0].".yml", Config::YAML);
                if($epin->get("Kullanıldımı") == 0){
                    $this->giveVip($this->p->getServer()->getPlayer($cs->getName()), (int)$epin->get("Para"), (int)$epin->get("Sure"));
                    $epin->set("Kullanıldımı", 1);
                    $epin->save();
                    $cs->sendMessage("§8» §aVip aktif edildi.");
					$this->p->getServer()->broadcastMessage("§8» §f" . $cs->getName() . " §aisimli oyuncu vip aldı.");
                }else{
                    $cs->sendMessage("§8» §cBu kod daha önce kullanılmış.");
                }
            }else{
                $cs->sendMessage("§8» §cBöyle bir kod bulunmuyor.");
            }
        }else{
            $cs->sendMessage("§8» §e/epin <kod>");
        }
        return true;
    }

    public function giveVip(Player $cs, int $para = 0, int $gun = 1):bool{
		$this->p->d->set($cs->getName(), [
            "Baslangic" => time(),
            "Bitis" => strtotime('+'.$gun.' day')
        ]);
        $this->p->d->save();
        $parasi = $this->p->money->getNested(strtolower($cs->getName()).".money");
        $this->p->money->setNested(strtolower($cs->getName()).".money", $parasi+$para);
        $this->p->money->save();

        $tagi = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
        $this->p->tags->setNested(strtolower($cs->getName()).".tag", "vip");
        $this->p->tags->save();

        $cs->getInventory()->addItem(Item::get(294,0,1)->setCustomName("§eRoket"));
        $cs->getInventory()->addItem(Item::get(46,0,3)->setCustomName("§4PATLAYICI"));

        $cs->setMaxHealth(24);
		return true;
	}
}
