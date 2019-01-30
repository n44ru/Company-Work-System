<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Moneda;


class MonedaController extends Controller
{
    /**
     * @Route("/moneda", name="moneda_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        return $this->render('moneda/ver.html.twig', array('moneda'=>$moneda));
    }
    /**
     * @Route("/moneda/detalles/{id}", name="moneda_detalles")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($id);
        return $this->render('moneda/detalles.html.twig', array('moneda'=>$moneda));
    }
    /**
     * @Route("/moneda/insertar", name="moneda_insertar")
     */
    public function insertarAction(Request $request)
    {
        if ($request->request->count() > 1) {

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
            return $this->redirectToRoute('moneda_ver');
        }

        return $this->render('moneda/insertar.html.twig');
    }
    /**
     * @Route("/moneda/editar/{id}", name="moneda_editar")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($id);

        if ($request->request->count() > 1) {

            $moneda_editar = $request->request->get('f1');
            $simbolo = $request->request->get('f2');
            $notas = $request->request->get('notas');

            $moneda->setMoneda($moneda_editar);
            $moneda->setSimbolo($simbolo);
            $moneda->setFichero($notas);
            $em->persist($moneda);
            $em->flush();
            return $this->redirectToRoute('moneda_ver');
        }

        return $this->render('moneda/editar.html.twig',array('moneda'=>$moneda));
    }
    /**
     * @Route("/moneda/eliminar/{id}", name="moneda_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($id);
        // Eliminando las relaciones de Presupuesto.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Presupuesto m WHERE m.monedaid = '.$id.'');
        $moneda_pre = $query_1->getResult();
        for($i=0;$i<count($moneda_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Presupuesto')->find($moneda_pre[$i]['id']);
            $pre_actual->setMonedaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Servicio.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Servicio m WHERE m.monedaid = '.$id.'');
        $moneda_serv = $query_1->getResult();
        for($i=0;$i<count($moneda_serv);$i++)
        {
            $actual = $em->getRepository('AppBundle:Servicio')->find($moneda_serv[$i]['id']);
            $actual->setMonedaid(null);
            $em->persist($actual);
            $em->flush();
        }
        // Eliminando las relaciones de Tasas de Cambio.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Cambio m WHERE m.monedaid = '.$id.'');
        $moneda_cambio = $query_1->getResult();
        for($i=0;$i<count($moneda_cambio);$i++)
        {
            $actual = $em->getRepository('AppBundle:Cambio')->find($moneda_cambio[$i]['id']);
            $actual->setMonedaid(null);
            $em->persist($actual);
            $em->flush();
        }
        $em->remove($moneda);
        $em->flush();
        return $this->redirectToRoute('moneda_ver');
    }
}