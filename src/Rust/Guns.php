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
use pocketmine\event\entity\ExplosionPrimeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;

use pocketmine\inventory\Inventory;
use pocketmine\math\Vector3;
use pocketmine\level\Explosion;
use pocketmine\level\Position;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\SnowBall as Bullet;
use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\Entity;
use pocketmine\entity\projectile\Egg;
use pocketmine\entity\projectile\Arrow;
use pocketmine\entity\object\PrimedTNT;

use pocketmine\level\particle\DestroyBlockParticle as BloodParticle;
use pocketmine\level\particle\FlameParticle as WeaponShootParticle;

use pocketmine\level\sound\DoorCrashSound as ExplodeSound;
use pocketmine\level\sound\BlazeShootSound as WeaponShootSound;

use Rust\Main;

class Guns implements Listener{

	/*public function __construct(Main $plugin){
		$this->p = $plugin;
	}*/

	public function onExplode(ExplosionPrimeEvent $e){
		$e->setBlockBreaking(true); //Mayınlar patlayınca bloklar kırılmayacak
	}

	public function onDamage(EntityDamageEvent $e){
		if($e instanceof EntityDamageByChildEntityEvent){
			$child = $e->getChild();
			if($child instanceof Snowball){
				$e->setModifier(2, EntityDamageEvent::CAUSE_ENTITY_ATTACK);
			}

		    if($child instanceof Egg){
				$e->setModifier(4, EntityDamageEvent::CAUSE_ENTITY_ATTACK);
			}
			if($child instanceof Arrow){
				$e->setModifier(3, EntityDamageEvent::CAUSE_ENTITY_ATTACK);
			}
			if($child->y - $e->getEntity()->y > 1.35){
				$e->setModifier(10, EntityDamageEvent::CAUSE_ENTITY_ATTACK);
			}
		}
		//Kan efektini ayarlama
		if($e instanceof EntityDamageByEntityEvent){
			if($e->getDamager() instanceof Player or $e->getDamager() instanceof SnowBall or $e->getDamager() instanceof Egg){
				if($e->getEntity() instanceof Player){
					if(!$e->isCancelled()){
						$e->getEntity()->getLevel()->addParticle(new BloodParticle($e->getEntity(), Block::get(152)));
					}
				}
			}
		}
	}

	//Tnt patlama olayı
	public function onMove(PlayerMoveEvent $e){
		$player = $e->getPlayer();
		$x = $player->x;
		$y = $player->y;
		$z = $player->z;
		$y1 = $y-1;
		$pos = new Vector3($x, $y1, $z);
		$block = $player->getLevel()->getBlock($pos);
		if($block->getId() == 151){
			$explosion = new Explosion(new Position($x, $y+1, $z, $player->getLevel()), 4);
			$explosion->explodeB();
			$block->getLevel()->setBlock($block, new Air(), true, true);
			$player->getLevel()->addSound(new ExplodeSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
		}
	}

	public function onInteract(PlayerInteractEvent $e){
		$player = $e->getPlayer();
		$level = $player->getLevel();
        $item = $e->getItem();
        $block = $player->getLevel()->getBlock($player->floor()->subtract(0, 1));
        $fdefault = 1.5;
		$nbtdefault = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x ), new DoubleTag( "", $player->y + $player->getEyeHeight () ), new DoubleTag( "", $player->z ) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
		if($item->getId() == 290){
			$e->setCancelled(true);
			$item = Item::get(332 , 0, 1)->setCustomName("§3Hafif Mermi");
			if($player->getInventory()->contains($item)){
				$bullet = Entity::createEntity("Snowball", $level, $nbtdefault, $player);
				$bullet->setMotion($bullet->getMotion()->multiply($fdefault));
				$bullet->spawnToAll();
				$player->getLevel()->addSound(new WeaponShootSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
				$player->getLevel()->addParticle(new WeaponShootParticle(new Vector3($player->x + 0.4, $player->y, $player->z)));
				$player->getInventory()->removeItem(Item::get(Item::SNOWBALL, 0, 1));
				$player->getInventory()->sendContents($player);
			}else{
				$player->sendTip("§cYeterli sayıda mermin yok!");
			}
		}elseif($item->getId() == 291){
			$e->setCancelled(true);
			$item = Item::get(332 , 0, 6)->setCustomName("§3Hafif Mermi");
			if($player->getInventory()->contains($item)){
				$nbt1 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x + 1), new DoubleTag( "", $player->y + $player->getEyeHeight () ), new DoubleTag( "", $player->z ) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $nbt2 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x - 1), new DoubleTag( "", $player->y + $player->getEyeHeight () ), new DoubleTag( "", $player->z ) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $nbt3 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x), new DoubleTag( "", $player->y + $player->getEyeHeight () ), new DoubleTag( "", $player->z + 1) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $nbt4 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x ), new DoubleTag( "", $player->y + $player->getEyeHeight () ), new DoubleTag( "", $player->z - 1) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $nbt5 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x ), new DoubleTag( "", $player->y + $player->getEyeHeight () + 1), new DoubleTag( "", $player->z ) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $nbt6 = new CompoundTag( "", [ "Pos" => new ListTag( "Pos", [ new DoubleTag( "", $player->x ), new DoubleTag( "", $player->y + $player->getEyeHeight () - 1), new DoubleTag( "", $player->z ) ]), "Motion" => new ListTag( "Motion", [ new DoubleTag( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "", - \sin ( $player->pitch / 180 * M_PI ) ), new DoubleTag( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ]), "Rotation" => new ListTag( "Rotation", [ new FloatTag( "", $player->yaw ), new FloatTag( "", $player->pitch ) ]) ]);
    $bullet1 = Entity::createEntity("Snowball", $level, $nbt1, $player);
    $bullet2 = Entity::createEntity("Snowball", $level, $nbt2, $player);
    $bullet3 = Entity::createEntity("Snowball", $level, $nbt3, $player);
    $bullet4 = Entity::createEntity("Snowball", $level, $nbt4, $player);
    $bullet5 = Entity::createEntity("Snowball", $level, $nbt5, $player);
    $bullet6 = Entity::createEntity("Snowball", $level, $nbt6, $player);
    $bullet1->setMotion($bullet1->getMotion()->multiply($fdefault));
    $bullet2->setMotion($bullet2->getMotion()->multiply($fdefault));
    $bullet3->setMotion($bullet3->getMotion()->multiply($fdefault));
    $bullet4->setMotion($bullet4->getMotion()->multiply($fdefault));
    $bullet5->setMotion($bullet5->getMotion()->multiply($fdefault));
    $bullet6->setMotion($bullet6->getMotion()->multiply($fdefault));
    $bullet1->spawnToAll();
    $bullet2->spawnToAll();
    $bullet3->spawnToAll();
    $bullet4->spawnToAll();
    $bullet5->spawnToAll();
    $bullet6->spawnToAll();
    $player->getLevel()->addSound(new WeaponShootSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
	$player->getLevel()->addParticle(new WeaponShootParticle(new Vector3($player->x + 0.4, $player->y, $player->z)));
	$player->getInventory()->removeItem(Item::get(Item::SNOWBALL, 0, 6));
	$player->getInventory()->sendContents($player);
			}else{
				$player->sendTip("§cYeterli sayıda mermin yok!");
			}
		}elseif($item->getId() == 292){
			$e->setCancelled(true);
			$item = Item::get(344,0,1)->setCustomName("§3Ağır Mermi");
			if($player->getInventory()->contains($item)){
				$f = 2;
				$bullet = Entity::createEntity("Egg", $level, $nbtdefault, $player);
				$bullet->setMotion($bullet->getMotion()->multiply($f));
				$bullet->spawnToAll();
				$player->getLevel()->addSound(new WeaponShootSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
				$player->getLevel()->addParticle(new WeaponShootParticle(new Vector3($player->x + 0.4, $player->y, $player->z)));
				$player->getInventory()->removeItem(Item::get(Item::EGG, 0, 1));
				$player->getInventory()->sendContents($player);
			}else{
				$player->sendTip("§cYeterli sayıda mermin yok!");
			}
		}elseif($item->getId() == 293){
			$e->setCancelled(true);
			$item = Item::get(262 , 0, 1)->setCustomName("§3AK Mermisi");
			if($player->getInventory()->contains($item)){
				$f = 3;
				$bullet = Entity::createEntity("Arrow", $level, $nbtdefault, $player);
				$bullet->setMotion($bullet->getMotion()->multiply($f));
				$bullet->spawnToAll();
				$player->getLevel()->addSound(new WeaponShootSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
				$player->getLevel()->addParticle(new WeaponShootParticle(new Vector3($player->x + 0.4, $player->y, $player->z)));
				$player->getInventory()->removeItem(Item::get(262, 0, 1));
				$player->getInventory()->sendContents($player);
			}else{
				$player->sendTip("§cYeterli sayıda mermin yok!");
			}
		}elseif($item->getId() == 294){
			$e->setCancelled(true);
			if($player->getInventory()->contains(Item::get(46,0,1))){
				$f = 2;
				$tnt = Entity::createEntity("PrimedTNT", $level, $nbtdefault, $player);
				$tnt->setMotion($tnt->getMotion()->multiply($f));
				$tnt->spawnToAll();
				$player->getLevel()->addSound(new WeaponShootSound(new Vector3($player->x, $player->y, $player->z, $player->getLevel())));
				$player->getLevel()->addParticle(new WeaponShootParticle(new Vector3($player->x + 0.4, $player->y, $player->z)));
				$player->getInventory()->removeItem(Item::get(46, 0, 1));
				$player->getInventory()->sendContents($player);
			}else{
				$player->sendTip("§cYeterli sayıda roket yok!");
			}
		}
	}
}
