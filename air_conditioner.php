<?php

class Controller
{
	private $setting_temperature = DEFAULT_SETTING_TEMPERATURE;

	public function __construct($temperature_sensor, $user_interface, $power_manager, $air_conditioner, $temperature_manager)
	{
		$this->temperature_sensor = $temperature_sensor;
		$this->user_interface = $user_interface;
		$this->power_manager = $power_manager;
		$this->air_conditioner = $air_conditioner;
		$this->temperature_manager = $temperature_manager;
	}

	public function polling()
	{
		while( $this->power_manager->is_running() ) {
			$this->air_conditioner->print_now_temperature();
			$temperature_manager->execute();
		}
	}

	public function upHandler()
	{
		$this->setting_temperature -= 1;
		$user_interface->print_setting_temperature();
	}

	public function downHandler()
	{
		$this->setting_temperature += 1;
		$user_interface->print_setting_temperature();
	}

}

class TemperatureManager
{
	public function execute()
	{
		if ( $temperature_sensor->value() < $this->setting_temperature ) { $this->air_conditioner->heat(); }
		else if ( $temperature_sensor->value() > $this->setting_temperature ) { $this->air_conditioner->cool(); }
		else{ $this->air_conditioner->stop(); }
	}
}

class Airconditioner
{
}

class UserInterface
{
}
