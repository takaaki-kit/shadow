<?php

class Controller
{
	public function __construct($user_interface, $temperature_manager)
	{
		$this->user_interface = $user_interface;
		$this->temperature_manager = $temperature_manager;
	}

	public function polling()
	{
		while( PowerManager::is_running() ) {
			$this->user_interface->print_now_temperature($this->temperature_manager->now_temperature());
			$temperature_manager->execute();
		}
	}

	public function downHandler()
	{
		$this->temperature_manager->down();
		$user_interface->print_setting_temperature($this->temperature_manager->now_setting_temperature());
	}

	public function upHandler()
	{
		$this->temperature_manager->up();
		$user_interface->print_setting_temperature($this->temperature_manager->now_setting_temperature());
	}

}

class TemperatureManager
{
	private $setting_temperature = DEFAULT_SETTING_TEMPERATURE;

	public function __construct($air_conditioner, $temperature_sensor)
	{
		$this->air_conditioner = $air_conditioner;
		$this->temperature_sensor = $temperature_sensor;
	}

	public function execute()
	{
		if ( $this->now_setting_temperature() < $this->setting_temperature ) { $this->air_conditioner->heat(); }
		else if ( $this->now_setting_temperature() > $this->setting_temperature ) { $this->air_conditioner->cool(); }
		else{ $this->air_conditioner->stop(); }
	}

	public function up()
	{
		$this->setting_temperature += 1;
	}

	public function up()
	{
		$this->setting_temperature -= 1;
	}

	public function now_setting_temperature()
	{
		return $this->setting_temperature;
	}

	public function now_setting_temperature()
	{
		return $this->temperature_sensor->value();
	}
}

class Airconditioner
{
}

class UserInterface
{
}

class TemperatureSensor
{
}

class PowerManager
{
	public function on()
	{
		$controller = new Controller($user_interface, $temperature_manager);
		$controller->polling();
	}

	public function is_running() {}
}
