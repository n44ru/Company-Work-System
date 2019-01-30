<?php

namespace AppBundle\Controller\Proyectos;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Proyecto;

class ProyectoController extends Controller
{
    /**
     * @Route("/proyecto", name="proyecto_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pro = $em->getRepository('AppBundle:Proyecto')->findAll();
        return $this->render('proyecto/ver.html.twig', array('pro'=>$pro));
    }
    /**
     * @Route("/proyecto/detalles/{id}", name="proyecto_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pro = $em->getRepository('AppBundle:Proyecto')->find($id);
        return $this->render('proyecto/detalles.html.twig', array('pro'=>$pro));
    }
    /**
     * @Route("/proyecto/eliminar/{id}", name="proyecto_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pro = $em->getRepository('AppBundle:Proyecto')->find($id);

        // Eliminando las relaciones de Operaciones.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Operaciones m WHERE m.proyectoid = '.$id.'');
        $proy = $query_1->getResult();
        for($i=0;$i<count($proy);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Operaciones')->find($proy[$i]['id']);
            $pre_actual->setProyectoid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        //
        $em->remove($pro);
        $em->flush();
        return $this->redirectToRoute('proyecto_ver');
    }
    /**
     * @Route("/proyecto/insertar", name="proyecto_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('AppBundle:Persona')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        //

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('nombre');
            $desc = $request->request->get('d');
            $fecha_inicio = $request->request->get('fecha_inicio');
            $fecha_fin = $request->request->get('fecha_fin');
            $serv = $request->request->get('f3');
            $ofi = $request->request->get('f4');
            $per = $request->request->get('f7');
            $presupuesto = $request->request->get('presupuesto');
            $obj = $request->request->get('objetivos');
            //
            $persona = $em->getRepository('AppBundle:Persona')->find($per);
            $oficina = $em->getRepository('AppBundle:Oficina')->find($ofi);
            $servicio = $em->getRepository('AppBundle:Servicio')->find($serv);

            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Proyectos/Ficheros/');
            //
            $file = $_FILES['fichero']['name'];
            //
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);


            // Controlar el Importe.
            $importe=$servicio->Getprecio();

            $pro = new Proyecto();
            $pro->setNombre($nombre);
            $pro->setDescripcion($desc);
            $pro->setPersonaid($persona);
            $pro->setOficinaid($oficina);
            $pro->setServicioid($servicio);
            $pro->setFechaInicio($fecha_inicio);
            $pro->setFechaFin($fecha_fin);
            $pro->setPresupuesto($presupuesto);
            $pro->setImporte($importe);
            $pro->setObjetivos($obj);
            $pro->setNotas($notas);
            $pro->setFichero($target);
            $em->persist($pro);
            $em->flush();

            return $this->redirectToRoute('proyecto_ver');
        }
        return $this->render('proyecto/insertar.html.twig',array(
            'cliente'=>$persona,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
        ));
    }

    /**
     * @Route("/proyecto/editar/{id}", name="proyecto_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pro = $em->getRepository('AppBundle:Proyecto')->find($id);
        //
        $persona = $em->getRepository('AppBundle:Persona')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        //

        if ($request->request->count() > 1) {
            $nombre = $request->request->get('nombre');
            $desc = $request->request->get('d');
            $fecha_inicio = $request->request->get('fecha_inicio');
            $fecha_fin = $request->request->get('fecha_fin');
            $serv = $request->request->get('f3');
            $ofi = $request->request->get('f4');
            $per = $request->request->get('f7');
            $presupuesto = $request->request->get('presupuesto');
            $obj = $request->request->get('objetivos');
            $impo = $request->request->get('importe');

            $persona = $em->getRepository('AppBundle:Persona')->find($per);
            $oficina = $em->getRepository('AppBundle:Oficina')->find($ofi);
            $servicio = $em->getRepository('AppBundle:Servicio')->find($serv);

            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Proyectos/Ficheros/');
            //
            $file = $_FILES['fichero']['name'];
            //
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $pro->setNombre($nombre);
            $pro->setDescripcion($desc);
            $pro->setPersonaid($persona);
            $pro->setOficinaid($oficina);
            $pro->setServicioid($servicio);
            $pro->setFechaInicio($fecha_inicio);
            $pro->setFechaFin($fecha_fin);
            $pro->setPresupuesto($presupuesto);
            $pro->setObjetivos($obj);
            $pro->setImporte($impo);
            $pro->setNotas($notas);
            $pro->setFichero($target);
            $em->persist($pro);
            $em->flush();

            return $this->redirectToRoute('proyecto_ver');
        }

        return $this->render('proyecto/editar.html.twig',array('pro'=>$pro,
            'cliente'=>$persona,
            'oficina'=>$oficina,
            'servicio'=>$servicio,
        ));
    }
    /**
     * @Route("/proyecto/ficheros/{name}", name="fichero_proyecto")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Proyectos/Ficheros/');
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
        return $this->render('proyecto/ficheros/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}