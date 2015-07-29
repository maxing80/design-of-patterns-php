<?php
/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 16:30
 */

#Un ejemplo utilizando LSP:

#Tenemos una interfaz llamada WelcomeInterface con un método getWelcome() y 2 clases que implementan dicha interfaz.
interface WelcomeInterface
{
    public function getWelcome();
}

class SpanishWellcome implements WelcomeInterface
{
    public function getWelcome()
    {
        return "Bienvenid@";
    }
}

class EnglishWellcome implements WelcomeInterface
{
    public function getWelcome()
    {
        return "Welcome";
    }
}

#El objetivo es que todas sus clases hijas deben ser intercambiables entre ellas sin afectar el comportamiento del código.

class Application
{
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function welcome(WelcomeInterface $wellcome)
    {
        return $wellcome->getWelcome()." ".$this->name;
    }
}

$welcomeUser = new Application("Juan Luis");

//Bienvenid@ Juan Luis
echo $welcomeUser->getWelcome(new SpanishHello());

//Wellcome Juan Luis
echo $welcomeUser->getWelcome(new EnglishHello());

