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

class Friends extends PluginCommand{

  public $oyuncu = array();

  public function __construct($name, Main $plugin){
    $this->p = $plugin;
    parent::__construct($name, $plugin);
    $this->setDescription("Ortak komutlarına bakmanı sağlar");
    $this->setUsage("/arazi");
  }

  public function execute(CommandSender $g, string $label, array $args): bool{
    if(isset($args[0])){
                if($args[0] == "ekle"){
                    if(isset($args[1])){
                        if($args[1] == $g->getName()){
                            return false;
                        }
                        $orr = $this->p->getServer()->getPlayer($args[1]);
                        if($orr instanceof Player){
                            $this->davetYolla($g, $orr);
                        }else{
                            $g->sendMessage("§8» §cOyuncu bulunamadı!");
                        }
                    }else{
                        $g->sendMessage("§8» §cKullanımı: §3/ortak ekle <oyuncu-ismi>");
                    }
                }elseif($args[0] == "cikar"){
                    if(isset($args[1])){
                        $o = $this->p->getServer()->getPlayer($args[1]);
                        if($o instanceof Player or $o instanceof OfflinePlayer){
                            $this->ortakKaldir($o, $g);
                        }
                    }else{
                        $g->sendMessage("§8» §cKullanım: §3/ortak cikar <oyuncu-ismi>");
                    }
                }elseif($args[0] == "isinlan"){
                    if(isset($args[1])){
                        $o = $this->p->getServer()->getPlayer($args[1]);
                        if($o instanceof Player){
                            if($o->getName() != $g->getName()){
                                $this->ortakTP($g, $o);
                            }
                        }else{
                            $g->sendMessage("§8» §cOyuncu bulunamadı!");
                        }
                    }else{
                        $g->sendMessage("§8» §cKullanım: §3/ortak isinlan <oyuncu-ismi>");
                    }
                }elseif($args[0] == "kabul"){
                    $this->davetKabul($g);
                }elseif($args[0] == "red"){
                    $this->davetRed($g);
                }elseif($args[0] == "liste"){
                    $this->ortakListe($g);
                }else{
                    $this->yardim($g);
                }
            }else{
                $this->yardim($g);
            }
    return true;
  }

  public function ortakEkle($or, $ekk){
        $hedef = $this->p->getServer()->getPlayer($or);
        $ek = $this->p->getServer()->getPlayer($ekk);
        if(file_exists($this->p->getDataFolder()."Adalar/".$ek->getName().".yml")){
            if($hedef instanceof Player){
                $ekc = new Config($this->p->getDataFolder()."Adalar/".$ek->getName().".yml", Config::YAML);
                $ekc->reload();
                if(empty($ekc->get("Arkadaslar"))){
                    $ekc->set("Arkadaslar", array($hedef->getName()));
                    $ekc->save();
                    $ek->sendMessage("§8[§6Ortak§8] §e".$hedef->getName()." §aadlı oyuncu seni ortak olarak ekledi!");
                    $hedef->sendMessage("§8[§6Ortak§8] §e".$ek->getName()." §aadlı oyuncunun isteğini kabul ettin!");
                }else{
                    $orlar = $ekc->get("Arkadaslar");
                    $iy = implode(" ", $orlar);
                    $ekc->set("Arkadaslar", explode(" ", $iy." ".$hedef->getName()));
                    $ekc->save();
                    $ek->sendMessage("§8[§6Ortak§8] §e".$hedef->getName()." §aadlı oyuncu seni ortak olarak ekledi!");
                    $hedef->sendMessage("§8[§6Ortak§8] §e".$ek->getName()." §aadlı oyuncunun isteğini kabul ettin!");
                }
            }else{
                $ek->sendMessage("§8[§6Ortak§8] §coyuncu bulunamadı!");
            }
        }else{
            $ek->sendMessage("§8» §cHenüz bir arazi oluşturmamışsın.");
        }
    }

    public function ortakKaldir($or, $ek){
        if(file_exists($this->p->getDataFolder()."Adalar/".$ek->getName().".yml")){
            $ekc = new Config($this->p->getDataFolder()."Adalar/".$ek->getName().".yml", Config::YAML);
            if($ekc->get("Arkadaslar")){
                $iy = $ekc->get("Arkadaslar");
                if(in_array($or->getName(), $iy)){
                    $deger = array_search($or->getName(), $iy);
                    unset($iy[$deger]);
                    $ekc->set("Arkadaslar", $iy);
                    $ekc->save();
                    $ek->sendMessage("§8[§6Ortak§8] §e".$or->getName()."§coyuncusu ortaklıktan çıkarıldı!");
                    if($or instanceof Player){
                        $or->sendMessage("§8[§6Ortak§8] §e".$ek->getName()." §cadlı oyuncu seni ortaklıktan çıkardı!");
                    }
                }else{
                    $ek->sendMessage("§8[§6Ortak§8] §e".$or->getName()." §cadında ortağın yok!");
                }
            }else{
                $ek->sendMessage("§8[§6Ortak§8] §chiç ortağın yok!");
            }
        }else{
            $ek->sendMessage("§8» §cHenüz bir arazi oluşturmamışsın.");
        }
    }

    public function davetYolla($g, $o){
            $o->sendMessage("§8[§6Ortak§8] §e".$g->getName()." §aadlı oyuncu ortaklık isteği gönderdi!\n§f»§akabul etmek için: §3/ortak kabul\n§cReddetmek için: §3/ortak red");
            $g->sendMessage("§8[§6Ortak§8] §e".$o->getName()."§a adlı oyuncuya ortaklık isteği gönderildi!");
            $this->oyuncu[$o->getName()] = $g->getName();
    }

    public function davetKabul($g){
        $hedef = $this->oyuncu[$g->getName()];
        if($hedef){
            $this->ortakEkle($g->getName(), $hedef);
            unset($this->oyuncu[$g->getName()]);
        }else{
            $g->sendMessage("§8[§6Ortak§8] §cşuan bir istek yok!");
        }
    }

    public function davetRed($g){
        $hedef = $this->oyuncu[$g->getName()];
        $h = $this->p->getServer()->getPlayer($hedef);
        if($hedef){
            unset($this->oyuncu[$g->getName()]);
            $h->sendMessage("§8[§6Ortak§8] §e".$g->getName()." §cadlı oyuncu ortaklık teklifini reddetti.");
        }else{
            $g->sendMessage("§8[§6Ortak§8] §cşuan bir istek yok!");
        }
    }

    public function ortakTp($g, $o){
        if(file_exists($this->p->getDataFolder()."Adalar/".$o->getName().".yml")){
            $ac = new Config($this->p->getDataFolder()."Adalar/".$o->getName().".yml", Config::YAML);
            $ac->reload();
            if($ac->get("Arkadaslar")){
                $ortaklar = $ac->get("Arkadaslar");
                if(in_array($g->getName(), $ortaklar)){
                    $this->p->getServer()->loadLevel($ac->get("Dunya"));
                    $level = $this->p->getServer()->getLevelByName($o->getName());
                    $isinla = new Position($level->getSafeSpawn()->getX(), $level->getSafeSpawn()->getFloorY(), $level->getSafeSpawn()->getZ(), $level);;
                    $g->teleport($isinla,0,0);
                    $g->sendMessage("§8» §e".$o->getName()." §aadlı oyuncunun arazisine ışınlandınız!");
                }else{
                    $g->sendMessage("§8[§6Ortak§8] §e".$o->getName()." §cadlı oyuncu sebi ortak olarak eklememiş!");
                }
            }
        }else{
            $g->sendMessage("§8» §cOrtağın arazisini silmiş!");
        }
    }

    public function ortakListe($g){
        if(file_exists($this->p->getDataFolder()."Adalar/".$g->getName().".yml")){
            $oc = new Config($this->p->getDataFolder()."Adalar/".$g->getName().".yml", Config::YAML);
            $orll = $oc->get("Arkadaslar");
            if($orll){
                $orrr = null;
                foreach($orll as $orl){
                    $orrr .= "\n§f»§6 $orl";
                }
                $g->sendMessage("§8» §eOrtakların $orrr");
            }else{
                $g->sendMessage("§8[§6Ortak§8] §cHiç Ortağın Yok!");
            }
        }else{
            $g->sendMessage("§8» §cHenüz bir arazi oluşturmamışsın.");
        }
    }

  public function yardim($g){
    $g->sendMessage("§8=====§6Mine§7Fox §aOrtak§8=====");
    $g->sendMessage("§b/ortak ekle §eOrtak eklemeni sağlar");
    $g->sendMessage("§b/ortak cikar §eOrtak çıkarmanı sağlar");
    $g->sendMessage("§b/ortak kabul §eİsteği kabul eder");
    $g->sendMessage("§b/ortak red  §eİsteği reddeder");
    $g->sendMessage("§b/ortak liste  §eOrtaklarına bakmanı sağlar");
  }
}
