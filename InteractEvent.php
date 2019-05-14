<?php

/*
    ____              ___    __               _______
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ /
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/
            /____/        /_/
*/

namespace Rust\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\{Player, Server};
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\inventory\BaseInventory;

class InteractEvent implements Listener{

	public static $ada = [];
	public static $sandik = [];

	public function onInteract(PlayerInteractEvent $e){
		$player = $e->getPlayer();
		$oyuncu = $player->getName();
		$level = $player->getLevel()->getName();
		$bloklar = array(54,130,146,138,154,205,218,145,61,62);

/*
		if($oyuncu == $level) return;
		if(in_array($e->getBlock()->getId(),$bloklar)){
			if(!in_array($oyuncu, self::$sandik[$level])){
				$e->setCancelled();
				$player->sendPopup("§cBu arazide sandıkları açma yetkiniz yok.");
				return true;
			}
		}elseif(!in_array($oyuncu, self::$ada[$level])){
			$e->setCancelled();
		}*/

		if($e->getItem()->getId() == 339){
			$can = $player->getHealth();
			$player->setHealth($can+4);
			$player->getInventory()->removeItem(Item::get(339));
		}

		if($e->getItem()->getId() == 281){
			$can = $player->getHealth();
			$player->setHealth($can+10);
			$player->getInventory()->removeItem(Item::get(281));
		}
/*
		if($e->getItem()->getId() == 399 && $player->getInventory()->getItemInHand()->getCustomName("§aSilah Kasası")){
			$item = Item::get(399,0,1)->setCustomName("§aSilah Kasası");
			if($player->getInventory()->contains($item)){
				$id = mt_rand(1, 11);

				switch($id){
					case 1:
					$player->getInventory()->addItem(Item::get(289,0,1)->setCustomName("§6Mega Barut"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fMega Barut §aeklendi.");
					break;
					case 2:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 3:
					$player->getInventory()->addItem(Item::get(370,0,1)->setCustomName("§6Kovan"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fKovan §aeklendi.");
					break;
					case 4:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 5:
					$player->getInventory()->addItem(Item::get(289,0,1)->setCustomName("§6Süper Barut"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fSüper Barut §aeklendi.");
					break;
					case 6:
					$player->getInventory()->addItem(Item::get(332,0,5)->setCustomName("§3Hafif Mermi"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f5 §aadet §fHafif Mermi §aeklendi.");
					break;
					case 7:
					$player->getInventory()->addItem(Item::get(344,0,5)->setCustomName("§3Ağır Mermi"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f5 §aadet §fAğır Mermi §aeklendi.");
					break;
					case 8:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 9:
					$player->getInventory()->addItem(Item::get(175,0,1)->setCustomName("§cBlok Jetonu"));
					$player->getInventory()->removeItem(Item::get(399,0,1));
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fBlok Jetonu §aeklendi.");
					break;
					case 11:
					$player->getInventory()->addItem(Item::get(290,0,1)->setCustomName("§eTabanca"));
					$player->getInventory()->removeItem(Item::get(399,0,1));
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fTabanca §aeklendi.");
					break;
				}
			}
		}
		if($e->getItem()->getId() == 399 && $player->getInventory()->getItemInHand()->getCustomName("§aSağlık Kasası")){
			$item = Item::get(399,0,1)->setCustomName("§aSağlık Kasası");
			if($player->getInventory()->contains($item)){
				$id = mt_rand(1,4);
				switch($id){
					case 1:
					$player->getInventory()->addItem(Item::get(339,0,1)->setCustomName("§1Bandaj"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fBandaj §aeklendi.");
					break;
					case 2:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 3:
					$player->getInventory()->addItem(Item::get(281,0,1)->setCustomName("§1Sağlık Çantası"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fSağlık Çantası §aeklendi.");
					break;
					case 4:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
				}
			}

		}
		if($e->getItem()->getId() == 399 && $player->getInventory()->getItemInHand()->getCustomName("§aZırh Kasası")){
			$item = Item::get(399,0,1)->setCustomName("§aZırh Kasası");
			if($player->getInventory()->contains($item)){
				$id = mt_rand(1, 28);
				switch($id){
					case 1:
					$player->getInventory()->addItem(Item::get(298,0,1)->setCustomName("§4Askeri Kask"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fAskeri Kask §aeklendi.");
					break;
					case 2:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 3:
					$player->getInventory()->addItem(Item::get(299,0,1)->setCustomName("§4Askeri Üst"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fAskeri Üst §aeklendi.");
					break;
					case 4:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 5:
					$player->getInventory()->addItem(Item::get(300,0,1)->setCustomName("§4Askeri Pantalon"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fAskeri Pantalon §aeklendi.");
					break;
					case 6:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 7:
					$player->getInventory()->addItem(Item::get(301,0,1)->setCustomName("§4Askeri Bot"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fAskeri Bot §aeklendi.");
					break;
					case 8:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 9:
					$player->getInventory()->addItem(Item::get(314,0,1)->setCustomName("§4Kamuflaj Kask"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fKamuflaj Kask §aeklendi.");
					break;
					case 10:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 11:
					$player->getInventory()->addItem(Item::get(315,0,1)->setCustomName("§4Kamuflaj Üst"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fKamuflaj Üst §aeklendi.");
					break;
					case 12:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 13:
					$player->getInventory()->addItem(Item::get(316,0,1)->setCustomName("§4Kamuflaj Pantalon"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fKamuflaj Pantalon §aeklendi.");
					break;
					case 14:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 15:
					$player->getInventory()->addItem(Item::get(317,0,1)->setCustomName("§4Kamuflaj Bot"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fKamuflaj Bot §aeklendi.");
					break;
					case 16:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;

					case 17:
					$player->getInventory()->addItem(Item::get(306,0,1)->setCustomName("§4Radyasyon Kask"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fRadyasyon Kask §aeklendi.");
					break;
					case 18:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 19:
					$player->getInventory()->addItem(Item::get(307,0,1)->setCustomName("§4Radyasyon Üst"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fRadyasyon Üst §aeklendi.");
					break;
					case 20:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 21:
					$player->getInventory()->addItem(Item::get(308,0,1)->setCustomName("§4Radyasyon Pantalon"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fRadyasyon Pantalon §aeklendi.");
					break;
					case 22:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
					case 23:
					$player->getInventory()->addItem(Item::get(309,0,1)->setCustomName("§4Radyasyon Bot"));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aEnvanterine §f1 §aadet §fRadyasyon Bot §aeklendi.");
					break;
					case 24:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;

					case 25:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;

					case 26:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;

					case 27:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;

					case 28:
					$player->sendMessage("§8» §cMalesef birşey bulamadın!");
					$player->getInventory()->removeItem($item);
					break;
				}
			}
		}
	} */
}
}
