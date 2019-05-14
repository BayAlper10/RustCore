<?php

/*
    ____              ___    __               _______
   / __ )____ ___  __/   |  / /___  ___  ____<  / __ \
  / __  / __ `/ / / / /| | / / __ \/ _ \/ ___/ / / / /
 / /_/ / /_/ / /_/ / ___ |/ / /_/ /  __/ /  / / /_/ /
/_____/\__,_/\__, /_/  |_/_/ .___/\___/_/  /_/\____/
            /____/        /_/
*/

namespace Rust;

use pocketmine\plugin\PluginBase;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\level\Position\getLevel;
use pocketmine\level\format\Chunk;
use pocketmine\level\format\FullChunk;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\scheduler\Task;

use Rust\Guns;
use Rust\farm\Farm;
use Rust\task\ParticleSpawn;
use Rust\task\Message1;
//use Rust\task\Message2;
//use Rust\task\Message3;
//use Rust\task\Game;

use Rust\forms\BaslamaForm;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use Rust\events\InteractEvent;
use Rust\events\PlaceEvent;
use Rust\events\JoinEvent;
use Rust\events\ProjectileEvent;
use Rust\events\BreakEvent;

use Rust\commands\CraftCommand;
use Rust\commands\economy\MyMoney;
use Rust\commands\economy\AddMoney;
use Rust\commands\economy\SendMoney;
use Rust\commands\economy\RemoveMoney;
use Rust\commands\epin\CreatePin;
use Rust\commands\epin\UsePin;
use Rust\commands\Fly;
//use Rust\commands\Land;
use Rust\commands\Sell;
use Rust\commands\Kit;
use Rust\commands\Shop;
use Rust\commands\Feed;
use Rust\commands\Coordinat;
use Rust\commands\home\SetHome;
use Rust\commands\home\Home;
use Rust\commands\Spawn;
//use Rust\commands\MobArena;

//use Rust\commands\tp\TPA;
//use Rust\commands\tp\TPKabul;
//use Rust\commands\tp\TPReddet;

use Rust\commands\Ada;
use Rust\commands\Friends;
use Rust\commands\BanWarn;

class Main extends PluginBase implements Listener{

	public $genel;
	public $money;
	public $tags;

	private static $instance;

	public function onLoad(){
		self::$instance = $this;
	}

	public static function getInstance(): Main{
		return self::$instance;
	}

	public function onEnable(): void{
		$this->getLogger()->info("\n§8╔═════════════════════════════\n║ §8» §eMineFox Rust Plugin§8\n║ §8» §ePlugin Coding by BayAlper10 §8\n║ §8» §ePlugin Language Turkish §8\n║ §8» §ePlugin Version 1.0 §8\n╚═════════════════════════════");
		$files = array("sell.yml", "messages");
		$this->getServer()->getNetwork()->setName("§6Mine§7Fox §8» §aRust");
		$this->getServer()->loadLevel("Utica");
		$this->getServer()->loadLevel("world");
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder() . "Adalar/");
		$komutlar = array("defaultgamemode","difficulty","help","makeserver","me","save-off","say","seed","spawnpoint","tell","transferserver",/*"version",*/"kill","checkperm");
		foreach($komutlar as $komut){
			$commandMap = $this->getServer()->getCommandMap();
			$cmd = $commandMap->getCommand($komut);
			$commandMap->unregister($cmd);
		}

		foreach($files as $file){
			if(!file_exists($this->getDataFolder() . $file)){
				@mkdir($this->getDataFolder());
				file_put_contents($this->getDataFolder() . $file, $this->getResource($file));
			}
		}

		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder()."Pinler/");
		$this->saveResource("dunyalar/ada.zip");
		$this->genel = new Config($this->getDataFolder() . "genel.yml", Config::YAML, array());
		$this->money = new Config($this->getDataFolder() . "money.yml", Config::YAML, array());
		$this->tags = new Config($this->getDataFolder() . "tags.yml", Config::YAML, array());
		$this->kits = new Config($this->getDataFolder() . "kits.yml", Config::YAML, array());
		$this->home = new Config($this->getDataFolder() . "home.yml", Config::YAML, array());
		$this->d = new Config($this->getDataFolder()."data.yml", Config::YAML);
		$this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
		$this->messages = new Config($this->getDataFolder() . "messages.yml", Config::YAML);
		$this->look = new Config($this->getDataFolder() . "look.yml", Config::YAML);
		$this->ada = new Config($this->getDataFolder() . "ada.yml", Config::YAML);
		$this->banwarn = new Config($this->getDataFolder() . "bw.yml", Config::YAML, array());

    $this->getScheduler()->scheduleRepeatingTask(new ParticleSpawn($this), 20);
		$this->getScheduler()->scheduleRepeatingTask(new Message1(), 20 * 240);
		//$this->getScheduler()->scheduleRepeatingTask(new Game());

		$manager = $this->getServer()->getPluginManager();
		$manager->registerEvents($this, $this);
		$manager->registerEvents(new Guns(), $this);
		$manager->registerEvents(new PlaceEvent($this), $this);
		$manager->registerEvents(new ProjectileEvent(), $this);
		$manager->registerEvents(new InteractEvent(), $this);
		$manager->registerEvents(new JoinEvent($this), $this);
		$manager->registerEvents(new Repair($this), $this);
		$manager->registerEvents(new Farm($this), $this);
		$manager->registerEvents(new BreakEvent($this), $this);
		$manager->registerEvents(new Ortak($this), $this);

		$command = $this->getServer()->getCommandMap();
		$command->register("craft", new CraftCommand($this));
		$command->register("param", new MyMoney("param", $this));
		$command->register("paraver", new AddMoney("paraver", $this));
		$command->register("paragonder", new SendMoney("paragonder", $this));
		$command->register("parasil", new RemoveMoney("parasil", $this));
		$command->register("epinolustur", new CreatePin("epinolustur", $this));
		$command->register("epin", new UsePin("epin", $this));
		$command->register("fly", new Fly("fly", $this));
		//$command->register("arazi", new Land("arazi", $this));
		$command->register("sat", new Sell("sat", $this));
		$command->register("kit", new Kit("kit", $this));
		$command->register("market", new Shop("market", $this));
		$command->register("feed", new Feed("feed", $this));
		$command->register("konumu", new Coordinat("konumu", $this));
		$command->register("evayarla", new SetHome("evayarla", $this));
		$command->register("ev", new Home("ev", $this));
		$command->register("spawn", new Spawn("spawn", $this));
		//$command->register("mobarena", new MobArena("mobarena", $this));
		//$command->register("tpa", new TPA("tpa", $this));
		//$command->register("tpak", new TPKabul("tpak", $this));
		//$command->register("tpar", new TPKabul("tpar", $this));
		$command->register("arazi", new Ada("arazi", $this));
		$command->register("ortak", new Friends("ortak", $this));
		$command->register("pban", new BanWarn("pban", $this));
	}

	public function onInteract(PlayerInteractEvent $e){
		$player = $e->getPlayer();
		if($e->getPlayer()->getLevel()->getFolderName() == "world"){
			if($e->getBlock()->getId() == 18){
				$rand = mt_rand(1,25);
	      switch($rand){
	        case 1:
	        $x = -536;
	        $y = 76;
	        $z = 418;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 2:
	        $x = -993;
	        $y = 69;
	        $z = 340;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 3:
	        $x = -957;
	        $y = 65;
	        $z = 163;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 4:
	        $x = 784;
	        $y = 111;
	        $z = 214;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 5:
	        $x = -882;
	        $y = 66;
	        $z = 71;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 6:
	        $x = -549;
	        $y = 73;
	        $z = 103;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 7:
	        $x = -583;
	        $y = 63;
	        $z = -69;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 8:
	        $x = -417;
	        $y = 62;
	        $z = -72;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 9:
	        $x = -252;
	        $y = 65;
	        $z = -500;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 10:
	        $x = 104;
	        $y = 62;
	        $z = 204;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 11:
	        $x = -55;
	        $y = 68;
	        $z = 97;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 12:
	        $x = 351;
	        $y = 78;
	        $z = -756;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 13:
	        $x = 285;
	        $y = 104;
	        $z = 942;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 14:
	        $x = 443;
	        $y = 90;
	        $z = -790;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 15:
	        $x = 815;
	        $y = 125;
	        $z = 370;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 16:
	        $x = 65;
	        $y = 85;
	        $z = 854;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 17:
	        $x = 433;
	        $y = 154;
	        $z = 763;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 18:
	        $x = 656;
	        $y = 99;
	        $z = -817;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 19:
	        $x = -134;
	        $y = 66;
	        $z = 658;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 20:
	        $x = 717;
	        $y = 65;
	        $z = -913;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 21:
	        $x = 519;
	        $y = 73;
	        $z = -862;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 22:
	        $x = 164;
	        $y = 64;
	        $z = -788;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 23:
	        $x = 295;
	        $y = 71;
	        $z = -666;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 24:
	        $x = 880;
	        $y = 67;
	        $z = -81;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
					case 25:
	        $x = 706;
	        $y = 69;
	        $z = 26;
	        $dunyaismi = "Utica";
	        $level = $player->getServer()->getLevelByName($dunyaismi);
	        $player->teleport(new Position($x, $y, $z, $level));
	        break;
	      }
			}
		}
	}

	public function onLogin(PlayerJoinEvent $e): void{
		$player = $e->getPlayer();
		$puank = $this->banwarn->getNested(strtolower($player->getName()).".puan");
		if($puank == 10){
			$e->getPlayer()->kick("Sicilin dolduğu için engellendin", false);
		}
		$bak = $this->look->get(strtolower($player->getName()));
		if($bak == "Bakmadı"){
		$baslamaform = new BaslamaForm;
		$baslamaform->baslamaMenu($player);
		$this->look->set(strtolower($player->getName()), "Baktı");
		$this->look->save();
	}
		$e->setJoinMessage("§7[§a+§7] §f" . $e->getPlayer()->getName() . " §eoyuna katıldı.");

		$x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getX();
		$y = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getY();
		$z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getZ();
		$world = $this->getServer()->getDefaultLevel();
		$player->setLevel($world);
		$player->teleport(new Vector3($x, $y, $z, $world));
		$player->setRotation(270, 0);

		if(!$this->look->exists(strtolower($player->getName()))){
			$this->look->set(strtolower($player->getName()), "Bakmadı");
			$this->look->save();
		}

    if(!$this->home->exists(strtolower($player->getName()))){
			$this->home->setNested(strtolower($player->getName()).".home", "Yok");
			$this->home->save();
		}

		if(!$this->banwarn->exists(strtolower($player->getName()))){
			$this->banwarn->setNested(strtolower($player->getName()).".puan", "0");
			$this->banwarn->save();
		}

		if($this->kits->exists(strtolower($player->getName()))){
			$this->kits->setNested(strtolower($player->getName())."bugun", 0);
			$this->kits->setNested(strtolower($player->getName())."bitis", 0);
			$this->kits->save();
		}

		if(!$this->money->exists(strtolower($player->getName()))){
	    	$this->money->setNested(strtolower($player->getName()).".money", 0);
	    	$this->money->save();
		}
		if(!$this->tags->exists(strtolower($player->getName()))){
			$this->tags->setNested(strtolower($player->getName()).".tag", "default");
			$this->tags->save();
		}
		if(!($this->d->get($e->getPlayer()->getName()) == null)){
			if($this->d->get($e->getPlayer()->getName())["Bitis"] < time()){
				$this->d->remove($e->getPlayer()->getName());
				$this->d->save();
				$e->getPlayer()->sendMessage(TextFormat::DARK_PURPLE."VIP'iniz bitmiştir. Bizden VIP aldığınız için teşekkür ederiz.");
			}
		}

		$tagsorgu = $this->tags->getNested(strtolower($player->getName()).".tag");
		if($tagsorgu == "default"){
			$e->getPlayer()->setNameTag("§7[§aOyuncu§7] §f" . $player->getName());
		}
		if($tagsorgu == "mod"){
			$e->getPlayer()->setNameTag("§7[§3MOD§7] §f" . $player->getName());
		}
		if($tagsorgu == "admin"){
			$e->getPlayer()->setNameTag("§7[§4Yönetici§7] §f" . $player->getName());
		}
		if($tagsorgu == "vip"){
			$e->getPlayer()->setNameTag("§7[§eVIP§7] §f" . $player->getName());
		}
		if($tagsorgu == "yetkili"){
			$e->getPlayer()->setNameTag("§7[§6Yetkili§7] §f" . $player->getName());
		}
		if($tagsorgu == "dev"){
			$e->getPlayer()->setNameTag("§7[§1Geliştirici§7] §f" . $player->getName());
		}
		if($tagsorgu == "yt"){
			$e->getPlayer()->setNameTag("§7[§cYouTube§7] §f" . $player->getName());
		}
	}

	public function onChat(PlayerChatEvent $e){
		$o = $e->getPlayer();
		$tagsorgu = $this->tags->getNested(strtolower($o->getName()).".tag");
		if($tagsorgu == "default"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§f" . $o->getName() . "§8» §7" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "mod"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§3MOD§7] §f" . $o->getName() . "§8» §7" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "admin"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§4Yönetici§7] §f" . $o->getName() . "§8» §f" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "vip"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§eVIP§7] §f" . $o->getName() . "§8» §f§o" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "yetkili"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§6Yetkili§7] §f" . $o->getName() . "§8» §7" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "dev"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§1Geliştirici§7] §f" . $o->getName() . "§8» §7" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
		if($tagsorgu == "yt"){
			foreach($this->getServer()->getOnlinePlayers() as $pl){
				$pl->sendMessage("§7[§cYouTube§7] §f" . $o->getName() . "§8» §7" . $e->getMessage());
				$e->setCancelled(true);
			}
		}
	}

	public function rs(PlayerRespawnEvent $e) {
        $player = $e->getPlayer();
        $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
    }
}
