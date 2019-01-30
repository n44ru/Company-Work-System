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
use AppBundle\Entity\Cambio;

class CambioController extends Controller
{
    /**
     * @Route("/cambio", name="cambio_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cambio = $em->getRepository('AppBundle:Cambio')->findAll();
        return $this->render('cambio/ver.html.twig', array('cambio'=>$cambio));
    }
    /**
     * @Route("/cambio/insertar", name="cambio_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        //
        if ($request->request->count() > 1) {

            $monedaid = $request->request->get('f1');
            $tasa = $request->request->get('f3');
            $cambiopara = $request->request->get('f2');
            //
            $moneda = $em->getRepository('AppBundle:Moneda')->find($monedaid);
            //
            $cambio = new Cambio();
            $cambio->setMonedaid($moneda);
            $cambio->setMonedacambio($cambiopara);
            $cambio->setTasa($tasa);
            $em->persist($cambio);
            $em->flush();
            return $this->redirectToRoute('cambio_ver');
        }

        return $this->render('cambio/insertar.html.twig', array('moneda'=>$moneda));
    }
    /**
     * @Route("/cambio/editar/{id}", name="cambio_editar")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        $cambio=$em->getRepository('AppBundle:Cambio')->find($id);
        if ($request->request->count() > 1) {

            $monedaid = $request->request->get('f1');
            $tasa = $request->request->get('f3');
            $cambiopara = $request->request->get('f2');
            //
            $moneda = $em->getRepository('AppBundle:Moneda')->find($monedaid);
            //
            $cambio->setMonedaid($moneda);
            $cambio->setTasa($tasa);
            $cambio->setMonedacambio($cambiopara);
            $em->persist($cambio);
            $em->flush();
            return $this->redirectToRoute('cambio_ver');
        }

        return $this->render('cambio/editar.html.twig', array('moneda'=>$moneda, 'cambio'=>$cambio));
    }
    /**
     * @Route("/cambio/eliminar/{id}", name="cambio_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cambio = $em->getRepository('AppBundle:Cambio')->find($id);
        $em->remove($cambio);
        $em->flush();
        return $this->redirectToRoute('cambio_ver');
    }
}