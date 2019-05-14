<?php

namespace Rust\commands;

use pocketmine\{Player, Server};
use pocketmine\OfflinePlayer;
use pocketmine\utils\Config;
use pocketmine\utils\Random;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\generator\object\Tree;
use pocketmine\math\Vector3;
use pocketmine\level\generator\Generator;
use pocketmine\block\Cobblestone;
use pocketmine\entity\Entity;
use pocketmine\entity\Creature;
use pocketmine\command\{CommandSender, PluginCommand, ConsoleCommandSender};
use Rust\Main;

class Ada extends PluginCommand{

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Arazi komutlarını kullanmanı sağlar");
    $this->setUsage("/arazi");
  }

  public function execute(CommandSender $cs, string $label, array $args): bool{
    if(isset($args[0])){
      if($args[0] == "yardim"){
        $this->yardim($cs);
      }elseif($args[0] == "olustur"){
        $oada = $this->p->getDataFolder() . "Adalar/" . $cs->getName() . ".yml";
        if(!file_exists($oada)){
          $this->adaOlustur($cs);
        }else{
          $cs->sendMessage("§8» §cZaten bir araziye sahipsin!");
        }
      }elseif($args[0] == "isinlan"){
        $oada = $this->p->getDataFolder() . "Adalar/" . $cs->getName() . ".yml";
          if(file_exists($oada)){
            $this->p->getServer()->loadLevel($cs->getName());
            $dnya = $this->p->getServer()->getLevelByName($cs->getName());
            $spawn = $dnya->getSafeSpawn();
            $cs->teleport($spawn,0,0);
            $cs->teleport(new Vector3($spawn->getX(), $spawn->getY(), $spawn->getZ()));
            $cs->addTitle("§aAraziye Işınlandın!");
          }else{
            $cs->addTitle("§cHenüz Arazin Yok.");
        }
      }elseif($args[0] == "ziyaret"){
        if(isset($args[1])){
          $z = $this->p->getServer()->getPlayer($args[1]);
          if($z instanceof Player){
            $this->ziyaretOyuncu($cs, $z);
          }
        }else{
          $this->ziyaret($cs);
        }
      }else{
        $this->yardim($cs);
      }
    }else{
      $this->yardim($cs);
    }
    return true;
  }

  public function adaTekmele($cs, $he){
        if(file_exists($this->p->getDataFolder()."Adalar/".$cs->getName().".yml")){
            $this->p->getServer()->loadLevel($cs->getName());
            $lv = $this->p->getServer()->getLevelByName($cs->getName());
            if($he == "herkes"){
                $cs->sendMessage("HATA");
            }else{
                $h = $this->p->getServer()->getPlayer($he);
                if($h instanceof Player){
                    if($h->getName() != $cs->getName()){
                        if($h->getLevel()->getName() == $cs->getName()){
                            $h->teleport($this->p->getServer()->getDefaultLevel()->getSafeSpawn(),0,0);
                            $h->sendMessage("§8» §e".$cs->getName()." §cadlı oyuncu sizi arazisinden kovdu!");
                        }else{
                            $cs->sendMessage("§8» §e".$h->getName()." §cadlı oyuncu şuan arazisinde değil!");
                        }
                    }else{
                        $cs->sendMessage("§8» §cKendini arazinden atamazsın!");
                    }
                }
            }
        }else{
            $cs->sendMessage("§8» §cHenüz bir arazin yok!");
        }
    }

  public function ziyaret($cs){
        if(file_exists($this->p->getDataFolder()."Adalar/".$cs->getName().".yml")){
            $gc = new Config($this->p->getDataFolder()."Adalar/".$cs->getName().".yml", Config::YAML);
            if($gc->get("Ziyaret") == "kapali"){
                $gc->set("Ziyaret", "acik");
                $gc->save();
                $cs->sendMessage("§8» §bArtık arazine gelebilirler.");
            }else{
                $gc->set("Ziyaret", "kapali");
                $gc->save();
                $cs->sendMessage("§8» §cArtık arazine gelemezler!");
            }
        }else{
            $cs->sendMessage("§8» §cArazin olmadan kimse arazine gelemez.");
        }
    }

  public function ziyaretOyuncu($cs, $z){
        if (file_exists($this->p->getDataFolder() . "Adalar/" . $z->getName() . ".yml")) {
            $zc = new Config($this->p->getDataFolder() . "Adalar/" . $z->getName() . ".yml", Config::YAML);
            if ($zc->get("Ziyaret") != "kapali") {
                $this->p->getServer()->loadLevel($zc->get("Dunya"));
                $cs->teleport($this->p->getServer()->getLevelByName($zc->get("Dunya"))->getSafeSpawn(), 0, 0);
                $cs->sendMessage("§8» §cBir araziye ışınlanıyorsun!");
                $cs->sendMessage("§8» §e" . $cs->getName() . "§a arazine geldi!");
            } else {
                $cs->sendMessage("§8» §cBu oyuncunun arazisi ziyarete kapalı!");
            }
        } else {
            $cs->sendMessage("§8» §e" . $z->getName() . " §cadlı oyuncunun arazisi yok!");
        }
    }

  public function dosyaKopyala($cs){
        $sd = $this->p->getServer()->getDataPath();
        @mkdir($sd."worlds/".$cs->getName()."/");
        @mkdir($sd."worlds/".$cs->getName()."/region/");
        $dunya = opendir($this->p->getServer()->getDataPath()."SB/region/");
        while($dosya = readdir($dunya)){
            if($dosya != "." and $dosya != ".."){
                copy($sd."SB/region/".$dosya, $sd."worlds/".$cs->getName()."/region/".$dosya);
            }
        }

        copy($sd."SB/level.dat", $sd."worlds/".$cs->getName()."/level.dat");
        $this->p->getServer()->dispatchCommand(new ConsoleCommandSender, "lvdat ".$cs->getName()." fixname");
    }

  public function adaOlustur($cs){
    $cs->sendMessage("§8» §cArazin oluşturulmaya başlandı lütfen oyundan ayrılma!");
    $oada = new Config($this->p->getDataFolder() . "Adalar/" . $cs->getName() . ".yml", Config::YAML);
    $oada->set("X", 130);
    $oada->set("Y", 50);
    $oada->set("Z", 128);
    $oada->set("Dunya", $cs->getName());
    $oada->set("Ziyaret", "acik");
    $oada->save();
    $this->dosyaKopyala($cs);
    $this->p->getServer()->loadLevel($cs->getName());
    $saa = $this->p->getServer()->getLevelByName($cs->getName());
    $cs->teleport($saa->getSafeSpawn(), 0, 0);
    $cs->sendMessage("§8» §aArazin başarı ile oluşturuldu!");
  }

  public function yardim($cs){
    $cs->sendMessage("§8=====§6Mine§7Fox §aArazi§8=====");
    $cs->sendMessage("§b/arazi olustur §eArazi oluşturmanı sağlar");
    $cs->sendMessage("§b/arazi isinlan §eArazine ışınlanmanı sağlar");
    $cs->sendMessage("§b/arazi ziyaret <oyuncu> §eOyuncunun arazisini ziyaret eder");
    $cs->sendMessage("§b/arazi ziyaret  §eZiyaret aç kapat");

  }
}
