<?php

namespace AppBundle\Controller\Legislacion;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Legislacion;
use AppBundle\Entity\Ltipos;

class LegislacionController extends Controller
{
    /**
     * @Route("/legislacion", name="legislacion_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $leg = $em->getRepository('AppBundle:Legislacion')->findAll();
        return $this->render('legislacion/ver.html.twig', array('leg'=>$leg));
    }
    /**
     * @Route("/legislacion/detalles/{id}", name="legislacion_detalles")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $leg = $em->getRepository('AppBundle:Legislacion')->find($id);
        return $this->render('legislacion/detalles.html.twig', array('leg'=>$leg));
    }
    /**
     * @Route("/legislacion/eliminar/{id}", name="legislacion_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $leg = $em->getRepository('AppBundle:Legislacion')->find($id);
        $em->remove($leg);
        $em->flush();
        return $this->redirectToRoute('legislacion_ver');
    }
    /**
     * @Route("/legislacion/insertar", name="legislacion_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('AppBundle:Ltipos')->findAll();
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $tipos = $request->request->get('tipos');
            $notas = $request->request->get('notas');
            $ltipos = $em->getRepository('AppBundle:Ltipos')->find($tipos);

            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Legislacion/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $leg = new Legislacion();
            $leg->setNombre($nombre);
            $leg->setLtiposid($ltipos);
            $leg->setNotas($notas);
            $leg->setFichero($target);
            $em->persist($leg);
            $em->flush();
            return $this->redirectToRoute('legislacion_ver');
        }
        return $this->render('legislacion/insertar.html.twig', array('ltipos'=>$tipos));
    }
    /**
     * @Route("/legislacion/editar/{id}", name="legislacion_editar")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $tipos = $em->getRepository('AppBundle:Ltipos')->findAll();
        $leg = $em->getRepository('AppBundle:Legislacion')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $tipos = $request->request->get('tipos');
            $notas = $request->request->get('notas');
            $ltipos = $em->getRepository('AppBundle:Ltipos')->find($tipos);

            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Legislacion/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $leg->setNombre($nombre);
            $leg->setLtiposid($ltipos);
            $leg->setNotas($notas);
            $leg->setFichero($target);
            $em->persist($leg);
            $em->flush();
            return $this->redirectToRoute('legislacion_ver');
        }
        return $this->render('legislacion/editar.html.twig', array('ltipos'=>$tipos, 'leg'=>$leg));
    }
    /**
     * @Route("/legislacion/{name}", name="fichero_legislacion")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Legislacion/');
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
        return $this->render('legislacion/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}