<?php

class Controller
{
    public function setup()
    {
        $this->temperature_manager = new TemperatureManager(TemperatureSensor, Device)
    }
    public function polling()
    {
        //無限ループのテスト=>whileの中身を取り出せればできそう！
        //依存性の注入、テストからは別のオブジェクトを渡す
        while( PowerSupplyManager::is_running() ){
            UserInterface::print_now_temperature(TemperatureSensor::value());
            $this->temperature_manager->execute();
        }
    }

    public function downHandler()
    {
        $this->temperature_manager->setting_down();
        UserInterface::print_setting_temperature($temperature_manager->setting_temperature());
    }

    public function upHandler()
    {
        $this->temperature_manager->setting_up();
        UserInterface::print_setting_temperature($temperature_manager->setting_temperature());
    }
}

class TemperatureManager
{
    public function __constructor($temperature_sensor, $device)
    {
        $this->temperature_sensor = $temperature_sensor;
        $this->device = $device;
    }

    public function execute()
    {
        if ( $this->temperature_sensor::value > $this->device::setting_temperature() ) { $this->device::cool(); }
        else if ( $this->temperature_sensor::value < $this->device::setting_temperature() ) { $this->device::hot(); }
        else { $this->device::stop(); }
    }

    public function setting_down()
    {
        $this->device->setting_down()
    }

    public function setting_up()
    {
        $this->device->setting_up()
    }

    public function setting_temperature()
    {
        $this->device->setting_temperature();
    }
}

class TemperatureSensor
{
    public function now_temperature()
}

class Device
{
    private $setting_temperature = DEFAULT_SETTING_TEMPERATURE;

    public function is_same_as($setting_temperature)
    public function is_cooler_than($setting_temperature)

    public function setting_temperature()

    public function stop()
    public function heat()
    public function cool()
}

class UserInterface
{
    public function print_setting_temperature()
    public function print_now_temperature()
}

class PowerSupplyManager
{
    public function is_running()
}
