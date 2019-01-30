<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prefactura;
use AppBundle\Entity\Factura;

class FacturasFinalController extends Controller
{
    /**
     * @Route("/facturas", name="facturas_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Factura')->findAll();
        return $this->render('facturas/fac/ver.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/facturas/detalles/{id}", name="facturas_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Factura')->find($id);
        return $this->render('facturas/fac/detalles.html.twig', array('pre'=>$pre));
    }
    /**
     * @Route("/facturas/eliminar/{id}", name="facturas_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pre = $em->getRepository('AppBundle:Factura')->find($id);
        $em->remove($pre);
        $em->flush();
        return $this->redirectToRoute('facturas_ver');
    }

    /**
     * @Route("/facturas/editar/{id}", name="facturas_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $factura = $em->getRepository('AppBundle:Factura')->find($id);
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

            $importe = $request->request->get('importe');
            $cobrado = $request->request->get('cobrado');
            //
            //$importe = $request->request->get('importe');
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
            $nombre=$factura->getId();
            define('UPLOADPATH', 'files/uploads/Facturas/');
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
                $em->persist($pre);
                $em->flush();
            }

            //
            if($presupuesto_id != null) {
                $factura->setPresupuestoid($pre);
            }
            else
            {
                $factura->setPresupuestoid(null);
            }
            $factura->setFechainicio($fecha_inicio);
            $factura->setFechafin($fecha_fin);
            $factura->setImporte($importe);
            $factura->setCobrado($cobrado);
            $factura->setNotas($notas);
            $factura->setFichero($target);
            //
            $em->persist($factura);
            $em->flush();

            return $this->redirectToRoute('facturas_ver');
        }

        return $this->render('facturas/fac/editar.html.twig',array('pre'=>$factura,
            'cliente'=>$persona,
            'empresa'=>$empresa,
            'moneda'=>$moneda,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
        ));
    }
    /**
     * @Route("/facturas/{name}", name="fichero_facturas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Facturas/');
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
        return $this->render('facturas/fac/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}