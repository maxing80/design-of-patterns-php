<?php
/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 16:20
 */
#S.O.L.I.D Principio de Segregacion de Interfaces

#Seguimos con el cuarto de los principios S.O.L.I.D.

#Este principio introducido por el propio Robert Martin se define de la siguiente forma:
#Clients should not be forced to depend upon interfaces that they do not use. - Clientes no deben ser forzados a depender de interfaces que no usen.
#Este principio nos habla de las interfaces pesadas o contaminadas, esas que tienen una gran cantidad de métodos. Si un cliente implementa esa interface pues tendrá que declarar métodos que no necesita y los cuales estarán evidentemente vacíos.
#Cuando esto sucede es porque tenemos interfaces que no son cohesivas y lo mejor es dividirlas de manera funcional, es decir vamos a agrupar los métodos según su funcionalidad, así el cliente solo implementara la interface que necesite realmente. Pienso que es mejor hacer un esfuerzo adicional en nuestra fase de diseño a fin de tener un estructura mas funcional y flexible en nuestro software.
#Pasemos a un ejemplo:

class Manager
{
    public function manage(WorkerInterface $worker)
    {
        $worker->work();
        $worker->sleep();
    }
}

class HumanWorker implements WorkerInterface
{
    public function work()
    {
        // working
    }

    public function sleep()
    {
        // sleeping
    }
}

class RobotWorker implements WorkerInterface
{
    public function work()
    {
        // working
    }

    public function sleep()
    {
        // sleep?
        return null; // Breaks ISP
    }
}

interface WorkerInterface
{
    public function work();

    public function sleep();
}


#Aquí la empresa tiene trabajadores que harán operaciones como trabajar y descansar.
#Bien que pasaría si ahora la empresa tiene un robot que implementa esta interface Worker, entonces el robot esta obligado a tener un método descansar() que evidentemente no usara. Pues aquí lo que podemos hacer es aplicar este principio de segregar las interfaces.
#Usaremos una para trabajar y otra para descansar.
class Manager2
{
    public function manage(Manageable $worker)
    {
        $worker->beManaged();
    }
}

class HumanWorker implements WorkableInterface, SleepableInterface, ManageableInterface
{
    public function work()
    {
        // working
    }

    public function sleep()
    {
        // sleeping
    }

    public function beManaged()
    {
        $this->work();
        $this->sleep();
    }
}

class RobotWorker2 implements WorkableInterface, ManageableInterface
{
    public function work()
    {
        // working
    }

    public function beManaged()
    {
        $this->work();
    }
}

interface WorkableInterface
{
    public function work();
}

interface SleepableInterface
{
    public function sleep();
}

interface ManageableInterface
{
    public function beManaged();
}

//Uno mas

interface RepositoryInterface
{
    public function insert($data);

    public function update($data);

    public function delete($data);

    public function findAll($data);

    public function findById($data);
}

# Vinculamos la clase ArticleRepository y UserRepository a la interfaz RepositoryInterface.
class ArticleRepository implements RepositoryInterface
{
    public function insert($data)
    {
        //acción insert en BD
    }

    public function update($data)
    {
        //acción update en BD
    }

    public function delete($data)
    {
        //acción delete en BD
    }

    public function findAll($data)
    {
        //Muestra toda las filas de la tabla en BD
    }

    public function findById($data)
    {
        //Busca la fila que tenga el id x
    }
}

class UserRepository implements RepositoryInterface
{
    public function insert($data)
    {
        //acción insert en BD
    }

    public function update($data)
    {
        //acción update en BD
    }

    public function delete($data)
    {
        //Devolvemos una Excepción por que no queremos que se puedan eliminar Users
        throw new Exception('No puedes borrar User');
    }

    public function findAll($data)
    {
        //Muestra toda las filas de la tabla en BD
    }

    public function findById($data)
    {
        //Busca la fila que tenga el id x
    }
}

#Nuestra aplicación no permite eliminar ningún Usuario, para impedir borrar añadimos una Excepción en UserRepository::delete(). En este caso estamos forzando a implementar un método que no vamos a utilizar.

#Para solucionar este problema podemos hacer nuestra interfaz más pequeña y dividirla en las diferentes funcionalidades que va a tener nuestra aplicación. En nuestro caso vamos a dividirla en 2 partes: una para hacer el CRU (Crear, Leer y Actualizar) y otra D (Eliminar).

interface CRUInterface
{
    public function insert($data);

    public function update($data);

    public function findAll($data);

    public function findById($data);
}

interface DeleteInterface
{
    public function delete($data);
}

#Ahora hacemos uso de las interfaces en nuestras clases ArticleRepository y UserRepository

class ArticleRepository2 implements CRUInterface, DeleteInterface
{
    public function insert($data)
    {
        //acción insert en BD
    }

    public function update($data)
    {
        //acción update en BD
    }

    public function delete($data)
    {
        //acción delete en BD
    }

    public function findAll($data)
    {
        //Muestra toda las filas de la tabla en BD
    }

    public function findById($data)
    {
        //Busca la fila que tenga el id x
    }
}

class UserRepository2 implements CRUInterface
{
    public function insert($data)
    {
        //acción insert en BD
    }

    public function update($data)
    {
        //acción update en BD
    }

    public function findAll($data)
    {
        //Muestra toda las filas de la tabla en BD
    }

    public function findById($data)
    {
        //Busca la fila que tenga el id x
    }
}

#Ahora ya tenemos nuestras interfaces desacopladas, este principio se relaciona con el Principio de Responsabilidad Única.

#Para concluir vamos a optimizar nuestras interfaces, en concreto vamos a crear una nueva interfaz llamada CRUDInterface que se utilizará para todas aquellas clases que implementen la interfaz CRURInterface y DeleteInterface.
interface CRUDInterface extends CRUInterface, DeleteInterface
{

}

#Por último implementamos la nueva interfaz CRUDInterface a la clase ArticleRepository

class ArticleRepository3 implements CRUDInterface
{
    public function insert($data)
    {
        //acción insert en BD
    }

    public function update($data)
    {
        //acción update en BD
    }

    public function delete($data)
    {
        //acción delete en BD
    }

    public function findAll($data)
    {
        //Muestra toda las filas de la tabla en BD
    }

    public function findById($data)
    {
        //Busca la fila que tenga el id x
    }
}
