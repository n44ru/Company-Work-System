<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Presupuesto;
use AppBundle\Entity\Oficina;
use AppBundle\Entity\Persona;
use AppBundle\Entity\Empresa;
use AppBundle\Entity\Moneda;
use AppBundle\Entity\Servicio;
use AppBundle\Entity\Prefactura;
use AppBundle\Entity\Factura;
use AppBundle\Entity\Proyecto;

class PresupuestoController extends Controller
{
    /**
     * @Route("/presupuesto", name="presupuesto_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Presupuesto')->findAll();
        return $this->render('presupuesto/ver.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/presupuesto/detalles/{id}", name="presupuesto_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Presupuesto')->find($id);
        return $this->render('presupuesto/detalles.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/presupuesto/eliminar/{id}", name="presupuesto_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Presupuesto')->find($id);

        // Eliminando las relaciones de Prefactura.
        $query_2 = $em->createQuery('DELETE FROM AppBundle:Prefactura m WHERE m.presupuestoid = '.$id.'');
        $query_2->getResult();

        // Eliminando las relaciones de Factura.
        $query_2 = $em->createQuery('DELETE FROM AppBundle:Factura m WHERE m.presupuestoid = '.$id.'');
        $query_2->getResult();
        //
        // Eliminando las relaciones de Proyecto.
        $query_1 = $em->createQuery('DELETE FROM AppBundle:Formapago m WHERE m.presupuestoid = '.$id.'');
        $proy = $query_1->getResult();
        /*for($i=0;$i<count($proy);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Presupuesto')->find($proy[$i]['id']);
            $pre_actual->setPresupuestoid(null);
            $em->persist($pre_actual);
            $em->flush();
        }*/
        //
        $em->remove($pre);
        $em->flush();
        return $this->redirectToRoute('presupuesto_ver');
    }
    /**
     * @Route("/presupuesto/insertar", name="presupuesto_insertar")
     */
    public function insertarAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        //
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->findAll();
        $persona = $em->getRepository('AppBundle:Persona')->findAll();
        $empresa = $em->getRepository('AppBundle:Empresa')->findAll();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();

        // The Fun Begin!!!
        //capturar_oficina
        if($request->request->get('oficina_modal')!=null)
        {
            // Llamando Oficina Modal Controller.
            $this->Oficina_ModalAction($request);
            return $this->redirectToRoute('presupuesto_insertar');
        }
        //capturar cliente
        if($request->request->get('clientes_modal')!=null)
        {
            // Llamando Oficina Modal Controller.
            $this->Cliente_ModalAction($request);
            return $this->redirectToRoute('presupuesto_insertar');
        }
        //
        //capturar Servicio
        if($request->request->get('servicio_modal')!=null)
        {
            // Llamando Oficina Modal Controller.
            $this->Servicio_ModalAction($request);
            return $this->redirectToRoute('presupuesto_insertar');
        }
        //capturar Servicio
        if($request->request->get('moneda_modal')!=null)
        {
            // Llamando Oficina Modal Controller.
            $this->Moneda_ModalAction($request);
            return $this->redirectToRoute('presupuesto_insertar');
        }
        //capturar Servicio
        if($request->request->get('empresa_modal')!=null)
        {
            // Llamando Oficina Modal Controller.
            $this->Empresa_ModalAction($request);
            return $this->redirectToRoute('presupuesto_insertar');
        }

        if ($request->request->count() > 1) {


            $fecha_inicio = $request->request->get('fecha_inicio');
            $fecha_fin = $request->request->get('fecha_fin');
            $ofi = $request->request->get('f2');
            $per = $request->request->get('f3');
            $serv = $request->request->get('f4');
            $objetivos = $request->request->get('f5');
            $mon = $request->request->get('f7');
            $emp = $request->request->get('f8');
            //Referenciado por
            $ref = $request->request->get('referenciado');
            //
            $iva = $request->request->get('iva');
            $gs = $request->request->get('gs');
            //
            $descuento = $request->request->get('f9');
            //
            $persona = $em->getRepository('AppBundle:Persona')->find($per);
            $empresa = $em->getRepository('AppBundle:Empresa')->find($emp);
            $moneda = $em->getRepository('AppBundle:Moneda')->find($mon);
            $oficina = $em->getRepository('AppBundle:Oficina')->find($ofi);
            $servicio = $em->getRepository('AppBundle:Servicio')->find($serv);
            $trabajadores = $em->getRepository('AppBundle:Trabajadores')->find($ref);
            //
            $importe=$servicio->Getprecio();
            //Ver si es 0 o no.
            if($descuento >0 && $descuento <=100)
            {
                $importe=$importe - ($importe*$descuento)/100;
            }
            //Hallar el Total
            $total = $iva+$gs+$importe;
            $notas = $request->request->get('notas');
            //
            $pre= new Presupuesto();
            $pre->setPersonaid($persona);
            $pre->setEmpresaid($empresa);
            $pre->setMonedaid($moneda);
            $pre->setOficinaid($oficina);
            $pre->setServicioid($servicio);
            $pre->setFechainicio($fecha_inicio);
            $pre->setFechafin($fecha_fin);
            $pre->setObjetivos($objetivos);
            $pre->setImporte($importe);
            $pre->setNotas($notas);
            $pre->setDescuento($descuento);
            $pre->setIva($iva);
            $pre->setGastossuplidos($gs);
            $pre->setTotal($total);
            //new
            $pre->setTrabajadoresid($trabajadores);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($pre);
            $em->flush();
            // Metodo para SUBIR FICHEROS
            $nombre='presupuesto'.$pre->getId();
            define('UPLOADPATH', 'files/uploads/Presupuesto/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            // Insertar la prefactura o la factura.
            //
            $new = $em->getRepository('AppBundle:Presupuesto')->find($pre->getId());
            //
            $name = $persona->getnombreRazonSocial();
            //
                $prefac = new Prefactura();
                $prefac->setPresupuestoid($new);
                $prefac->setImporte($total);
                $prefac->setFechainicio($fecha_inicio);
                $prefac->setFechafin($fecha_fin);
                $prefac->setNumero($fecha_inicio.'_'.$name);
                $em->persist($prefac);
                $em->flush();
                //
                $nombre = $prefac->getId();
                if (!file_exists('files/uploads/Prefacturas/' . $nombre)) {
                    mkdir('files/uploads/Prefacturas/' . $nombre);
                }

            //Insertar el nuevo proyecto
            $pro = new Proyecto();
            //
            $pro->setFechaInicio($fecha_inicio);
            $pro->setFechaFin($fecha_fin);
            $pro->setObjetivos($objetivos);
            $pro->setImporte($importe);
            $pro->setPresupuesto(null);
            $pro->setPersonaid($persona);
            $pro->setOficinaid($oficina);
            $pro->setServicioid($servicio);
            $em->persist($pro);
            $em->flush();
            //
            $nombre = $oficina->getId().$persona->getnombreRazonsocial();
            if (!file_exists('files/uploads/Proyectos/' . $nombre)) {
                mkdir('files/uploads/Proyectos/' . $nombre);
            }
            //
            return $this->redirectToRoute('presupuesto_ver');
        }

        return $this->render('presupuesto/insertar.html.twig',array('cliente'=>$persona,
            'empresa'=>$empresa,
            'moneda'=>$moneda,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
            'trabajadores'=>$trabajadores
            ));
    }
    /**
     * @Route("/presupuesto/editar/{id}", name="presupuesto_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Presupuesto')->find($id);
        //
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->findAll();
        $persona = $em->getRepository('AppBundle:Persona')->findAll();
        $empresa = $em->getRepository('AppBundle:Empresa')->findAll();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();

        if ($request->request->count() > 1) {

            $fecha_inicio = $request->request->get('fecha_inicio');
            $fecha_fin = $request->request->get('fecha_fin');
            $ofi = $request->request->get('f2');
            $per = $request->request->get('f3');
            $serv = $request->request->get('f4');
            $objetivos = $request->request->get('f5');
            $importe = $request->request->get('f6');
            $mon = $request->request->get('f7');
            $emp = $request->request->get('f8');
            $ref = $request->request->get('referenciado');
            //
            $iva = $request->request->get('iva');
            $gs = $request->request->get('gs');
            //
            $descuento = $request->request->get('f9');
            //
            $persona = $em->getRepository('AppBundle:Persona')->find($per);
            $empresa = $em->getRepository('AppBundle:Empresa')->find($emp);
            $moneda = $em->getRepository('AppBundle:Moneda')->find($mon);
            $oficina = $em->getRepository('AppBundle:Oficina')->find($ofi);
            $servicio = $em->getRepository('AppBundle:Servicio')->find($serv);
            $trabajadores = $em->getRepository('AppBundle:Trabajadores')->find($ref);

            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            $nombre='presupuesto'.$pre->getId();
            define('UPLOADPATH', 'files/uploads/Presupuesto/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            //$importe=$pre->getImporte();
            //Ver si es 0 o no.
            $final=$pre->getDescuento();
            if($descuento >0 && $descuento <=100)
            {
                $importe=$importe - ($importe*$descuento)/100;
                $final=$descuento;
            }
            //Hallar el total.
            $total = $iva+$gs+$importe;
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $pre->setPersonaid($persona);
            $pre->setEmpresaid($empresa);
            $pre->setMonedaid($moneda);
            $pre->setOficinaid($oficina);
            $pre->setServicioid($servicio);
            $pre->setFechainicio($fecha_inicio);
            $pre->setFechafin($fecha_fin);
            $pre->setObjetivos($objetivos);
            $pre->setImporte($importe);
            $pre->setNotas($notas);
            //
            $pre->setDescuento($final);
            $pre->setIva($iva);
            $pre->setGastossuplidos($gs);
            $pre->setTotal($total);
            //
            $pre->setTrabajadoresid($trabajadores);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($pre);
            $em->flush();
            return $this->redirectToRoute('presupuesto_ver');
        }

        return $this->render('presupuesto/editar.html.twig',array('pre'=>$pre,
            'trabajadores'=> $trabajadores,
        'cliente'=>$persona,
            'empresa'=>$empresa,
            'moneda'=>$moneda,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
        ));
    }
    /*Controladores nuevos para los modals*/
    public function Oficina_ModalAction($request)
    {
        $nombre = $request->request->get('f1');
        $direcc = $request->request->get('f2');
        $email = $request->request->get('f3');
        $idpersona = $request->request->get('f4');
        $notas = $request->request->get('notas');
        $file = $_FILES['fichero']['name'];

        $em = $this->getDoctrine()->getManager();

        //
        $persona = $em->getRepository('AppBundle:Trabajadores')->find($idpersona);

        //
        // Metodo para SUBIR FICHEROS
        define('UPLOADPATH', 'files/uploads/Oficina');
        //
        $target = UPLOADPATH . $nombre . '/' . $file;

        if (!file_exists(UPLOADPATH . $nombre)) {
            mkdir(UPLOADPATH . $nombre);
        }
        //
        move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
        //
        $oficina = new Oficina();
        $oficina->setNombre($nombre);
        $oficina->setDireccion($direcc);
        $oficina->setEmail($email);
        $oficina->setTrabajadoresid($persona);
        $oficina->setNotas($notas);
        $oficina->setFichero($target);
        //
        $em = $this->getDoctrine()->getManager();
        $em->persist($oficina);
        $em->flush();
    }
    public function Cliente_ModalAction($request)
    {
        $nombre = $request->request->get('f1');
        $identificacion_fisica = $request->request->get('f2');
        $objetosocial = $request->request->get('f3');
        $grupo = $request->request->get('f4');
        $presidente = $request->request->get('f5');
        $direccion = $request->request->get('f6');
        $ciudad = $request->request->get('f7');
        $pais = $request->request->get('f8');
        $telefono = $request->request->get('f9');
        $correo = $request->request->get('f10');
        $web = $request->request->get('f11');
        $actividad = $request->request->get('f12');
        $descripcion = $request->request->get('f13');
        $notas = $request->request->get('notas');

        $em = $this->getDoctrine()->getManager();
        // Metodo para SUBIR FICHEROS
        define('UPLOADPATH', 'files/uploads/Clientes');
        //
        $file = $_FILES['fichero']['name'];
        $target = UPLOADPATH . $nombre . '/' . $file;

        if (!file_exists(UPLOADPATH . $nombre)) {
            mkdir(UPLOADPATH . $nombre);
        }
        //
        move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
        //
        $clientes = new Persona();
        $clientes->setNombreRazonsocial($nombre);
        $clientes->setIdentificacionFisica($identificacion_fisica);
        $clientes->setObjetosocial($objetosocial);
        $clientes->setGrupo($grupo);
        $clientes->setPresidente($presidente);
        $clientes->setDireccion($direccion);
        $clientes->setCiudad($ciudad);
        $clientes->setPais($pais);
        $clientes->setTelefono($telefono);
        $clientes->setEmail($correo);
        $clientes->setWeb($web);
        $clientes->setActividad($actividad);
        $clientes->setDescripcion($descripcion);
        $clientes->setNotas($notas);
        $clientes->setFichero($file);
        //
        $em = $this->getDoctrine()->getManager();
        $em->persist($clientes);
        $em->flush();
    }
    public function Servicio_ModalAction($request)
    {
        $serviciotext = $request->request->get('f1');
        $tipo = $request->request->get('f2');
        $desc = $request->request->get('f3');
        $precio = $request->request->get('f4');
        //
        $idmoneda = $request->request->get('f5');
        //
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($idmoneda);
        $notas = $request->request->get('notas');
        //
        // Metodo para SUBIR FICHEROS
        define('UPLOADPATH', 'files/uploads/Servicio');
        //
        $file = $_FILES['fichero']['name'];
        $target = UPLOADPATH . $serviciotext . '/' . $file;

        if (!file_exists(UPLOADPATH . $serviciotext)) {
            mkdir(UPLOADPATH . $serviciotext);
        }
        //
        move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
        //
        $servicio = new Servicio();
        $servicio->setServicio($serviciotext);
        $servicio->setTipo($tipo);
        $servicio->setDescripcion($desc);
        $servicio->setPrecio($precio);
        $servicio->setMonedaid($moneda);
        $servicio->setNotas($notas);
        $servicio->setFichero($target);
        //
        $em = $this->getDoctrine()->getManager();
        $em->persist($servicio);
        $em->flush();
    }
    public function Moneda_ModalAction($request)
    {
        $monedatext = $request->request->get('f1');
        $simbolo = $request->request->get('f2');
        $notas = $request->request->get('notas');

        $moneda = new Moneda();
        $moneda->setMoneda($monedatext);
        $moneda->setSimbolo($simbolo);
        $moneda->setNotas($notas);
        $em = $this->getDoctrine()->getManager();
        $em->persist($moneda);
        $em->flush();
    }
    public function Empresa_ModalAction($request)
    {
        $nombre = $request->request->get('f1');
        $cif = $request->request->get('f2');
        $direcc = $request->request->get('f3');
        $pais = $request->request->get('f4');
        $ciudad = $request->request->get('f5');
        $banco = $request->request->get('f6');
        $swift = $request->request->get('f7');
        $iban = $request->request->get('f8');
        $cuenta = $request->request->get('f9');
        $notas = $request->request->get('notas');
        //
        // Metodo para SUBIR FICHEROS
        define('UPLOADPATH', 'files/uploads/Empresa');
        //
        $file = $_FILES['fichero']['name'];
        $target = UPLOADPATH . $nombre . '/' . $file;

        if (!file_exists(UPLOADPATH . $nombre)) {
            mkdir(UPLOADPATH . $nombre);
        }
        //
        move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
        //
        $empresa = new Empresa();
        $empresa->setNombre($nombre);
        $empresa->setCif($cif);
        $empresa->setDireccion($direcc);
        $empresa->setPais($pais);
        $empresa->setCuidad($ciudad);
        $empresa->setBanco($banco);
        $empresa->setSwift($swift);
        $empresa->setIban($iban);
        $empresa->setCuenta($cuenta);
        $empresa->setNotas($notas);
        $empresa->setFichero($target);
        //
        $em = $this->getDoctrine()->getManager();
        $em->persist($empresa);
        $em->flush();
    }

    /**
     * @Route("/presupuesto/{name}", name="fichero_presupuesto")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Presupuesto/');
        $myDirectory = opendir(FICHERO_PATH . $name);
        //
        while ($entryName = readdir($myDirectory)) {
            $dirArray[] = $entryName;
        }
        // Closes directory
        closedir($myDirectory);
        // Counts elements in array
        //
        $indexCount=count($dirArray);
        //
        $names="";
        $i=0;
        for($index=0; $index < $indexCount;$index++) {
            // Gets File Names
            if($dirArray[$index]!='.' && $dirArray[$index]!='..' && $dirArray[$index]!=null){
                //
                $names= $dirArray[$index];
                $url = FICHERO_PATH.$name.'/'.$dirArray[$index];
                //
                $ficheros[$index]= array('file' =>$names, 'url'=>$url);
            }
        }
        return $this->render('presupuesto/ficheros.html.twig', array('ficheros' => $ficheros));

    }


}