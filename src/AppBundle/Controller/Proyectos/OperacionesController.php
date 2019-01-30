<?php

namespace AppBundle\Controller\Proyectos;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Operaciones;

class OperacionesController extends Controller
{
    /**
     * @Route("/operaciones", name="op_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $op = $em->getRepository('AppBundle:Operaciones')->findAll();
        return $this->render('proyecto/Operaciones/ver.html.twig', array('op'=>$op));
    }
    /**
     * @Route("/operaciones/detalles/{id}", name="op_detalles")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $op = $em->getRepository('AppBundle:Operaciones')->find($id);
        return $this->render('proyecto/Operaciones/detalles.html.twig', array('op'=>$op));
    }
    /**
     * @Route("/operaciones/eliminar/{id}", name="op_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $op = $em->getRepository('AppBundle:Operaciones')->find($id);

        // Eliminando las relaciones de Tareas.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Tareas m WHERE m.operacionesid = '.$id.'');
        $proy = $query_1->getResult();
        for($i=0;$i<count($proy);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Tareas')->find($proy[$i]['id']);
            $pre_actual->setOperacionesid(null);
            $em->persist($pre_actual);
            $em->flush();
        }

        $em->remove($op);
        $em->flush();
        return $this->redirectToRoute('op_ver');
    }
    /**
     * @Route("/operaciones/insertar", name="op_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $proy = $em->getRepository('AppBundle:Proyecto')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $despacho = $request->request->get('f3');
            $nombresolicita = $request->request->get('f4');
            $cargosolicita = $request->request->get('f5');
            $presenciapais = $request->request->get('f6');
            $descripcion = $request->request->get('f7');

            $montoestimado = $request->request->get('f9');
            $tecnologias = $request->request->get('f10');
            $experiencias = $request->request->get('f11');
            $notas = $request->request->get('f12');
            //

            $estado = $request->request->get('ef3');
            $tiempo = $request->request->get('ef4');

            $organo = $request->request->get('ef6');
            $fechacomienzo = $request->request->get('ef7');
            $fechafin = $request->request->get('ef8');
            //
            $id_proyecto = $request->request->get('proyecto');
            //
            $proy = $em->getRepository('AppBundle:Proyecto')->find($id_proyecto);

            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Operaciones/Ficheros/');
            define('UPLOADPATH2', 'files/uploads/Operaciones/Contratos/');
            define('UPLOADPATH3', 'files/uploads/Operaciones/Memos/');
            define('UPLOADPATH4', 'files/uploads/Operaciones/Timetable/');
            //
            $file = $_FILES['fichero']['name'];
            $file2 = $_FILES['fichero2']['name'];
            $file3 = $_FILES['fichero3']['name'];
            $file4 = $_FILES['fichero4']['name'];
            //
            $target = UPLOADPATH . $nombre . '/' . $file;
            $target2 = UPLOADPATH2 . $nombre . '/' . $file2;
            $target3 = UPLOADPATH3 . $nombre . '/' . $file3;
            $target4 = UPLOADPATH4 . $nombre . '/' . $file4;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            if (!file_exists(UPLOADPATH2 . $nombre)) {
                mkdir(UPLOADPATH2 . $nombre);
            }
            if (!file_exists(UPLOADPATH3 . $nombre)) {
                mkdir(UPLOADPATH3 . $nombre);
            }
            if (!file_exists(UPLOADPATH4 . $nombre)) {
                mkdir(UPLOADPATH4 . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            move_uploaded_file($_FILES['fichero2']['tmp_name'], $target2);
            move_uploaded_file($_FILES['fichero3']['tmp_name'], $target3);
            move_uploaded_file($_FILES['fichero4']['tmp_name'], $target4);
            //
            $op = new Operaciones();
            $op->setNombre($nombre);
            $op->setDespacho($despacho);
            $op->setNombresolicita($nombresolicita);
            $op->setCargosolicita($cargosolicita);
            $op->setPresenciapais($presenciapais);
            $op->setDescripcion($descripcion);
            $op->setMontoestimado($montoestimado);
            $op->setTecnologias($tecnologias);
            $op->setExperiencias($experiencias);
            $op->setNotas($notas);
            $op->setProyectoid($proy);
            //

            $op->setEstado($estado);
            $op->setTiempo($tiempo);

            $op->setOrganorelacion($organo);
            $op->setFechacomienzo($fechacomienzo);
            $op->setFechafin($fechafin);
            //
            $op->setFichero($target);
            $op->setFicheros2($target2);
            $op->setFicheros3($target3);
            $op->setFicheros4($target4);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('op_ver');
        }
        return $this->render('proyecto/Operaciones/insertar.html.twig', array('proyectos'=>$proy));
    }
    /**
     * @Route("/Operaciones/editar/{id}", name="op_editar")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $proyectos = $em->getRepository('AppBundle:Proyecto')->findAll();
        $op = $em->getRepository('AppBundle:Operaciones')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $despacho = $request->request->get('f3');
            $nombresolicita = $request->request->get('f4');
            $cargosolicita = $request->request->get('f5');
            $presenciapais = $request->request->get('f6');
            $descripcion = $request->request->get('f7');

            $montoestimado = $request->request->get('f9');
            $tecnologias = $request->request->get('f10');
            $experiencias = $request->request->get('f11');
            $notas = $request->request->get('f12');

            $estado = $request->request->get('ef3');
            $tiempo = $request->request->get('ef4');

            $organo = $request->request->get('ef6');
            $fechacomienzo = $request->request->get('ef7');
            $fechafin = $request->request->get('ef8');
            //
            $id_proyecto = $request->request->get('proyecto');
            $proy = $em->getRepository('AppBundle:Proyecto')->find($id_proyecto);

            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Operaciones/Ficheros/');
            define('UPLOADPATH2', 'files/uploads/Operaciones/Contratos/');
            define('UPLOADPATH3', 'files/uploads/Operaciones/Memos/');
            define('UPLOADPATH4', 'files/uploads/Operaciones/Timetable/');
            //
            $file = $_FILES['fichero']['name'];
            $file2 = $_FILES['fichero2']['name'];
            $file3 = $_FILES['fichero3']['name'];
            $file4 = $_FILES['fichero4']['name'];
            //
            $target = UPLOADPATH . $nombre . '/' . $file;
            $target2 = UPLOADPATH2 . $nombre . '/' . $file2;
            $target3 = UPLOADPATH3 . $nombre . '/' . $file3;
            $target4 = UPLOADPATH4 . $nombre . '/' . $file4;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            if (!file_exists(UPLOADPATH2 . $nombre)) {
                mkdir(UPLOADPATH2 . $nombre);
            }
            if (!file_exists(UPLOADPATH3 . $nombre)) {
                mkdir(UPLOADPATH3 . $nombre);
            }
            if (!file_exists(UPLOADPATH4 . $nombre)) {
                mkdir(UPLOADPATH4 . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            move_uploaded_file($_FILES['fichero2']['tmp_name'], $target2);
            move_uploaded_file($_FILES['fichero3']['tmp_name'], $target3);
            move_uploaded_file($_FILES['fichero4']['tmp_name'], $target4);
            //
            $op->setNombre($nombre);
            $op->setDespacho($despacho);
            $op->setNombresolicita($nombresolicita);
            $op->setCargosolicita($cargosolicita);
            $op->setPresenciapais($presenciapais);
            $op->setDescripcion($descripcion);

            $op->setMontoestimado($montoestimado);
            $op->setTecnologias($tecnologias);
            $op->setExperiencias($experiencias);
            $op->setNotas($notas);
            $op->setProyectoid($proy);
            //
            $op->setEstado($estado);
            $op->setTiempo($tiempo);
            $op->setOrganorelacion($organo);
            $op->setFechacomienzo($fechacomienzo);
            $op->setFechafin($fechafin);
            //
            $op->setFichero($target);
            $op->setFicheros2($target2);
            $op->setFicheros3($target3);
            $op->setFicheros4($target4);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('op_ver');
        }
        return $this->render('proyecto/Operaciones/editar.html.twig', array('proyectos'=>$proyectos , 'op'=>$op));
    }
    /**
     * @Route("/operaciones/ficheros/{name}", name="fichero_operaciones")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Operaciones/Ficheros/');
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
        return $this->render('proyecto/Operaciones/ficheros/ficheros.html.twig', array('ficheros' => $ficheros));

    }
    /**
     * @Route("/operaciones/TimeTable/{name}", name="fichero_timetable")
     */
    public function Ficheros2Action(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Operaciones/Timetable/');
        $myDirectory = opendir(FICHERO_PATH . $name);
        $dirArray= array();
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
        return $this->render('proyecto/Operaciones/ficheros/timetable.html.twig', array('ficheros' => $ficheros));
    }
    /**
     * @Route("/operaciones/Memos/{name}", name="fichero_memos")
     */
    public function Ficheros3Action(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Operaciones/Memos/');
        $myDirectory = opendir(FICHERO_PATH . $name);
        $dirArray= array();
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
        return $this->render('proyecto/Operaciones/ficheros/memos.html.twig', array('ficheros' => $ficheros));
    }
    /**
     * @Route("/operaciones/Contratos/{name}", name="fichero_contratos")
     */
    public function Ficheros4Action(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Operaciones/Contratos/');
        $myDirectory = opendir(FICHERO_PATH . $name);
        $dirArray= array();
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
        return $this->render('proyecto/Operaciones/ficheros/contratos.html.twig', array('ficheros' => $ficheros));
    }

}