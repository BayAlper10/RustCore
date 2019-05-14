<?php

namespace Rust\task;

use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\level\particle\FloatingTextParticle;

use Rust\Main;

class ParticleSpawn extends Task{

	public function __construct(Main $plugin){
		$this->p = $plugin;
		$this->text = new FloatingTextParticle(new Vector3(317, 34, 171), "", "§e");
    $this->asagi = new FloatingTextParticle(new Vector3(317, 33, 188), "", "§e");
    $this->silahlar = new FloatingTextParticle(new Vector3(317, 28, 200), "", "§e");
    $this->zirhlar = new FloatingTextParticle(new Vector3(344, 28, 190), "", "§e");
    $this->vip = new FloatingTextParticle(new Vector3(302, 29, 187), "", "§e");
    //$this->eko = new FloatingTextParticle(new Vector3(15, 96, 25), "", "§e");
		$this->cete = new FloatingTextParticle(new Vector3(326, 34, 162), "", "§e");
	}

	public function onRun($tick){
		$level = $this->p->getServer()->getDefaultLevel();
		$x = $level->getSafeSpawn()->getX();
		$y = $level->getSafeSpawn()->getY()+1.3;
		$z = $level->getSafeSpawn()->getZ();
		$konum = new Vector3($x, $y, $z);
		$efekt = new HeartParticle($konum, 205, 127, 50);
		$ses = new BlazeShootSound($konum);
		//$level->addParticle($efekt);
		//$level->addSound($ses);

		$this->text->setText("§l§6Mine§7Fox §aNetwork'e Hoşgeldin!\n§cTürkiyenin İlk Ve Tek Rust Sunucusu\n§6BETA");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->text);

    $this->asagi->setText("§l§aAksiyon Dolu Bir Maceranın Başlamasını İstiyorsan\n§6ÇİMEN BLOĞA TIKLA");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->asagi);

    $this->silahlar->setText("§l§6Silahlar Hakkında\n§eSilahlar craft edilemez.\n§eMarket aracılığı ile satın alınabilir.\n§eMermiler craft edilebilir veya satın alınabilir.\n§eKafadan daha fazla hasar verirler.\n§eSitemizde tekli paketler halinde satılmaktadır.");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->silahlar);

    $this->zirhlar->setText("§l§7Zırhlar Hakkında\n§eZırhlar craft edilebilir.\n§eMarket aracılığı ile satın alınabilir.\n§eRadyasyon zırhı radyasyonu engeller.\n§eTamir edilebilirler.");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->zirhlar);

    $this->vip->setText("§l§6Mine§7Fox §cVIP\n§b/yemek §ekomutu ile açlık doldurma\n§b+4 §eekstra can\n§eSilah Paketi(AK47, ROKET)\n§b3 §eroket mermisi\n§eVIP §etagı\n§eSohbete beyaz ve italik yazma\n§eDolu olan sunucuya girebilme\n§e2000 oyun parası\n§eOyuncunun konumunu gösterme(günlük)\n§eVIP kiti alabilme\n§11 AY - 15TL");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->vip);

		$this->cete->setText("§l§6Mine§7Fox §cArazi Komutları\n§b/arazi olustur §eArazi oluşturmanı sağlar\n§b/arazi isinlan §eArazine ışınlanmanı sağlar\n§b/arazi ziyaret <oyuncu> §eOyuncunun arazisini ziyaret eder\n§b/arazi ziyaret §eArazinizi ziyarete açıp kapatır\n§b/ortak ekle §eOrtak eklemeni sağlar\n§b/ortak cikar §eOrtak çıkarmanı sağlar\n§b/ortak kabul §eİsteği kabul eder\n§b/ortak red  §eİsteği reddeder\n§b/ortak liste  §eOrtaklarına bakmanı sağlar");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->cete);

    /*$this->eko->setText("§l§6Mine§7Fox §cEkonomi\n§b/param §eParana bakmanı sağlar.\n§b/paragonder {isim} {miktar} §eOyuncuya para gönderir.");
		$level = $this->p->getServer()->getLevelByName("world");
		if($level) $level->addParticle($this->eko);*/
	}
}
