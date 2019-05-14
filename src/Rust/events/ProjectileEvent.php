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
use pocketmine\Player;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\projectile\Egg;
use pocketmine\entity\Entity;

class ProjectileEvent implements Listener{

    public function onProjectile(ProjectileLaunchEvent $e){
		$entity = $e->getEntity();

		if($entity instanceof Snowball){
			$e->setCancelled(true);
		}
		if($entity instanceof Egg){
			$e->setCancelled(true);
		}
	}
}
