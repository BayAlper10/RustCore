<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\farm;

use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use Rust\Main;

class Farm implements Listener{

    public function __construct(Main $plugin){
        $this->p = $plugin;
    }

    public function onBreak(BlockBreakEvent $e){
        $player = $e->getPlayer();
        $blok = $e->getBlock();
        $d = $e->getPlayer()->getLevel()->getFolderName();
        $dunya = $this->p->getServer()->getLevelByName($d);
        $x = $e->getBlock()->getX();
		$y = $e->getBlock()->getY();
        $z = $e->getBlock()->getZ();
        if($blok->getId() == 103){
            $e->setCancelled(true);
            $taglar = $this->p->tags->getNested(strtolower($player->getName()).".tag");
            if($taglar == "default"){
            $rand = mt_rand(1, 30);
            switch($rand){
                case 1:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 2:
                break;
                case 3:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(338));
                $player->sendPopup("§aŞeker Kamışı buldun.");
                break;
                case 4:
                break;
                case 5:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(360));
                $player->sendPopup("§aKarpuz buldun.");
                break;
                case 6:
                break;
                case 7:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(391));
                $player->sendPopup("§aHavuç buldun.");
                break;
                case 8:
                break;
                case 9:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(392));
                $player->sendPopup("§aPatates buldun.");
                break;
                case 10:
                break;
                case 11:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 12:
                break;
                case 13:
                break;
                case 14:
                break;
                case 15:
                break;
                case 16:
                break;
                case 17:
                break;
                case 18:
                break;
                case 19:
                break;
                case 20:
                break;
                case 21:
                break;
                case 22:
                break;
                case 23:
                break;
                case 24:
                break;
                case 25:
                break;
                case 26:
                break;
                case 27:
                break;
                case 28:
                break;
                case 29:
                break;
                case 30:
                break;
            }
        }
            $taglar = $this->p->tags->getNested(strtolower($player->getName()).".tag");
            if($taglar == "vip"){
                $rand = mt_rand(1,30);
                switch($rand){
                    case 1:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 2:
                break;
                case 3:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(338));
                $player->sendPopup("§aŞeker Kamışı buldun.");
                break;
                case 4:
                break;
                case 5:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(360));
                $player->sendPopup("§aKarpuz buldun.");
                break;
                case 6:
                break;
                case 7:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(391));
                $player->sendPopup("§aHavuç buldun.");
                break;
                case 8:
                break;
                case 9:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(392));
                $player->sendPopup("§aPatates buldun.");
                break;
                case 10:
                break;
                case 11:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 12:
                break;
                case 13:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 14:
                break;
                case 15:
                break;
                case 16:
                break;
                case 17:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(295));
                $player->sendPopup("§aSaman buldun.");
                break;
                case 18:
                break;
                case 19:
                break;
                case 20:
                break;
                case 21:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(338));
                $player->sendPopup("§aŞeker Kamışı buldun.");
                break;
                case 22:
                break;
                case 23:
                break;
                case 24:
                break;
                case 25:
                $dunya->dropItem(new Vector3($x, $y, $z), Item::get(391));
                $player->sendPopup("§aHavuç buldun.");
                break;
                case 26:
                break;
                case 27:
                break;
                case 28:
                break;
                case 29:
                break;
                case 30:
                break;
                }
            }
        }
    }
}
