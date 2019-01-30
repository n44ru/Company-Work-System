<?php

namespace AppBundle\Controller\Proyectos;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tareas;

class TareasController extends Controller
{
    /**
     * @Route("/tareas", name="tareas_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tar = $em->getRepository('AppBundle:Tareas')->findAll();
        return $this->render('proyecto/tareas/ver.html.twig', array('tar'=>$tar));
    }
    /**
     * @Route("/tareas/detalles/{id}", name="tareas_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tar = $em->getRepository('AppBundle:Tareas')->find($id);
        return $this->render('proyecto/tareas/detalles.html.twig', array('tar'=>$tar));
    }
    /**
     * @Route("/tareas/eliminar/{id}", name="tareas_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tar = $em->getRepository('AppBundle:Tareas')->find($id);
        $em->remove($tar);
        $em->flush();
        return $this->redirectToRoute('tareas_ver');
    }
    /**
     * @Route("/tareas/insertar", name="tareas_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->findAll();
        $operaciones = $em->getRepository('AppBundle:Operaciones')->findAll();
        //

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $desc = $request->request->get('desc');
            $fechainicio = $request->request->get('fechainicio');
            $fechafin = $request->request->get('fechafin');
            $responsable = $request->request->get('trabajadores');
            $op = $request->request->get('operaciones');
            //
            $trabajadores = $em->getRepository('AppBundle:Trabajadores')->find($responsable);
            $operaciones = $em->getRepository('AppBundle:Operaciones')->find($op);
            //
            $notas = $request->request->get('notas');
            //Fix para el nombre
            $nombre= str_replace('/', '', $nombre);
            $nombre= str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Tareas/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $tar = new Tareas();
            $tar->setNombre($nombre);
            $tar->setDescripcion($desc);
            $tar->setFechaInicio($fechainicio);
            $tar->setFechaFin($fechafin);
            $tar->setTrabajadoresid($trabajadores);
            $tar->setOperacionesid($operaciones);
            $tar->setNotas($notas);
            $tar->setFichero($target);
            $em->persist($tar);
            $em->flush();

            return $this->redirectToRoute('tareas_ver');
        }
        return $this->render('proyecto/tareas/insertar.html.twig',array('trabajadores'=>$trabajadores, 'operaciones' => $operaciones));
    }
    /**
     * @Route("/tareas/editar/{id}", name="tareas_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->findAll();
        $operaciones = $em->getRepository('AppBundle:Operaciones')->findAll();
        $tar = $em->getRepository('AppBundle:Tareas')->find($id);

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $desc = $request->request->get('desc');
            $fechainicio = $request->request->get('fechainicio');
            $fechafin = $request->request->get('fechafin');
            $responsable = $request->request->get('trabajadores');
            $op = $request->request->get('operaciones');
            //
            $trabajadores = $em->getRepository('AppBundle:Trabajadores')->find($responsable);
            $operaciones = $em->getRepository('AppBundle:Operaciones')->find($op);
            $notas = $request->request->get('notas');
            //Fix para el nombre
            $nombre= str_replace('/', '', $nombre);
            $nombre= str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Tareas/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $tar->setNombre($nombre);
            $tar->setDescripcion($desc);
            $tar->setFechaInicio($fechainicio);
            $tar->setFechaFin($fechafin);
            $tar->setTrabajadoresid($trabajadores);
            $tar->setOperacionesid($operaciones);
            $tar->setNotas($notas);
            $tar->setFichero($target);
            $em->persist($tar);
            $em->flush();

            return $this->redirectToRoute('tareas_ver');
        }
        return $this->render('proyecto/tareas/editar.html.twig',array('trabajadores'=>$trabajadores,'operaciones'=>$operaciones, 'tar'=>$tar));
    }
    /**
     * @Route("/tareas/{name}", name="fichero_tareas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Tareas/');
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
        return $this->render('proyecto/tareas/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}