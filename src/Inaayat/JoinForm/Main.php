<?php

namespace Inaayat\JoinForm;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;

use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{

	public $config;
	public const PREFIX = "§8[§bJoinUI§8]§r ";

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
                $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		@mkdir($this->getDataFolder());
                $this->config = $this->getConfig();
                $this->saveDefaultConfig();
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();

		$joinform = new SimpleForm(function (Player $player, $data){
            $result = $data;
            if ($result !== null) {
                switch ($result) {
                    case 0:
                    $sumbitmsg = $this->config->get("Sumbit-Msg");
                    $player->sendMessage(self::PREFIX . $sumbitmsg);
                        break;
                }
            }
        });
        $formtitle = $this->config->get("Form-Title");
        $formcontent = $this->config->get("Form-Content");

        $joinform->setTitle($formtitle);
        $joinform->setContent($formcontent);
        $joinform->addButton("§d§lSumbit");
        $player->sendForm($joinform);
	}
}
