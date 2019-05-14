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
use Rust\forms\CraftForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class CraftCommand extends Command implements PluginIdentifiableCommand{

	public $plugin;

	public function __construct(Main $plugin){
		$this->p = $plugin;
		parent::__construct("craft", "Crafting menüsünü açar");
		$this->setUsage("/craft");
	}

	public function getPlugin(): Plugin{
		return $this->p;
	}

	public function execute(CommandSender $cs, string $label, array $args): bool{
		if($this->p->isEnabled()){
			if($cs instanceof ConsoleCommandSender){
				$cs->sendMessage("§8» §cBu komut konsoldan kullanılamaz.");
				return true;
			}
			$craftform = new CraftForm;
			$craftform->craftMenu($cs);
		}
		return true;
	}
}