<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 11/05/2016
 * Time: 17.03
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Formapago;
use AppBundle\Entity\Prefactura;

class FormasPagoController extends Controller
{
    /**
     * @Route("/Propuesta/FP/{id}", name="fp_ver")
     */
    public function verAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        //$fp = $em->getRepository('AppBundle:Formapago')->find($id);
        $query = $em->createQuery('SELECT m FROM AppBundle:Formapago m WHERE m.presupuestoid = '.$id.'');
        $fp = $query->getResult();
        //
        $this->get('twig')->addGlobal('id_p', $id);
        //
        return $this->render('presupuesto/fp/ver.html.twig', array('fp'=>$fp));
    }
    /**
     * @Route("/Propuesta/FP/insertar/{id}", name="fp_insertar")
     */
    public function insertarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('twig')->addGlobal('id_p', $id);
        //
        if ($request->request->count() > 1) {

            $forma = $request->request->get('f1');
            $importe = $request->request->get('f2');
            $fecha_inicio = $request->request->get('f3');
            $fecha_fin = $request->request->get('f4');
            //
            $iva = $request->request->get('iva');
            $gs = $request->request->get('gs');
            //
            $total=$iva+$gs+$importe;
            $propuesta = $em->getRepository('AppBundle:Presupuesto')->find($id);
            //
            $fp = new Formapago();
            $fp->setFormapago($forma);
            $fp->setImporte($importe);
            $fp->setFechainicio($fecha_inicio);
            $fp->setFechafin($fecha_fin);
            $fp->setIva($iva);
            $fp->setGastossuplidos($gs);
            $fp->setTotal($total);
            //
            $fp->setPresupuestoid($propuesta);
            //
            $em->persist($fp);
            $em->flush();
            //Insertar Formas de Pago en las prefacturas.
            $name = $propuesta->getPersonaid()->getnombreRazonSocial();
            $pf= new Prefactura();
            $pf->setImporte($total);
            $pf->setFechainicio($fecha_inicio);
            $pf->setFechafin($fecha_fin);
            $pf->setNumero($fecha_inicio.'_'.$name);
            $pf->setPresupuestoid(null);
            $em->persist($pf);
            $em->flush();
            //
            return $this->redirectToRoute('fp_ver', array('id' =>$id));
        }

        return $this->render('presupuesto/fp/insertar.html.twig');
    }
    /**
     * @Route("/Propuesta/FP/{idfp}/editar/{id}", name="fp_editar")
     */
    public function editarAction(Request $request,$id, $idfp)
    {
        $em = $this->getDoctrine()->getManager();
        $fp = $em->getRepository('AppBundle:Formapago')->find($id);
        $this->get('twig')->addGlobal('id_p', $id);

        if ($request->request->count() > 1) {

            $forma = $request->request->get('f1');
            $importe = $request->request->get('f2');
            $fecha_inicio = $request->request->get('f3');
            $fecha_fin = $request->request->get('f4');
            //
            $iva = $request->request->get('iva');
            $gs = $request->request->get('gs');
            //
            $propuesta = $em->getRepository('AppBundle:Presupuesto')->find($idfp);
            //
            $total=$iva+$gs+$importe;
            //
            $fp->setFormapago($forma);
            $fp->setImporte($importe);
            $fp->setFechainicio($fecha_inicio);
            $fp->setFechafin($fecha_fin);
            $fp->setPresupuestoid($propuesta);
            $fp->setIva($iva);
            $fp->setGastossuplidos($gs);
            $fp->setTotal($total);
            $em->persist($fp);
            $em->flush();
            return $this->redirectToRoute('fp_ver', array('id' =>$idfp));
        }

        return $this->render('presupuesto/fp/editar.html.twig', array('fp' => $fp));
    }
    /**
     * @Route("/Propuesta/FP/{idfp}/eliminar/{id}", name="fp_eliminar")
     */
    public function eliminarAction(Request $request, $id, $idfp)
    {
        $em = $this->getDoctrine()->getManager();
        $fp = $em->getRepository('AppBundle:Formapago')->find($id);
        $em->remove($fp);
        $em->flush();
        return $this->redirectToRoute('fp_ver', array('id' =>$idfp));
    }
}