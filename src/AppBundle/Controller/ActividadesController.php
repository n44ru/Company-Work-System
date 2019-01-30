<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Actividades;
use AppBundle\Entity\Actserv;

class ActividadesController extends Controller
{
    /**
     * @Route("/actividades", name="actividades_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $act = $em->getRepository('AppBundle:Actividades')->findAll();
        return $this->render('actividades/ver.html.twig', array('act'=>$act));
    }
    /**
     * @Route("/actividades/detalles/{id}", name="actividades_detalles")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $act = $em->getRepository('AppBundle:Actividades')->find($id);
        return $this->render('actividades/detalles.html.twig', array('act'=>$act));
    }
    /**
     * @Route("/actividades/insertar", name="actividades_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $desc = $request->request->get('f2');
            $horas = $request->request->get('f3');
            $idservicio = $request->request->get('f4');
            //$precio = $request->request->get('f5');
            $coste = $request->request->get('f6');
            $notas = $request->request->get('notas');
            //Coste de un servicio y sumarlo.
            //$servicio = $em->getRepository('AppBundle:Servicio')->find($idservicio);
           // $preciototal = $servicio->Getprecio() + $precio;
            // Ahora actualizar e; servicio total.
            //$servicio->setPrecio($preciototal);
            //$em->persist($servicio);
            //$em->flush();
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Actividades/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $act = new Actividades();
            $act->setNombre($nombre);
            $act->setDescripcion($desc);
            $act->setHoras($horas);
            $act->setNotas($notas);
            //$act->setPrecio($precio);
            $act->setCoste($coste);
            //$act->setServicioid($servicio);
            $em->persist($act);
            $em->flush();
            return $this->redirectToRoute('actividades_ver');
        }

        return $this->render('actividades/insertar.html.twig', array('servicio'=>$servicio));
    }
    /**
     * @Route("/actividades/editar/{id}", name="actividades_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        //$servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        $act = $em->getRepository('AppBundle:Actividades')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $desc = $request->request->get('f2');
            $horas = $request->request->get('f3');
            //$idservicio = $request->request->get('f4');
            //$precio = $request->request->get('f5');
            $coste = $request->request->get('f6');
            $notas = $request->request->get('notas');

            //Coste de un servicio y sumarlo.
            //$servicio = $em->getRepository('AppBundle:Servicio')->find($idservicio);
            //$preciototal = $servicio->Getprecio() + $precio;
            // Ahora actualizar e; servicio total.
            //$servicio->setPrecio($preciototal);
            //$em->persist($servicio);
            //$em->flush();
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Actividades/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $act->setNombre($nombre);
            $act->setDescripcion($desc);
            $act->setHoras($horas);
            $act->setNotas($notas);
            //$act->setPrecio($precio);
            $act->setCoste($coste);
            //$act->setServicioid($servicio);
            $em->persist($act);
            $em->flush();
            //
            return $this->redirectToRoute('actividades_ver');
        }
        return $this->render('actividades/editar.html.twig', array('act'=>$act));
        }
    /**
     * @Route("/actividades/eliminar/{id}", name="actividades_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $act = $em->getRepository('AppBundle:Actividades')->find($id);
        $em->remove($act);
        $em->flush();
        return $this->redirectToRoute('actividades_ver');
    }

    /**
     * @Route("/actividades/{name}", name="fichero_actividades")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Actividades/');
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
        return $this->render('actividades/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}