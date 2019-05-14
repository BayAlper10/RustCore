<?php

namespace Rust;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\level\Position;

class Ortak implements Listener{

  public function __construct(Main $plugin){
        $this->p = $plugin;
    }

    public function onBreak(BlockBreakEvent $e){
      $o = $e->getPlayer();
      $ladi = $o->getLevel()->getFolderName();
      $b = $e->getBlock();

      if(file_exists($this->p->getDataFolder() . "Adalar/".$ladi.".yml")){
            if($ladi == $o->getName()){
                $e->setCancelled(false);
            }else{
                $cfg = new Config($this->p->getDataFolder()."Adalar/".$ladi.".yml", Config::YAML);
                $cfg->reload();
                $arkadaslar = $cfg->get("Arkadaslar");
                if(@in_array($o->getName(), $arkadaslar)){
                    $e->setCancelled(false);
                }elseif(!$o->isOp()){
                    $e->setCancelled(true);
                    $o->sendPopup("§8» §bBu arazinin sahibi arkadaşın değil!");
                }
            }
        }else{

        }
    }

    public function onPlace(BlockPlaceEvent $e){
      $o = $e->getPlayer();
        $ladi = $o->getLevel()->getFolderName();
        if(file_exists($this->p->getDataFolder() . "Adalar/".$ladi.".yml")){
            if($ladi == $o->getName()){
                $e->setCancelled(false);
            }else{
                $cfg = new Config($this->p->getDataFolder()."Adalar/".$ladi.".yml", Config::YAML);
                $cfg->reload();
                $arkadaslar = $cfg->get("Arkadaslar");
                if(@in_array($o->getName(), $arkadaslar)){
                    $e->setCancelled(false);
                }elseif(!$o->isOp()){
                    $e->setCancelled(true);
                    $o->sendPopup("§8» §bBu arazinin sahibi arkadaşın değil!");
                }
            }
        }else{

        }
    }

    public function ortakTikla(PlayerInteractEvent $e){
        $o = $e->getPlayer();
        $ladi = $o->getLevel()->getFolderName();
        if(file_exists($this->p->getDataFolder() . "Adalar/".$ladi.".yml")){
            if($ladi == $o->getName()){
                $e->setCancelled(false);
            }else{
                $cfg = new Config($this->p->getDataFolder()."Adalar/".$ladi.".yml", Config::YAML);
                $cfg->reload();
                $arkadaslar = $cfg->get("Arkadaslar");
                if(@in_array($o->getName(), $arkadaslar)){
                    $e->setCancelled(false);
                }elseif(!$o->isOp()){
                    $e->setCancelled(true);
                    $o->sendPopup("§8» §bBu arazinin sahibi arkadaşın değil!");
                }
            }
        }else{

        }
      }

        

    public function pvp(EntityDamageEvent $e){
        if($e instanceof EntityDamageByEntityEvent){
            if($e->getEntity() instanceof Player && $e->getDamager() instanceof Player){
                $g = $e->getEntity();
                $lev = $g->getLevel()->getName();
                if(file_exists($this->p->getDataFolder()."Adalar/$lev.yml")){
                    $e->setCancelled(true);
                }else{}
            }
        }
    }
}
