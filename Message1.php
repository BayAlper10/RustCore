<?php

namespace Rust\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class Message1 extends Task{

  public function onRun(int $currentTick){
    foreach (Server::getInstance()->getOnlinePlayers() as $player) {
      $player->sendMessage("§8» §eDetaylı bilgi almak için minefox.net sitesini ziyaret edin.");
    }
  }
}
