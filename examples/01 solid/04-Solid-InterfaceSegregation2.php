<?php
/**
 * Created by PhpStorm.
 * User: Xion
 * Date: 08/07/15
 * Time: 16:41
 */
#http://programacion.net/files/figura1(1).jpg

class Modelo2002 : ImpresoraMultifuncional
{
    public override void Imprimir()
{
Impresion . EnviarImpresion();
}
public override void Escanear()
{
Escaner . DigitalizarAFormatoPng();
}
public override void Cancelar()
{
Impresion . CancelarImpresion();
}
public override void EnviarFax()
{
throw new System . NotImplementedException();
}
public void EnviarEMail()
{
// Enviamos por correo electrónico
}
}

public interface IImprimible
{
void Imprimir();
}
public interface IFotocopiable
{
void Fotocopiar();
}
public interface IEscaneable
{
void Escanear();
}
public interface IFaxCompatible
{
void EnviarFax();
void RecibirFax();
}
public interface ITcpIpCompatible
{
void EnviarEMail();
}
class Modelo1998 : IImprimible, IEscaneable, IFaxCompatible
{
// ...
}
class Modelo2000 : IImprimible, IEscaneable, IFaxCompatible,
IFotocopiable
{
// ...
}
class Modelo2002 : IImprimible, IEscaneable, IFotocopiable,
ITcpIpCompatible
{
// ...
}