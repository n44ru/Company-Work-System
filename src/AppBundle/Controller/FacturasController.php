<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prefactura;
use AppBundle\Entity\Factura;

class FacturasController extends Controller
{
    /**
     * @Route("/Facturas/Crear/{id}", name="facturas_crear")
     */
    public function crearAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Prefactura')->find($id);
        $fac = new Factura();
        if($pre->getPresupuestoid()!= null) {
            $fac->setPresupuestoid($pre->getPresupuestoid());
        }
        $fac->setFechainicio($pre->getFechainicio());
        $fac->setFechafin($pre->getFechafin());
        $fac->setImporte($pre->getImporte());
        $fac->setCobrado('No');
        //Elaborar el numero de factura.
        $slice= substr($pre->getFechainicio(),6,4);
        $slice2= substr($pre->getFechainicio(),3,2);
        $final= $slice.'-'.$slice2.'-';
        $fac->setNumero($final);
        $em->persist($fac);
        $em->flush();
        $nombre = $fac->getId();
        if (!file_exists('files/uploads/Facturas/' . $nombre)) {
            mkdir('files/uploads/Facturas/' . $nombre);
        }

        // Aqui se pone si se desea eliminar la prefactura.
        return $this->redirectToRoute('prefacturas_eliminar', array('id'=> $id));
    }
    /**
     * @Route("/prefacturas", name="prefacturas_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Prefactura')->findAll();
        return $this->render('facturas/pre/ver.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/prefacturas/detalles/{id}", name="prefacturas_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Prefactura')->find($id);
        return $this->render('facturas/pre/detalles.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/prefacturas/eliminar/{id}", name="prefacturas_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Prefactura')->find($id);
        $em->remove($pre);
        $em->flush();
        return $this->redirectToRoute('prefacturas_ver');
    }

    /**
     * @Route("/prefacturas/editar/{id}", name="prefacturas_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $prefactura = $em->getRepository('AppBundle:Prefactura')->find($id);
        //
        $persona = $em->getRepository('AppBundle:Persona')->findAll();
        $empresa = $em->getRepository('AppBundle:Empresa')->findAll();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        //

        if ($request->request->count() > 1) {

            $fecha_inicio = $request->request->get('fecha_inicio');
            $fecha_fin = $request->request->get('fecha_fin');
            $serv = $request->request->get('f3');
            $ofi = $request->request->get('f4');
            $emp = $request->request->get('f5');
            $mon = $request->request->get('f6');
            $per = $request->request->get('f7');
            //
            $importe = $request->request->get('importe');
            //
            $presupuesto_id = $request->request->get('pre');
            //$prefactura_id = $request->request->get('prefac');

            if($presupuesto_id != null) {
                $pre = $em->getRepository('AppBundle:Presupuesto')->find($presupuesto_id);
                //
                $persona = $em->getRepository('AppBundle:Persona')->find($per);
                $empresa = $em->getRepository('AppBundle:Empresa')->find($emp);
                $moneda = $em->getRepository('AppBundle:Moneda')->find($mon);
                $oficina = $em->getRepository('AppBundle:Oficina')->find($ofi);
                $servicio = $em->getRepository('AppBundle:Servicio')->find($serv);
            }
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            $nombre=$prefactura->getId();
            define('UPLOADPATH', 'files/uploads/Prefacturas/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            if($presupuesto_id != null) {
                $pre->setPersonaid($persona);
                $pre->setEmpresaid($empresa);
                $pre->setMonedaid($moneda);
                $pre->setOficinaid($oficina);
                $pre->setServicioid($servicio);
                $pre->setImporte($importe);
                $em->persist($pre);
                $em->flush();
            }

                //
            if($presupuesto_id != null) {
                $prefactura->setPresupuestoid($pre);
            }
            else
            {
                $prefactura->setPresupuestoid(null);
            }
                $prefactura->setFechainicio($fecha_inicio);
                $prefactura->setFechafin($fecha_fin);
                $prefactura->setImporte($importe);
                $prefactura->setNotas($notas);
                $prefactura->setFichero($target);
                $em->persist($prefactura);
                $em->flush();

                return $this->redirectToRoute('prefacturas_ver');
            }

        return $this->render('facturas/pre/editar.html.twig',array('pre'=>$prefactura,
            'cliente'=>$persona,
            'empresa'=>$empresa,
            'moneda'=>$moneda,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
        ));
    }
    /**
     * @Route("/prefactura/{name}", name="fichero_prefactura")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Prefacturas/');
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
        return $this->render('facturas/pre/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}