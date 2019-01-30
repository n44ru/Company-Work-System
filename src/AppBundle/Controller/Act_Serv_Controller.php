<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Actserv;
use AppBundle\Entity\Actividades;
use AppBundle\Entity\Servicio;

class Act_Serv_Controller extends Controller
{
    /**
     * @Route("/Servicios/Actividades", name="act_serv")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $todos = $em->getRepository('AppBundle:Actserv')->findAll();
        return $this->render('servicio/ActServ/ver.html.twig', array('actserv'=>$todos));
    }
    /**
     * @Route("/Servicios/Actividades/eliminar/{id}", name="act_serv_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $act_serv = $em->getRepository('AppBundle:Actserv')->find($id);
        $em->remove($act_serv);
        $em->flush();
        return $this->redirectToRoute('act_serv');
    }
    /**
     * @Route("/Servicios/Actividades/insertar", name="act_serv_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('AppBundle:Servicio')->findAll();
        $a = $em->getRepository('AppBundle:Actividades')->findAll();

        if ($request->request->count() > 1) {

            $serv = $request->request->get('f1');
            $act = $request->request->get('f2');
            //
            $s1 = $em->getRepository('AppBundle:Servicio')->find($serv);
            $a2 = $em->getRepository('AppBundle:Actividades')->find($act);

            // Actualizar el precio del servicio.
            $coste=$a2->getCoste();
            $precio=$s1->getPrecio();
            $precio_final = $precio+$coste;
            $s1->setPrecio($precio_final);
            $em->persist($s1);

            //$em->flush();
            //
            $act_serv = new Actserv();
            $act_serv->setServicioid($s1);
            $act_serv->setActividadesid($a2);
            //
            $em->persist($act_serv);
            $em->flush();
            return $this->redirectToRoute('act_serv');
        }
        return $this->render('servicio/ActServ/insertar.html.twig',array('s'=>$s, 'a' => $a));
    }
}