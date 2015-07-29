<?php
/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 11:57
 */


define('PAYMENT_COST', 20);

// Supongamos que tenemos una clase que calcula el pago total de una orden:

class PaymentCalculator
{
    public function calcTotalAmount(Order $order)
    {
        return $order->getAmount() + PAYMENT_COST;
    }
}

//Tiempo después se nos solicita agregar un nuevo tipo de pago para suscriptores.

class PaymentCalculator2
{
    public function calcTotalAmount(Order $order, $type)
    {
        if ($type == 'normal')
            return $order->getAmount() + PAYMENT_COST;
        else if ($type == 'suscriptor')
            return $order->getAmount() + PAYMENT_COST * 0.5;
    }
}

//Y si nos vuelven a solicitar un nuevo tipo de pago, volveríamos a agregar una nueva condicion a nuestro if,
// de esta manera estamos rompiendo el principio al modificar la clase y no extenderla. La forma adecuada de trabajar este tipo de ejemplos seŕia la siguiente:

interface paymentMethod
{
    public function calcPayment(Order $order);
}

class normalPayment3 implements paymentMethod
{
    public function calcPayment(Order $order)
    {
        return $order->getAmount() + PAYMENT_COST;
    }
}

class suscriptorPayment implements paymentMethod
{
    public function calcPayment(Order $order)
    {
        return $order->getAmount() + PAYMENT_COST * -0.5;
    }
}

$order = new Order();
$order->setAmount(100);

$paymentCalculator = new normalPayment3();
echo $paymentCalculator->calcPayment($order);

//De esta manera, cuando aparezcan nuevas formas de pago, no tenemos que modificar un clase, si no lo que tenemos que hacer es implementar (extender) la interfaz.


class Order
{
    private $amount;

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}

/**
 * Primer tipo de pago
 */
/*
class PaymentCalculator {

	public function calcTotalAmount(Order $order)
	{
		return $order->getAmount() + PAYMENT_COST;
	}
}
*/


/**
 * Clase cuando se agrega un nuevo tipo de pago
 */
class PaymentCalculator3
{

    public function calcTotalAmount(Order $order, $type)
    {
        if ($type == 'normal')
            return $order->getAmount() + PAYMENT_COST;
        else if ($type == 'suscriptor')
            return $order->getAmount() + PAYMENT_COST * 0.5;
    }
}

/**
 * Clases refactorizadas
 */
interface paymentMethod3
{
    public function calcPayment(Order $order);
}

class normalPayment4 implements paymentMethod3
{
    public function calcPayment(Order $order)
    {
        return $order->getAmount() + PAYMENT_COST;
    }
}

class suscriptorPayment3 implements paymentMethod3
{
    public function calcPayment(Order $order)
    {
        return $order->getAmount() + PAYMENT_COST * -0.5;
    }
}

$order = new Order();
$order->setAmount(100);

$paymentCalculator = new normalPayment4();
echo $paymentCalculator->calcPayment($order);

echo "Hola";