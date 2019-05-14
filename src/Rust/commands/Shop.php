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
//use Rust\forms\ShopForm;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\item\Item;
use pocketmine\block\Block;
use Rust\formapi\SimpleForm;

class Shop extends PluginCommand{

  public function __construct($name, Main $plugin){
		$this->p = $plugin;
		parent::__construct($name, $plugin);
    $this->setDescription("Market");
		$this->setUsage("/market");
	}

  public function getPlugin(): Plugin{
		return $this->p;
	}

  public function execute(CommandSender $cs, string $label, array $args): bool{
      $this->shopForm($cs);
    return true;
  }

  public function yemekMarket($player){
    $form = new SimpleForm(function (Player $event, $data){
      $player = $event->getPlayer();
      $oyuncu = $player->getName();
      if($data === null){
        return;
      }
      switch($data){
        case 0:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 20){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 20);
          $player->getInventory()->addItem(Item::get(364,0,15));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 1:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 18){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 18);
          $player->getInventory()->addItem(Item::get(366,0,15));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 2:
        $this->shopForm($player);
        break;
      }
    });
    $form->setTitle("§l§7- §r§8Özel Market §7§l-");
    $form->addButton("Et\n§c20 TL");
    $form->addButton("Tavuk\n§c18 TL");
    $form->addButton("§cGeri");
    $form->sendToPlayer($player);
  }

  public function shopForm($player){
    $form = new SimpleForm(function (Player $event, $data){
      $player = $event->getPlayer();
      $oyuncu = $player->getName();
      if($data === null){
        return;
      }
      switch($data){
        case 0:
        $this->silahMarket($player);
        break;
        case 1:
        $this->mermiMarket($player);
        break;
        case 2:
        $this->ozelMarket($player);
        break;
        case 3:
        $this->yemekMarket($player);
        break;
      }
    });
    $form->setTitle("§l§7- §r§8Market Menüsü §7§l-");
    $form->addButton("Silahlar");
    $form->addButton("Mermiler");
    $form->addButton("Özel İtemler");
    $form->addButton("Yemek");
    $form->sendToPlayer($player);
  }

  public function ozelMarket($player){
    $form = new SimpleForm(function (Player $event, $data){
      $player = $event->getPlayer();
      $oyuncu = $player->getName();
      if($data === null){
        return;
      }
      switch($data){
        case 0:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 200){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 200);
          $player->getInventory()->addItem(Item::get(103,0,1)->setCustomName("§6Tarım Bloğu"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 1:
        $this->shopForm($player);
        break;
      }
    });
    $form->setTitle("§l§7- §r§8Özel Market §7§l-");
    $form->addButton("Tarım Bloğu\n§c200 TL");
    $form->addButton("§cGeri");
    $form->sendToPlayer($player);
  }

  public function mermiMarket($player){
    $form = new SimpleForm(function (Player $event, $data){
      $player = $event->getPlayer();
      $oyuncu = $player->getName();
      if($data === null){
        return;
      }
      switch($data){
        case 0:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 75){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 75);
          $player->getInventory()->addItem(Item::get(332,0,5)->setCustomName("§3Hafif Mermi"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 1:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 150){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 150);
          $player->getInventory()->addItem(Item::get(344,0,5)->setCustomName("§3Ağır Mermi"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 2:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 500){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 500);
          $player->getInventory()->addItem(Item::get(344,0,5)->setCustomName("§3AK Mermisi"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 3:
        $this->shopForm($player);
        break;
      }
    });
    $form->setTitle("§l§7- §r§8Mermi Market §7§l-");
    $form->addButton("Hafif Mermi\n§c75 TL");
    $form->addButton("Ağır Mermi\n§c150 TL");
    $form->addButton("AK Mermisi\n§c500 TL");
    $form->addButton("§cGeri");
    $form->sendToPlayer($player);
  }

  public function silahMarket($player){
    $form = new SimpleForm(function (Player $event, $data){
      $player = $event->getPlayer();
      $oyuncu = $player->getName();
      if($data === null){
        return;
      }
      switch($data){
        case 0:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 200){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 200);
          $player->getInventory()->addItem(Item::get(290,0,1)->setCustomName("§eTabanca"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 1:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 750){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 750);
          $player->getInventory()->addItem(Item::get(291,0,1)->setCustomName("§ePompalı"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 2:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 1000){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 1000);
          $player->getInventory()->addItem(Item::get(292,0,1)->setCustomName("§eM4A1"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 3:
        $parasi = $this->p->money->getNested(strtolower($player->getName()).".money");
        if($parasi >= 1750){
          $this->p->money->setNested(strtolower($player->getName()).".money", $parasi - 1750);
          $player->getInventory()->addItem(Item::get(293,0,1)->setCustomName("§eAK47"));
          $this->p->money->save();
        }else{
          $player->sendMessage("§cMalesef yeterli paran bulunmuyor.");
        }
        break;
        case 4:
        $this->shopForm($player);
        break;
      }
    });
    $form->setTitle("§l§7- §r§8Silah Market §7§l-");
    $form->addButton("Tabanca\n§c200 TL");
    $form->addButton("Pompalı\n§c750 TL");
    $form->addButton("M4A1\n§c1000 TL");
    $form->addButton("AK47\n§c1750 TL");
    $form->addButton("§cGeri");
    $form->sendToPlayer($player);
  }
}
