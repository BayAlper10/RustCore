<?php

/*
    ____              ___    __               _______
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ /
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/
            /____/        /_/
*/

namespace Rust;

use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\level\sound\AnvilUseSound;
use pocketmine\tile\Sign;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockBreakEvent;
use Rust\Main;

class Repair implements Listener{

    public function __construct(Main $pl){
        $this->p = $pl;
    }

    public function tabelaAyarla(SignChangeEvent $e){
        $satir = $e->getLines();
        $blok = $e->getBlock();
        $player = $e->getPlayer();
        if($satir[0] === "tamir"){
                $e->setLine(0, "§7[§aTamir§7]");
				$e->setLine(1, "§1Tamir Et");
				$e->setLine(2, "§c100TL");
				$player->sendMessage("§aTamir tabelası oluşturuldu.");
        }
    }

    public function onInteract(PlayerInteractEvent $e){
        $player = $e->getPlayer();
        $block = $e->getBlock();
        $tile = $player->getLevel()->getTile($block);
        if($tile instanceof Sign){
            if($tile->getLine(0) == "§7[§aTamir§7]"){
                $item = $player->getInventory()->getItemInHand();
                if($item->getId() == 268 or $item->getId() == 290 or $item->getId() == 291 or $item->getId() == 292 or $item->getId() == 293 or $item->getId() == 294 or $item->getId() == 298 or $item->getId() == 299 or $item->getId() == 300 or $item->getId() == 301 or $item->getId() == 302 or $item->getId() == 303 or $item->getId() == 304 or $item->getId() == 305 or $item->getId() == 306 or $item->getId() == 307 or $item->getId() == 308 or $item->getId() == 309 or $item->getId() == 310 or $item->getId() == 311 or $item->getId() == 312 or $item->getId() == 313 or $item->getId() == 314 or $item->getId() == 315 or $item->getId() == 316 or $item->getId() == 317 or $item->getId() == 257 or $item->getId() == 270 or $item->getId() == 274 or $item->getId() == 278 or $item->getId() == 285 or $item->getId() == 256 or $item->getId() == 258 or $item->getId() == 269 or $item->getId() == 271 or $item->getId() == 273 or $item->getId() == 275 or $item->getId() == 277 or $item->getId() == 279 or $item->getId() == 284 or $item->getId() == 286){
                    $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
                    if($parasi >= 100){
                        $esya = $player->getInventory()->getItemInHand();
			            $player->getInventory()->setItemInHand($esya);
				        $esya->setDamage(0);
                        $player->getInventory()->setItemInHand($esya);
                        $player->sendMessage("§aElindeki eşya tamir edildi.");
                        $player->sendMessage("§c100TL Kesildi.");
                        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
                        $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 100);
                        $this->p->money->save();
                    }else{
                        $player->sendMessage("§cYeterli paran yok.");
                    }
                }else{
                    $player->sendMessage("§cBu eşyayı tamir edemezsin.");
                }
            }
        }
    }
}
