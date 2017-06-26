<?php

class Metronome
{
	private $tempo_controller;

	public function __construct($tempo_controller, $user_interface)
	{
		$this->tempo_controller = $tempo_controller
		$this->user_interface = $user_interface
	}

	public function execute()
	{
		while( PowerManager::is_running() ) {
			$this->tempo_controller->sound();
		}
	}

	public function up_tempo()
	{
		$this->tempo_controller->up();
		$this->user_interface->display_tempo($this->tempo_controller->now_tempo());

	}

	public function down_tempo()
	{
		$this->tempo_controller->down();
		$this->user_interface->display_tempo($this->tempo_controller->now_tempo());
	}
}

class TempoController
{
	private $tempo = DEFAULT_TEMPO;

	public function __construct($sound)
	{
		$this->sound = $sound;
	}

	public function sound()
	{
		//現在のテンポに合わせて
		//音を鳴らす
	}

	public function up()
	{
		$this->tempo += 1;
	}

	public function down()
	{
		$this->tempo -= 1;
	}

	public function now_tempo()
	{
		return $this->tempo;
	}

	public function select_sound()
	{
		$this->sound = $this->sound->next();
	}
}

class UserInterface
{
	public function __construct($metronome)
	{
		$this->metronome = metronome;
	}

	public function up()
	{
		$this->metronome->up_tempo();
	}

	public function up()
	{
		$this->metronome->down_tempo();
	}

	public function display_tempo($tempo) {}
	public function select_sound()
	{
		$this->metronome->select_sound();
	}
}

class PowerManager
{
	public static function is_running() {}
}

class Sound
{
	private $type;

	public function __construct()
	{
		$this->type = DEFAULT_SOUND_TYPE;
	}

	public function next()
	{
	}
}
