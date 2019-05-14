<?php

/*
    ____              ___    __               _______ 
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ / 
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/  
            /____/        /_/                         
*/

namespace Rust\commands;

use pocketmine\{Player, Server};
use Rust\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat as R;

class Land extends PluginCommand{

    public function __construct($name, Main $plugin){
        $this->p = $plugin;
        parent::__construct($name, $plugin);
        $this->setDescription("Arazi oluşturmanızı sağlar.");
        $this->setUsage("/arazi");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool{
        $parasi = $this->p->money->getNested(strtolower($sender->getName()).".money");
        if($parasi >= 500){
            $px = $sender->getX();
            $py = $sender->getY();
            $pz = $sender->getZ();
            $radius = 10;
            $this->SinirYarat($sender, $px, $py, $pz, $radius);
            $this->p->money->setNested(strtolower($sender->getName()).".money", $parasi-500);
        }else{
            $sender->sendMessage(R::RED . "Malesef paran arazi almaya yetmiyor.");
        }

        return true;
    }

    public function SinirYarat($sender, $px, $py, $pz, $radius){	
		$orman = $this->p->getServer()->getLevelByName("world");
		$bid = [1,2,3,12,13];
		$cid = [31,37,38];
		$yid = [0,18,161,31,37,38,17,161,162,175];
		for($x = $px - $radius; $x <= $px + $radius; $x++) {
			$a1 = $orman->getHighestBlockAt($x, $pz + $radius);
			$sayi1 = 0;
			while(in_array($orman->getBlockIdAt($x, $a1 - $sayi1, $pz + $radius), $yid)){
				$sayi1 = $sayi1 + 1;
				if (in_array($orman->getBlockIdAt($x, $a1 - $sayi1, $pz + $radius), $bid)){
				$orman->setBlock(new Vector3($x, $a1 - $sayi1 + 1, $pz + $radius), Block::get(0));
				$orman->setBlock(new Vector3($x, $a1 - $sayi1 + 2, $pz + $radius), Block::get(0));
				$orman->setBlock(new Vector3($x, $a1 - $sayi1, $pz + $radius), Block::get(236,14), false, false);
				}
			}
			if(in_array($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), $bid)) {
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), Block::get(236,14), false, false);
			}
			if(in_array($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), $cid)) {
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius) - 1, $pz + $radius), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), Block::get(0), false, false);
			}
			if($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius) == 175 /*and $orman->getBlockDataAt($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius) == 8*/) {
			    $orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius) - 2, $pz + $radius), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), Block::get(0), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz + $radius), $pz + $radius), Block::get(0), false, false);
			}
			#
			$a2 = $orman->getHighestBlockAt($x, $pz - $radius);
			$sayi2 = 0;
			while(in_array($orman->getBlockIdAt($x, $a2 - $sayi2, $pz - $radius), $yid)){
				$sayi2 = $sayi2 + 1;
				if (in_array($orman->getBlockIdAt($x, $a2 - $sayi2, $pz - $radius), $bid)){
				$orman->setBlock(new Vector3($x, $a2 - $sayi2 + 1, $pz - $radius), Block::get(0));
				$orman->setBlock(new Vector3($x, $a2 - $sayi2 + 2, $pz - $radius), Block::get(0));
				$orman->setBlock(new Vector3($x, $a2 - $sayi2, $pz - $radius), Block::get(236,14), false, false);
				}
			}
			if(in_array($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), $bid)) {
			    $orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), Block::get(236,14), false, false);
			}
			if(in_array($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), $cid)) {
			    $orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius) - 1, $pz - $radius), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), Block::get(0), false, false);
			}
			if($orman->getBlockIdAt($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius) == 175) {
			    $orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius) - 2, $pz - $radius), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), Block::get(0), false, false);
				$orman->setBlock(new Vector3($x, $orman->getHighestBlockAt($x, $pz - $radius), $pz - $radius), Block::get(0), false, false);
			}
		}
		for($z = $pz - $radius; $z <= $pz + $radius; $z++) {
			$a3 = $orman->getHighestBlockAt($px + $radius, $z);
			$sayi3 = 0;
			while(in_array($orman->getBlockIdAt($px + $radius, $a3 - $sayi3, $z), $yid)){
				$sayi3 = $sayi3 + 1;
				if (in_array($orman->getBlockIdAt($px + $radius, $a3 - $sayi3, $z), $bid)){
				$orman->setBlock(new Vector3($px + $radius, $a3 - $sayi3 + 1, $z), Block::get(0));
				$orman->setBlock(new Vector3($px + $radius, $a3 - $sayi3 + 2, $z), Block::get(0));
				$orman->setBlock(new Vector3($px + $radius, $a3 - $sayi3, $z), Block::get(236,14), false, false);
				}
			}
			if(in_array($orman->getBlockIdAt($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), $bid)) {
			    $orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), Block::get(236,14), false, false);
			}
			if(in_array($orman->getBlockIdAt($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), $cid)) {
			    $orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z) - 1, $z), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), Block::get(0), false, false);
			}
			if($orman->getBlockIdAt($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z) == 175) {
			    $orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z) - 2, $z), Block::get(236,14), false, false);
			    $orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), Block::get(0), false, false);
			    $orman->setBlock(new Vector3($px + $radius, $orman->getHighestBlockAt($px + $radius, $z), $z), Block::get(0), false, false);
			}
			#
			$a4 = $orman->getHighestBlockAt($px - $radius, $z);
			$sayi4 = 0;
			while(in_array($orman->getBlockIdAt($px - $radius, $a4 - $sayi4, $z), $yid)){
				$sayi4 = $sayi4 + 1;
				if (in_array($orman->getBlockIdAt($px - $radius, $a4 - $sayi4, $z), $bid)){
				$orman->setBlock(new Vector3($px - $radius, $a4 - $sayi4 + 1, $z), Block::get(0));
				$orman->setBlock(new Vector3($px - $radius, $a4 - $sayi4 + 2, $z), Block::get(0));
				$orman->setBlock(new Vector3($px - $radius, $a4 - $sayi4, $z), Block::get(236,14), false, false);
				}
			}
			if(in_array($orman->getBlockIdAt($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), $bid)) {
			    $orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), Block::get(236,14), false, false);
			}
			if(in_array($orman->getBlockIdAt($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), $cid)) {
			    $orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z) - 1, $z), Block::get(236,14), false, false);
				$orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), Block::get(0), false, false);
			}
			if($orman->getBlockIdAt($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z) == 175) {
			    $orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z) - 2, $z), Block::get(236,14), false, false);
			    $orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), Block::get(0), false, false);
			    $orman->setBlock(new Vector3($px - $radius, $orman->getHighestBlockAt($px - $radius, $z), $z), Block::get(0), false, false);
			}
		}
	}
}