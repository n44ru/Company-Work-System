<?php
/**
 * Created by PhpStorm.
 * User: Carlos M
 * Date: 28/05/2016
 * Time: 11:53
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tipos;

class TiposController extends Controller
{
    /**
     * @Route("/tipos", name="tipos_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('AppBundle:Tipos')->findAll();
        return $this->render('trabajadores/tipos/ver.html.twig', array('tipos'=>$tipos));
    }
    /**
     * @Route("/tipos/insertar", name="tipos_insertar")
     */
    public function insertarAction(Request $request)
    {
        if ($request->request->count() >= 1) {

            $nombre = $request->request->get('f1');
            $tipos = new Tipos();
            $tipos->setNombre($nombre);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipos);
            $em->flush();
            return $this->redirectToRoute('tipos_ver');
        }
        return $this->render('trabajadores/tipos/insertar.html.twig');
    }
    /**
     * @Route("/tipos/eliminar/{id}", name="tipos_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('AppBundle:Tipos')->find($id);
        $em->remove($tipos);
        $em->flush();
        return $this->redirectToRoute('empresa_ver');
    }
    /**
     * @Route("/tipos/editar/{id}", name="tipos_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('AppBundle:Tipos')->find($id);

        if ($request->request->count() >= 1) {

            $nombre = $request->request->get('f1');

            $tipos->setNombre($nombre);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipos);
            $em->flush();
            return $this->redirectToRoute('empresa_ver');
        }

        return $this->render('trabajadores/tipos/editar.html.twig', array('tipos' => $tipos));
    }
}