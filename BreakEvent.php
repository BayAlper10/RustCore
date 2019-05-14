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
use pocketmine\{Player, Server};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\level\Level;
use Rust\Main;

class BreakEvent implements Listener{

  public function __construct(Main $plugin){
    $this->p = $plugin;
  }

/*  public function onMove(PlayerMoveEvent $e){
    $player = $e->getPlayer();
    $blok = $e->getBlock();
    if($blok->getId() == 1){//209
      $rand = mt_rand(1,50);
      switch($rand){
        case 1:
        $x = -536;
        $y = 76;
        $z = 418;
        $dunyaismi = "world";
        $level = $this->p->getServer()->getLevelManager()->getLevelByName($dunyaismi);
        $this->p->getServer()->getLevelManager()->loadLevel($dunyaismi);
        $player->teleport(new Position($x, $y, $z, $level));
        break;
      }
    }
  }*/

  public function esyaDusurme(BlockBreakEvent $e){
    $player = $e->getPlayer();
    $block = $e->getBlock();
    $d = $e->getPlayer()->getLevel()->getFolderName();
    $dunya = $this->p->getServer()->getLevelByName($d);
    $x = $e->getBlock()->getX();
    $y = $e->getBlock()->getY();
    $z = $e->getBlock()->getZ();

    if($block->getId() == 146){
      $e->setCancelled(true);
    }
    if($block->getId() == 1 or $block->getId() == 17){
      $taglar = $this->p->tags->getNested(strtolower($player->getName()).".tag");
      if($taglar == "default"){
        $rand = mt_rand(1,750);
        switch($rand){
          case 1:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(370)->setCustomName("§6Kovan"));
          $player->addTitle("§eKovan buldun");
          break;
          case 2:
          break;
          case 3:
          break;
          case 4:
          break;
          case 5:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Süper Barut"));
          $player->addTitle("§eSüper Barut buldun");
          break;
          case 6:
          break;
          case 7:
          break;
          case 8:
          break;
          case 9:
          break;
          case 10:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Mega Barut"));
          $player->addTitle("§eMega Barut buldun");
          break;
          case 11:
          break;
          case 12:
          break;
          case 13:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
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
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
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
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(339)->setCustomName("§1Bandaj"));
          $player->addTitle("§eBandaj buldun");
          break;
          case 26:
          break;
          case 27:
          break;
          case 30:
          break;
          case 31:
          break;
          case 32:
          break;
          case 33:
          break;
          case 34:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(281)->setCustomName("§1Sağlık Çantası"));
          $player->addTitle("§eSağlık Çantası buldun");
          break;
          case 35:
          break;
          case 36:
          break;
          case 37:
          break;
          case 38:
          /*$dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aZırh Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 39:
          break;
          case 40:
          break;
          case 41:
          /*$dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aSağlık Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 42:
          break;
          case 43:
          break;
          case 44:
          break;
          case 45:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§eKasa Anahtarı"));
          $player->addTitle("§eAnahtar buldun");
          break;
          case 46:
          break;
          case 47:
          break;
          case 48:
          break;
          case 49:
          break;
          case 50:
          break;
        }
      }
      if($taglar == "vip"){
        $rand = mt_rand(1,300);
        switch($rand){
          case 1:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(370)->setCustomName("§6Kovan"));
          $player->addTitle("§eKovan buldun");
          break;
          case 2:
          break;
          case 3:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(370)->setCustomName("§6Kovan"));
          $player->addTitle("§eKovan buldun");
          break;
          case 4:
          break;
          case 5:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Süper Barut"));
          $player->addTitle("§eSüper Barut buldun");
          break;
          case 6:
          break;
          case 7:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(370)->setCustomName("§6Kovan"));
          $player->addTitle("§eKovan buldun");
          break;
          case 8:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Mega Barut"));
          $player->addTitle("§eMega Barut buldun");
          break;
          case 9:
          break;
          case 10:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Mega Barut"));
          $player->addTitle("§eMega Barut buldun");
          break;
          case 11:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 12:
          break;
          case 13:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 14:
          break;
          case 15:
          break;
          case 16:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Mega Barut"));
          $player->addTitle("§eMega Barut buldun");
          break;
          case 17:
          /*$dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aZırh Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 18:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 19:
          break;
          case 20:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 21:
          break;
          case 22:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 23:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(332)->setCustomName("§3Hafif Mermi"));
          $player->addTitle("§eHafif mermi buldun");
          break;
          case 24:
          break;
          case 25:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(339)->setCustomName("§1Bandaj"));
          $player->addTitle("§eBandaj buldun");
          break;
          case 26:
          break;
          case 27:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(339)->setCustomName("§1Bandaj"));
          $player->addTitle("§eBandaj buldun");
          break;
          case 30:
          /*$dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aZırh Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 31:
          break;
          case 32:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(339)->setCustomName("§1Bandaj"));
          $player->addTitle("§eBandaj buldun");
          break;
          case 33:
          break;
          case 34:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(281)->setCustomName("§1Sağlık Çantası"));
          $player->addTitle("§eSağlık Çantası buldun");
          break;
          case 35:
          break;
          case 36:
          break;
          case 37:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Süper Barut"));
          $player->addTitle("§eSüper Barut buldun");
          break;
          case 38:
          break;
          case 39:
          break;
          case 40:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(289)->setCustomName("§6Süper Barut"));
          $player->addTitle("§eSüper Barut buldun");
          break;
          case 41:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aSağlık Kasası"));
          $player->addTitle("§eAnahtar buldun");
          break;
          case 42:
        /*  $dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aSağlık Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 43:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(281)->setCustomName("§1Sağlık Çantası"));
          $player->addTitle("§eSağlık Çantası buldun");
          break;
          case 44:
          break;
          case 45:
          break;
          case 46:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(281)->setCustomName("§1Sağlık Çantası"));
          $player->addTitle("§eSağlık Çantası buldun");
          break;
          case 47:
          break;
          case 48:
          /*$dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§aSilah Kasası"));
          $player->addTitle("§eAnahtar buldun");*/
          break;
          case 49:
          $dunya->dropItem(new Vector3($x, $y, $z), Item::get(399)->setCustomName("§eKasa Anahtarı"));
          $player->addTitle("§eAnahtar buldun");
          break;
          case 50:
          break;
        }
      }
   }
  }
}
