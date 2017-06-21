<?php

class Controller
{
	public function __construct($user_interface, $power_manager, $temperature_manager)
	{
		$this->user_interface = $user_interface;
		$this->power_manager = $power_manager;
		$this->temperature_manager = $temperature_manager;
	}

	public function polling()
	{
		while( $this->power_manager->is_running() ) {
			$this->temperature_manager->print_now_temperature();
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
		if ( $this->temperature_sensor->value() < $this->setting_temperature ) { $this->air_conditioner->heat(); }
		else if ( $this->temperature_sensor->value() > $this->setting_temperature ) { $this->air_conditioner->cool(); }
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
}

class Airconditioner
{
}

class UserInterface
{
}
