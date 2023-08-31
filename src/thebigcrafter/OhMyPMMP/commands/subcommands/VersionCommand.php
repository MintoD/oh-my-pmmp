<?php

/*
 * This file is part of oh-my-pmmp.
 * (c) thebigcrafter <hello.thebigcrafter@gmail.com>
 * This source file is subject to the GPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

declare(strict_types=1);

namespace thebigcrafter\OhMyPMMP\commands\subcommands;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use thebigcrafter\OhMyPMMP\OhMyPMMP;
use thebigcrafter\OhMyPMMP\utils\Utils;
use function phpversion;

class VersionCommand extends BaseSubCommand {

	protected function prepare() : void {
		$this->setPermission("oh-my-pmmp.version");
	}

	/**
	 * @param array<string> $args
	 */
	public function onRun(CommandSender $sender,string $aliasUsed,array $args) : void {
		$phpVersion = phpversion();
		$pluginVersion = OhMyPMMP::getInstance()->getDescription()->getVersion();

		$sender->sendMessage(Utils::translate("version.php", ["version" => $phpVersion]));
		$sender->sendMessage(Utils::translate("version.ohmypmmp", ["version" => $pluginVersion]));
	}
}
