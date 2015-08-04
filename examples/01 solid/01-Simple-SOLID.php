<?php

/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 11:41
 */
class Person {

    private $name;
    private $lastname;

    public function __construct($name,$lastname)
    {
        $this->name = $name;
        $this->lastname = $lastname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function printFullName()
    {
        echo '<div>'.$this->name.' '.$this->lastname.'</div>';
    }

    public function getFullName()
    {
        return $this->name.' '.$this->lastname;
    }
}


class HTMLPrinter {
    public function printPerson(Person $p)
    {
        echo '<div>'.$p->getFullName().'</div>';
    }
}

$p = new Person('Joca','Pereyra');
$p->printFullName();
$printer = new HTMLPrinter;
$printer->printPerson($p);


//Aplicando Single responsibility principle

/*
 * Al analizar la clase Person,en especial el método printFullName, nos podremos dar cuenta de que esta pueda cambiar por dos razones:
 *
 * - Cambia el contenido de lo que se desea imprimir
 * - Cambia el formato de lo que se desea imprimir
 * - El principio dice que estas dos razones son dos responsabilidades diferentes por lo que ambas funcionalidades deberían estar separadas. Aquí se muestra cómo podría estar separadas ambas clases.
 */

class Person2 {

    private $name;
    private $lastname;

    public function __construct($name,$lastname)
    {
        $this->name = $name;
        $this->lastname = $lastname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function printFullName()
    {
        echo '<div>'.$this->name.' '.$this->lastname.'</div>';
    }

    public function getFullName()
    {
        return $this->name.' '.$this->lastname;
    }
}


class HTMLPrinter2 {
    public function printPerson(Person $p)
    {
        echo '<div>'.$p->getFullName().'</div>';
    }
}

$p = new Person2('Joca','Pereyra');
$p->printFullName();
$printer = new HTMLPrinter2;
$printer->printPerson($p);