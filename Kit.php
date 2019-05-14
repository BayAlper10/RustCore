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

use Rust\Main;
use pocketmine\{Player, Server};
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\utils\Config;

class Kit extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Rütbenize göre kit almanızı sağlar.");
    $this->setUsage("/kit");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $tagsorgu = $this->p->tags->getNested(strtolower($cs->getName()).".tag");
    if($tagsorgu == "default"){
      $bugunn = $this->p->kits->getNested(strtolower($cs->getName())."bugun");
      $bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
      if($bugunn >= $bitiss){
      $bugun = date("d.m.Y");
			$bitis = strtotime("7 days", strtotime($bugun));
			$bitis = date("d.m.Y", $bitis);
			$this->p->kits->setNested(strtolower($cs->getName())."bitis", $bitis);
      $this->p->kits->setNested(strtolower($cs->getName())."bugun", $bugun);
      $this->p->kits->save();
      //$bugunn = $this->p->kits->getNested(strtolower($cs->getName())."bugun");
      //$bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
      //if($bugunn >= $bitiss){
        $cs->sendMessage("§8» §aOyuncu kitini başarı ile aldın.");
        $cs->getInventory()->addItem(Item::get(298,0,1)->setCustomName("§cAskeri Kask"));
        $cs->getInventory()->addItem(Item::get(299,0,1)->setCustomName("§cAskeri Üst"));
        $cs->getInventory()->addItem(Item::get(300,0,1)->setCustomName("§cAskeri Pantalon"));
        $cs->getInventory()->addItem(Item::get(301,0,1)->setCustomName("§cAskeri Bot"));
        $cs->getInventory()->addItem(Item::get(268,0,1)->setCustomName("§6Bıçak"));
        $cs->getInventory()->addItem(Item::get(290,0,1)->setCustomName("§eTabanca"));
        $cs->getInventory()->addItem(Item::get(332,0,10)->setCustomName("§3Hafif Mermi"));
        $cs->getInventory()->addItem(Item::get(260,0,10)->setCustomName("§4Elma"));
        $cs->getInventory()->addItem(Item::get(399,0,1)->setCustomName("§aSilah Kasası"));
        $cs->getInventory()->addItem(Item::get(399,0,1)->setCustomName("§aZırh Kasası"));
        $cs->getInventory()->addItem(Item::get(399,0,1)->setCustomName("§aSağlık Kasası"));
      }else{
        $bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
        $cs->sendMessage("§8» §cBirdahaki kiti §f $bitiss §ctarihinde alabilirsin.");
      }
    }
    if($tagsorgu == "vip"){
      $bugunn = $this->p->kits->getNested(strtolower($cs->getName())."bugun");
      $bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
      if($bugunn >= $bitiss){
      $bugun = date("d.m.Y");
			$bitis = strtotime("7 days", strtotime($bugun));
			$bitis = date("d.m.Y", $bitis);
      $this->p->kits->setNested(strtolower($cs->getName())."bitis", $bitis);
      $this->p->kits->setNested(strtolower($cs->getName())."bugun", $bugun);
      $this->p->kits->save();
      //$bugunn = $this->p->kits->getNested(strtolower($cs->getName())."bugun");
      //$bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
    //if($bugunn >= $bitiss){
        $cs->sendMessage("§8» §aVip kitini başarı ile aldın.");
        $cs->getInventory()->addItem(Item::get(310,0,1)->setCustomName("§cTaktik Kask"));
        $cs->getInventory()->addItem(Item::get(311,0,1)->setCustomName("§cTaktik Üst"));
        $cs->getInventory()->addItem(Item::get(312,0,1)->setCustomName("§cTaktik Pantalon"));
        $cs->getInventory()->addItem(Item::get(313,0,1)->setCustomName("§cTaktik Bot"));
        $cs->getInventory()->addItem(Item::get(268,0,1)->setCustomName("§6Bıçak"));
        $cs->getInventory()->addItem(Item::get(290,0,1)->setCustomName("§eTabanca"));
        $cs->getInventory()->addItem(Item::get(332,0,64)->setCustomName("§3Hafif Mermi"));
        $cs->getInventory()->addItem(Item::get(260,0,10)->setCustomName("§4Elma"));
        $cs->getInventory()->addItem(Item::get(291,0,1)->setCustomName("§ePompalı"));
        $cs->getInventory()->addItem(Item::get(46,0,1)->setCustomName("§cPatlayıcı"));
        $cs->getInventory()->addItem(Item::get(399,0,5)->setCustomName("§aSilah Kasası"));
        $cs->getInventory()->addItem(Item::get(399,0,5)->setCustomName("§aZırh Kasası"));
        $cs->getInventory()->addItem(Item::get(399,0,5)->setCustomName("§aSağlık Kasası"));
      }else{
        $bitiss = $this->p->kits->getNested(strtolower($cs->getName())."bitis");
        $cs->sendMessage("§8» §cBirdahaki kiti §f $bitiss §ctarihinde alabilirsin.");
      }
    }
    return true;
  }
}
