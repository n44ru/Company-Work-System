<?php

namespace AppBundle\Controller\Legislacion;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Legislacion;
use AppBundle\Entity\Ltipos;

class LtiposController extends Controller
{
    /**
     * @Route("/ltipos", name="ltipos_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ltipos = $em->getRepository('AppBundle:Ltipos')->findAll();
        return $this->render('legislacion/tipos/ver.html.twig', array('ltipos'=>$ltipos));
    }
    /**
     * @Route("/ltipos/eliminar/{id}", name="ltipos_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ltipos = $em->getRepository('AppBundle:Ltipos')->find($id);
        $em->remove($ltipos);
        $em->flush();
        return $this->redirectToRoute('ltipos_ver');
    }
    /**
     * @Route("/ltipos/insertar", name="ltipos_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->count() >= 1) {

            $nombre = $request->request->get('nombre');
            $leg = new Ltipos();
            $leg->setNombre($nombre);
            $em->persist($leg);
            $em->flush();
            return $this->redirectToRoute('ltipos_ver');
        }
        return $this->render('legislacion/tipos/insertar.html.twig');
    }
    /**
     * @Route("/ltipos/editar/{id}", name="ltipos_editar")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $tipos = $em->getRepository('AppBundle:Ltipos')->find($id);
        //
        if ($request->request->count() >= 1) {

            $nombre = $request->request->get('nombre');

            $tipos->setNombre($nombre);

            $em->persist($tipos);
            $em->flush();
            return $this->redirectToRoute('ltipos_ver');
        }
        return $this->render('legislacion/tipos/editar.html.twig', array('ltipos'=>$tipos));
    }
}