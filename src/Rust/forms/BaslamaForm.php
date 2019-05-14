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

class BaslamaForm{
    public function baslamaMenu($player){
        $form = new SimpleForm(function (Player $event, $data){
            $player = $event->getPlayer();
            $oyuncu = $player->getName();

            if($data === null){
                return;
            }

            switch($data){
                case 0:
                break;
            }
        });
        $form->setTitle("§l§7- §r§8Yama Notları§7§l-");
        $form->setContent("§eYenilikler\n§8» §7Arazi sistemi eklendi.\n§8» §7Kasa sistemi eklendi.\n§8» §7Sunucu resetleme sistemi eklendi.\n\n§cDüşürülenler\n§8» §7Taştan item düşürme oranları azaltıldı.\n§8» §7Çete sistemi kaldırıldı\n§8» §7Sandık kilitleme sistemi devre dışı bırakıldı.");
        $form->addButton("Çıkış");
        $form->sendToPlayer($player);
    }
}
