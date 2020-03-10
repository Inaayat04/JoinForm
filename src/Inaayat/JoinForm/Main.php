<?php

namespace Inaayat\JoinForm\Main;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{

	public $config;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder."config.yml", Config::YAML);
        $this->saveDefault("config.yml");
		$this->getLogger()->info("plugin by Inaayat has been enabled succesfully.");
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();

		$joinform = new SimpleForm(function (Player $player, $data){
            $result = $data;
            if ($result !== null) {
                switch ($result) {
                    case 0:
                    $sumbitmsg = $this->config->get("Sumbit-Msg");
                    $player->sendMessage($sumbitmsg);
                        break;
                }
            }
        });
        $formtitle = $this->config->get("Form-Title");
        $formcontent = $this->config->get("Form-Content");

        $joinform->setTitle($formtitle);
        $joinform->setContent($formcontent);
        $joinform->addButton("§d§lSumbit", 0, "textures/items/paper");
        $player->sendForm($joinform);
	}

}
