<?php
/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 13:48
 */
/// http://sg.com.mx/content/view/306

class Vehicle
{

    function startEngine()
    {
        // Default engine start functionality
    }

    function accelerate()
    {
        // Default acceleration functionality
    }
}


class Car extends Vehicle
{

    function startEngine()
    {
        $this->engageIgnition();
        parent::startEngine();
    }

    private function engageIgnition()
    {
        // Ignition procedure
    }

}

class ElectricBus extends Vehicle
{

    function accelerate()
    {
        $this->increaseVoltage();
        $this->connectIndividualEngines();
    }

    private function increaseVoltage()
    {
        // Electric logic
    }

    private function connectIndividualEngines()
    {
        // Connection logic
    }

}


class Driver {
    function go(Vehicle $v) {
        $v->startEngine();
        $v->accelerate();
    }
}
// Vilation SL
class Rectangle {

    public $topLeft;
    public $width;
    public $height;

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getWidth() {
        return $this->width;
    }

}

class Square extends Rectangle {

    public function setHeight($value) {
        $this->width = $value;
        $this->height = $value;
    }

    public function setWidth($value) {
        $this->width = $value;
        $this->height = $value;
    }
}

class Client {

    function areaVerifier(Rectangle $r) {
        $r->setWidth(5);
        $r->setHeight(4);

        if($r->area() != 20) {
            throw new Exception('Bad area!');
        }

        return true;
    }

}

