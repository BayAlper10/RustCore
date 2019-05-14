<?php

/*
    ____              ___    __               _______
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ /
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/
            /____/        /_/
*/

namespace Rust\forms;

use Rust\Main;
use Rust\formapi\SimpleForm;
use pocketmine\{Player, Server};
use pocketmine\item\Item;
use pocketmine\block\Block;

class CraftForm{

	public function silahForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getLevel();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				if($player->getInventory()->contains(Item::get(371, 0, 1)) && $player->getInventory()->contains(Item::get(452, 0, 1))){
					$player->sendMessage("§8» §aBaşarı ile §fKovan §ayaptın.");
					$player->getInventory()->removeItem(Item::get(371,0,1));
					$player->getInventory()->removeItem(Item::get(452,0,1));
					$player->getInventory()->addItem(Item::get(370,0,1)->setCustomName("§6Kovan"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 1:
				if($player->getInventory()->contains(Item::get(266,0,2)) && $player->getInventory()->contains(Item::get(289,0,1))){
					$player->sendMessage("§8» §aBaşarı ile §fSüper Barut §ayaptın.");
					$player->getInventory()->removeItem(Item::get(266,0,2));
					$player->getInventory()->removeItem(Item::get(289,0,1));
					$player->getInventory()->addItem(Item::get(289,0,1)->setCustomName("§6Süper Barut"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 2:
				$item = Item::get(289,0,1)->setCustomName("§6Süper Barut");
				if($player->getInventory()->contains(Item::get(388,0,2)) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fMega Barut §ayaptın.");
					$player->getInventory()->removeItem(Item::get(388,0,2));
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(289,0,1)->setCustomName("§6Mega Barut"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 3:
				$item = Item::get(370,0,1)->setCustomName("§6Kovan");
				$item2 = Item::get(289,0,1)->setCustomName("§6Süper Barut");
				if($player->getInventory()->contains($item2) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fHafif Mermi §ayaptın.");
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(332,0,5)->setCustomName("§3Hafif Mermi"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 4:
				$item = Item::get(370,0,1)->setCustomName("§6Kovan");
				$item2 = Item::get(289,0,1)->setCustomName("§6Mega Barut");
				if($player->getInventory()->contains($item2) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fAğır Mermi §ayaptın.");
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(344,0,5)->setCustomName("§3Ağır Mermi"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 5:
				$item = Item::get(280,0,1);
				$item2 = Item::get(265,0,2);
				if($player->getInventory()->contains($item2) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fBıçak §ayaptın.");
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(268,0,1)->setCustomName("§6Bıçak"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 6:
				$item = Item::get(289,0,2)->setCustomName("§6Mega Barut");
				$item2 = Item::get(264,0,2);
				if($player->getInventory()->contains($item2) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fMayın §ayaptın.");
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(151,0,1)->setCustomName("§cMayın"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 7:
				$this->craftMenu($player);
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Silah Menüsü §7§l-");
		$form->addButton("Kovan\n§cAltın Parçası x1, Demir Parçası x1", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/8/8f/Ghast_Tear.png?version=0f0756ac67481c21e2907420ae65e3dd");
		$form->addButton("Süper Barut\n§cAltın x2, Barut x1", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/ae/Gunpowder.png?version=4b04564cfef3024ca84ea26e55b1b228");
		$form->addButton("Mega Barut\n§cZümrüt x2, Süper Barut x1", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/ae/Gunpowder.png?version=4b04564cfef3024ca84ea26e55b1b228");
		$form->addButton("Hafif Mermi\n§cKovan x1, Süper Barut x1");
		$form->addButton("Ağır Mermi\n§cKovan x1, Mega Barut x1");
		$form->addButton("Bıçak\n§cDemir x2, Çubuk x1", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/e/e1/Sword_stone_TextureUpdate.png?version=47182187929572291fb364555494a3db");
		$form->addButton("Mayın\n§cMega Barut x2, Elmas x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/49/Daylight_Detector.png?version=03c6373e78ce98e5c9ecfcf263872c43");
	  $form->addButton("§cGeri");
		$form->sendToPlayer($player);
	}

	public function blokForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getName();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(12,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 1:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(45,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 2:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(47,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 3:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(48,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 4:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(49,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 5:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(89,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 6:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(98,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 7:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(165,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 8:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(138,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 9:
				$item = Item::get(175,0,1)->setCustomName("§cBlok Jetonu");
				if($player->getInventory()->contains($item)){
					$player->getInventory()->addItem(Item::get(24,0,32));
					$player->getInventory()->removeItem($item);
					$player->sendMessage("§8» §aBaşarı ile blok aldın.");
				}
				break;
				case 10:
				$this->blokForm($player);
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Blok Menüsü §7§l-");
		$form->addButton("Kum\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/a7/Sand.png?version=e76737bd09bc2f930377f21116fbdf43");
		$form->addButton("Tuğla\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/f/ff/Bricks.png?version=0c3b0cad3df6cfd3f5361f08499157b1");
		$form->addButton("Kitaplık\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/f/f7/Bookshelf.png?version=4bf8261e0149c14e1356f9fb33df234d");
		$form->addButton("Yosunlu Taş\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/af/Mossy_Cobblestone.png?version=1df033358e2131797a099c727685c252");
		$form->addButton("Obsidyen\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/2/23/Obsidian.png?version=795566e577f7fabc9992b1a2c70254f9");
		$form->addButton("Işık Taşı\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/91/Glowstone.png?version=cdfd2b1818f062126c22490a027612c8");
		$form->addButton("Taş Tuğla\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/0/01/Stone_Bricks.png?version=abd1d0d959bb38a46f1854707c9a287d");
		$form->addButton("Balkıç Bloğu\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/7/72/Slime_Block.png?version=d662b93911b6c09db7c70a490f57aebb");
		$form->addButton("Fener\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/b/b3/Beacon.png?version=c71f9759da59805d0f86f056c1a4dab4");
		$form->addButton("Kum Taşı\n§cBlok Jetonu", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/d/d6/Sandstone.png?version=adf211a714034bc603270e8c6d10ae49");
		$form->addButton("§cGeri");
		$form->sendToPlayer($player);
	}

	public function saglikForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getInventory();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$item = Item::get(334,0,2);
				$item2 = Item::get(265,0,1);
				if($player->getInventory()->contains($item2) && $player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fBandaj §ayaptın.");
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(339,0,1)->setCustomName("§1Bandaj"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 1:
				$item = Item::get(339,0,3)->setCustomName("§1Bandaj");
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fSağlık Çantası §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(281,0,1)->setCustomName("§1Sağlık Çantası"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 2:
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Sağlık Menüsü §7§l-");
		$form->addButton("Bandaj\n§cDeri x2, Demir x1", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/b/b2/Paper.png?version=b6fe2887d93b137423a85608dcc5a96e");
		$form->addButton("Sağlık Çantası\n§cBandaj x3", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/0/0e/Golden_Apple.png?version=b11b1f51abfe0ac4196497ff67e141db");
		$form->addButton("§cGeri");
		$form->sendToPlayer($player);
	}

	public function zirhForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getName();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$item = Item::get(334,0,5);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fAskeri Kask §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(298,0,1)->setCustomName("§4Askeri Kask"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 1:
				$item = Item::get(334,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fAskeri Üst §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(299,0,1)->setCustomName("§4Askeri Üst"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 2:
				$item = Item::get(334,0,7);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fAskeri Pantalon §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(300,0,1)->setCustomName("§4Askeri Pantalon"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 3:
				$item = Item::get(334,0,4);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fAskeri Bot §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(301,0,1)->setCustomName("§4Askeri Bot"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 4:
				$item = Item::get(266,0,5);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKamuflaj Kask §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(314,0,1)->setCustomName("§4Kamuflaj Kask"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 5:
				$item = Item::get(266,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKamuflaj Üst §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(315,0,1)->setCustomName("§4Kamuflaj Üst"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 6:
				$item = Item::get(266,0,7);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKamuflaj Pantalon §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(316,0,1)->setCustomName("§4Kamuflaj Pantalon"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 7:
				$item = Item::get(266,0,4);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKamuflaj Bot §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(317,0,1)->setCustomName("§4Kamuflaj Bot"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 8:
				$item = Item::get(265,0,5);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fRadyasyon Kask §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(306,0,1)->setCustomName("§4Radyasyon Kask"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 9:
				$item = Item::get(265,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fRadyasyon Üst §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(307,0,1)->setCustomName("§4Radyasyon Üst"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 10:
				$item = Item::get(265,0,7);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fRadyasyon Pantalon §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(308,0,1)->setCustomName("§4Radyasyon Pantalon"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 11:
				$item = Item::get(265,0,4);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fRadyasyon Bot §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(309,0,1)->setCustomName("§4Radyasyon Bot"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 12:
				$item = Item::get(264,0,5);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fTaktik Kask §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(310,0,1)->setCustomName("§4Taktik Kask"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 13:
				$item = Item::get(264,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fTaktik Üst §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(311,0,1)->setCustomName("§4Taktik Üst"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 14:
				$item = Item::get(264,0,7);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fTaktik Pantalon §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(312,0,1)->setCustomName("§4Taktik Pantalon"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 15:
				$item = Item::get(264,0,4);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fTaktik Bot §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(313,0,1)->setCustomName("§4Taktik Bot"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 6:
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Zırh Menüsü §7§l-");
		$form->addButton("Askeri Kask\n§cDeri 5x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/b/b5/Leather_Cap.png?version=02d3af274984e6bade47f5b135b2c637");
		$form->addButton("Askeri Üst\n§cDeri 8x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/96/Leather_Tunic.png?version=1f5e014480a2fd2523eeb9f7839975aa");
		$form->addButton("Askeri Pantalon\n§cDeri 7x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/2/28/Leather_Pants.png?version=8ce9da42391be74769da11174d1f7853");
		$form->addButton("Askeri Bot\n§cDeri 4x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/f/fd/Leather_Boots.png?version=420f8ee0338f5665628363218c5659d2");
		$form->addButton("Kamuflaj Kask\n§cAltın 5x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/c/c6/Golden_Helmet.png?version=c608c95421103de929ea974d933cda0b");
		$form->addButton("Kamuflaj Üst\n§cAltın 8x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/7/76/Golden_Chestplate.png?version=f7e6e64ceb8d7d97db664866ce8a36d5");
		$form->addButton("Kamuflaj Pantalon\n§cAltın 7x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/0/0a/Golden_Leggings.png?version=563a17fdfd481ac3320414738362c8f6");
		$form->addButton("Kamuflaj Bot\n§cAltın 4x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/6/61/Golden_Boots.png?version=d8e21b9cfe0e89942d494d021dc2a183");
		$form->addButton("Radyasyon Kask\n§cDemir 5x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/f/f7/Iron_Helmet.png?version=3893c0e604e6d13cdfc74ba79474ab67");
		$form->addButton("Radyasyon Üst\n§cDemir 8x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/43/Iron_Chestplate.png?version=94bb50c438d5b472f0810dfa37e7ff33");
		$form->addButton("Radyasyon Pantalon\n§cDemir 7x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/5/54/Iron_Leggings.png?version=f2e9509f3e0a1eeb1baf6eccff34c50d");
		$form->addButton("Radyasyon\n§cDemir 4x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/c/c0/Iron_Boots.png?version=f1d2d2cab644e3c43dbe916d48474ed0");
		$form->addButton("Taktik Kask\n§cElmas 5x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/1/1d/Diamond_Helmet.png?version=a01e44778bd4ef84dff396e00136b579");
		$form->addButton("Taktik Üst\n§cElmas 8x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/92/Diamond_Chestplate.png?version=3ed39b27647474216a96e27a25a3edb8");
		$form->addButton("Taktik Pantalon\n§cElmas 7x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/1/12/Diamond_Leggings.png?version=0f41fbb5755b760c8828817f660bac14");
		$form->addButton("Taktik Bot\n§cElmas 4x", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/0/0b/Diamond_Boots.png?version=ef2c8647b87d7cd04a21f00a258bee2f");
		$form->addButton("§cGeri");
		$form->sendToPlayer($player);
	}

	public function esyaForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getName();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$item = Item::get(280,0,2);
				$item2 = Item::get(5,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTahta Balta §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(271,0,1)->setCustomName("§4Tahta Balta"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 1:
				$item = Item::get(280,0,2);
				$item2 = Item::get(5,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTahta Kazma §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(270,0,1)->setCustomName("§4Tahta Kazma"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 2:
				$item = Item::get(280,0,2);
				$item2 = Item::get(5,0,1);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTahta Kürek §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(269,0,1)->setCustomName("§4Tahta Kürek"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 3:
				$item = Item::get(280,0,2);
				$item2 = Item::get(4,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTaş Balta §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(275,0,1)->setCustomName("§4Taş Balta"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 4:
				$item = Item::get(280,0,2);
				$item2 = Item::get(4,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTaş Kazma §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(274,0,1)->setCustomName("§4Taş Kazma"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 5:
				$item = Item::get(280,0,2);
				$item2 = Item::get(4,0,1);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTaş Kürek §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(273,0,1)->setCustomName("§4Taş Kürek"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 6:
				$item = Item::get(280,0,2);
				$item2 = Item::get(266,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fAltın Balta §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(286,0,1)->setCustomName("§4Altın Balta"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 7:
				$item = Item::get(280,0,2);
				$item2 = Item::get(266,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fAltın Kazma §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(285,0,1)->setCustomName("§4Altın Kazma"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 8:
				$item = Item::get(280,0,2);
				$item2 = Item::get(266,0,1);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fAltın Kürek §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(284,0,1)->setCustomName("§4Altın Kürek"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 9:
				$item = Item::get(280,0,2);
				$item2 = Item::get(265,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fDemir Balta §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(258,0,1)->setCustomName("§4Demir Balta"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 10:
				$item = Item::get(280,0,2);
				$item2 = Item::get(265,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fDemir Kazma §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(257,0,1)->setCustomName("§4Demir Kazma"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 11:
				$item = Item::get(280,0,2);
				$item2 = Item::get(265,0,1);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fDemir Kürek §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(256,0,1)->setCustomName("§4Demir Kürek"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 12:
				$item = Item::get(280,0,2);
				$item2 = Item::get(264,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fElmas Balta §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(279,0,1)->setCustomName("§4Elmas Balta"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 13:
				$item = Item::get(280,0,2);
				$item2 = Item::get(264,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fElmas Kazma §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(278,0,1)->setCustomName("§4Elmas Kazma"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 14:
				$item = Item::get(280,0,2);
				$item2 = Item::get(264,0,1);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fElmas Kürek §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(277,0,1)->setCustomName("§4Elmas Kürek"));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 15:
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Eşya Menüsü §7§l-");
		$form->addButton("Tahta Balta\n§cOdun x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/3/30/Wooden_Axe_TextureUpdate.png?version=1e292de71fb455ed8a04e2a89410b504");
		$form->addButton("Tahta Kazma\n§cOdun x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/b/b3/Wooden_Pickaxe.png?version=af6de99e035bda3aa40f14e3e9a43f73");
		$form->addButton("Tahta Kürek\n§cOdun x1, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/a4/Wooden_Shovel.png?version=fbda38f9a463c34300d55939cf51e577");
		$form->addButton("Taş Balta\n§cTaş x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/93/Stone_Axe_TextureUpdate.png?version=1767aab6a1262b39e14bba9d4c418a64");
		$form->addButton("Taş Kazma\n§cTaş x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/40/Stone_Pickaxe.png?version=55a7194979a8aa24f97a8980f5e99b1d");
		$form->addButton("Taş Kürek\n§cTaş x1, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/1/15/Shovel_stone_TextureUpdate.png?version=67f77a0f0de1f98dfc35803512b1fa58");
		$form->addButton("Altın Balta\n§cAltın x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/0/0c/Golden_Axe_TextureUpdate.png?version=f2269a61d7fda3428111ec70106e50d7");
		$form->addButton("Altın Kazma\n§cAltın x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/95/Golden_Pickaxe.png?version=8847672873006d2acfaa72bbb413fd15");
		$form->addButton("Altın Kürek\n§cAltın x1, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/c/ce/Golden_Shovel.png?version=f4e8f9749efff816d69861072aac2dd0");
		$form->addButton("Demir Balta\n§cDemir x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/44/Iron_Axe_TextureUpdate.png?version=f9b6ccbdcb6a224fd5bfd9c9d06b909e");
		$form->addButton("Demir Kazma\n§cDemir x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/a/a2/Iron_Pickaxe.png?version=ae92833449bb8b5f8e3252a3bf7d6bd5");
		$form->addButton("Demir Kürek\n§cDemir x1, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/9/9a/Shovel_iron_TextureUpdate.png?version=d0897118a37f3f2dcd4f6014e110a068");
		$form->addButton("Elmas Balta\n§cElmas x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/d/de/Diamond_Axe_TextureUpdate.png?version=b911e7311144122acce9ad10c3fe9420");
		$form->addButton("Elmas Kazma\n§cElmas x3, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/5/54/Diamond_Pickaxe.png?version=4e1d2e14abaec802eca3a9cc21e40a4d");
		$form->addButton("Elmas Kürek\n§cElmas x1, Çubuk x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/b/bb/Shovel_diamond_TextureUpdate.png?version=73fe766f729fbedb95cbcd9f7526582f");
		$form->addButton("§cÇıkış");
		$form->sendToPlayer($player);
	}

	public function aracForm($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getName();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$item = Item::get(4,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fFırın §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(61,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 1:
				$item = Item::get(5,0,8);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fSandık §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(54,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 2:
				$item = Item::get(54,0,1);
				$item2 = Item::get(265,0,5);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fHopper §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(410,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 3:
				$item = Item::get(5,0,6);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKapı §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(64,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 4:
				$item = Item::get(265,0,6);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fDemir Kapı §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(71,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 5:
				$item = Item::get(49,0,4);
				$item2 = Item::get(264,0,2);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fBüyü Masası §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(116,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 6:
				$item = Item::get(265,0,3);
				if($player->getInventory()->contains($item)){
					$player->sendMessage("§8» §aBaşarı ile §fKova §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->addItem(Item::get(325,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 7:
				$item = Item::get(280,0,1);
				$item2 = Item::get(5,0,3);
				if($player->getInventory()->contains($item) && $player->getInventory()->contains($item2)){
					$player->sendMessage("§8» §aBaşarı ile §fTabela §ayaptın.");
					$player->getInventory()->removeItem($item);
					$player->getInventory()->removeItem($item2);
					$player->getInventory()->addItem(Item::get(63,0,1));
				}else{
					$player->sendMessage("§8» §cYeterli eşyan bulunmuyor.");
				}
				break;
				case 8:
				$this->craftMenu($player);
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Araçlar Menüsü §7§l-");
		$form->addButton("Fırın\n§cTaş x8", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/1/1a/Furnace_TextureUpdate.png?version=0c11f77d044ff85c20d5b745ac06812c");
		$form->addButton("Sandık\n§cTahta x8", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/41/Chest.gif?version=61d40a22f882a9ff109bd3d80c3cc285");
		$form->addButton("Hopper\n§cSandık x1, Demir x5", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/8/81/Hopper.png?version=83aa9314e02d4c7fbc5a0c63e0ec168c");
		$form->addButton("Tahta Kapı\n§cTahta x6", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/4/41/Oak_Door.png?version=abd1c15fdb09bf9748302aed90233beb");
	  $form->addButton("Demir Kapı\n§cDemir x6", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/1/11/Iron_Door.png?version=90f2ade6de86f68e42b07525fa667df4");
		$form->addButton("Büyü Masası\n§cObsidyen x4, Elmas x2", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/e/e1/Enchanting_Table.png?version=66c4d64869c2b8ce99c6dfdb36f974ba");
		$form->addButton("Kova\n§cDemir x3", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/5/52/Bucket.png?version=ed6c0f9cd0064825d42ee1cd9dbc0b78");
		$form->addButton("Tabela\n§cÇubuk x1, Odun x3", 1, "https://gamepedia.cursecdn.com/minecraft_gamepedia/5/58/Oak_Standing_Sign.png?version=047bbc350d5bc7c8881085dcda8dd79b");
		$form->addButton("§cGeri");
		$form->sendToPlayer($player);
	}

	public function craftMenu($player){
		$form = new SimpleForm(function (Player $event, $data){
			$player = $event->getPlayer();
			$oyuncu = $player->getName();

			if($data === null){
				return;
			}
			switch($data){
				case 0:
				$this->blokForm($player);
				break;
				case 1:
				$this->silahForm($player);
				break;
				case 2:
				$this->saglikForm($player);
				break;
				case 3:
				$this->zirhForm($player);
				break;
				case 4:
				$this->esyaForm($player);
				break;
				case 5:
				$this->aracForm($player);
				break;
			}
		});
		$form->setTitle("§l§7- §r§8Craft Menüsü §7§l-");
		$form->addButton("Blok");
		$form->addButton("Silah");
		$form->addButton("Sağlık");
		$form->addButton("Zırh");
		$form->addButton("Eşya");
		$form->addButton("Araçlar");
		$form->sendToPlayer($player);
	}
}
