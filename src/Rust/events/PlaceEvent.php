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
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\Player;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\level\Position\getLevel;
use pocketmine\level\format\Chunk;
use pocketmine\level\format\FullChunk;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\level\Position;
use pocketmine\event\player\PlayerDropItem;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\entity\Entity;
use pocketmine\tile\ItemFrame;

class PlaceEvent implements Listener{



	public function onExhaust(PlayerExhaustEvent $e){
		$p = $e->getPlayer();
		if($p->getLevel()->getFolderName() == "world"){
			$e->setCancelled(true);
		}
	}

	public function onDrop(PlayerDropItemEvent $e){
		if($e->getPlayer()->getLevel()->getFolderName() == "world"){
			$e->getPlayer()->sendTip("§8» §cBurada eşya atamazsın.");
			$e->setCancelled(true);
		}
		if($e->getPlayer()->getLevel()->getFolderName() == "MobArena"){
			$e->getPlayer()->sendTip("§8» §cBurada eşya atamazsın.");
			$e->setCancelled(true);
		}
	}

public function onInteract(PlayerInteractEvent $e){
	$block = $e->getBlock();
	$frame = $block->getLevel()->getTile($block);
	if ($frame instanceof ItemFrame) {
		$e->setCancelled(true);
	}
}

	public function onDeath(PlayerDeathEvent $e){
		if($e->getPlayer()->getLevel()->getFolderName() == "world"){
			$e->setKeepInventory(true);
			$e->setDrops([]);
		}else{
			return;
		}
	}

	public function onHeld(PlayerItemHeldEvent $e){
		if($e->getPlayer()->getLevel()->getFolderName() == "world"){
			$a = "§8» §cKullanmak Yasak";
			if($e->getItem()->getId() == 261){
				$e->getPlayer()->sendTip($a);
				$e->setCancelled(true);
			}
			if($e->getItem()->getId() == 344){
				$e->getPlayer()->sendTip($a);
				$e->setCancelled(true);
			}
			if($e->getItem()->getId() == 332){
				$e->getPlayer()->sendTip($a);
				$e->setCancelled(true);
			}
		}else{
			return;
		}
	}

	public function onDamage(EntityDamageEvent $e){
		$o = $e->getEntity();
		if($o instanceof Player){
			if($o->getLevel()->getFolderName() == "world"){
				$e->setCancelled(true);
			}
		}
	}

	public function onBreak(BlockBreakEvent $e){
		if($e->getPlayer()->getLevel()->getFolderName() == "world"){
			if($e->getPlayer()->isOp()){
				$e->setCancelled(false);
			}else{
				$e->setCancelled(true);
			}
		}
		if($e->getPlayer()->getLevel()->getFolderName() == "MobArena"){
			if($e->getPlayer()->isOp()){
				$e->setCancelled(false);
			}else{
				$e->setCancelled(true);
			}
		}
	}

	public function onPlace(BlockPlaceEvent $e): void{
        $player = $e->getPlayer();

				if($e->getItem()->getId() == 58){
            $e->setCancelled(true);
            $player->sendTip("§8»§cCraft menüsü için /craft yazman yeterli.");
        }
        if($e->getItem()->getId() === 175){
			$e->setCancelled(true);
		}

				if($e->getPlayer()->getLevel()->getFolderName() == "world"){
					if($e->getPlayer()->isOp()){
						$e->setCancelled(false);
					}else{
						$e->setCancelled(true);
					}
				}
				if($e->getPlayer()->getLevel()->getFolderName() == "MobArena"){
					if($e->getPlayer()->isOp()){
						$e->setCancelled(false);
					}else{
						$e->setCancelled(true);
					}
				}
	}
/*
	public function onRespawn(PlayerRespawnEvent $e){
		$x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getX();
		$y = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getY();
		$z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getZ();
		$world = $this->getServer()->getDefaultLevel();
		$player->setLevel($world);
		$player->teleport(new Vector3($x, $y, $z, $world));
		$player->setRotation(270, 0);
	}*/
}
