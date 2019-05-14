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
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\block\Block;

class Sell extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Envanterinizdeki tüm eşyaları satmanızı sağlar.");
    $this->setUsage("/sat");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    $items = $cs->getInventory()->getContents();
    foreach($items as $item){
      if($this->p->sell->get($item->getId()) !== null && $this->p->sell->get($item->getId()) * $item->getCount()){
        $price = $this->p->sell->get($item->getId()) * $item->getCount();
        $parasi = $this->p->money->getNested(strtolower($cs->getName()).".money");
        $this->p->money->setNested(strtolower($cs->getName()).".money", $parasi + $price);
        $this->p->money->save();
        $cs->sendMessage("§aEşyalarını başarıyla §c$price §aTL'ye sattın.");
        $cs->getInventory()->removeItem($item);
      }
    }
    return true;
  }
}
