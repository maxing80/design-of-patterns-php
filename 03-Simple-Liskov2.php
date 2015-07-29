<?php

/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 16:14
 */
class Rectangle
{
    private $width;
    private $height;

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
}

class Square extends Rectangle
{
    public function setWidth($width)
    {
        parent::setWidth($width);
        parent::setHeight($width);
    }

    public function setHeight($height)
    {
        parent::setWidth($height);
        parent::setHeight($height);
    }
}

class RectangleArea
{
    public function calc(Rectangle $rectangle)
    {
        return $rectangle->getWidth() * $rectangle->getHeight();
    }
}

class TestRectangleArea
{
    public function testCalc(Rectangle $rectangle)
    {
        $w = 10;
        $h = 5;

        $rectangle->setWidth($w);
        $rectangle->setHeight($h);

        $rectangleArea = new RectangleArea();

        if ($rectangleArea->calc($rectangle) == $w * $h) {
            echo 'pass';
        } else {
            echo 'fail';
        }
    }
}

$t = new TestRectangleArea();
$t->testCalc(new Square());