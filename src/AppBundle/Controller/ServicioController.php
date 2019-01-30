<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Servicio;

class ServicioController extends Controller
{
    /**
     * @Route("/servicio", name="servicio_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->findAll();
        return $this->render('servicio/ver.html.twig', array('servicio'=>$servicio));
    }
    /**
     * @Route("/servicio/detalles/{id}", name="servicio_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->find($id);
        return $this->render('servicio/detalles.html.twig', array('servicio'=>$servicio));
    }
    /**
     * @Route("/servicio/eliminar/{id}", name="servicio_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->find($id);

        // Eliminando las relaciones de Actividades.
        $query_1 = $em->createQuery('DELETE FROM AppBundle:Actserv m WHERE m.servicioid = '.$id.'');
        $query_1->getResult();

        // Eliminando las relaciones de Proyecto.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Proyecto m WHERE m.servicioid = '.$id.'');
        $serv = $query_1->getResult();
        for($i=0;$i<count($serv);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Proyecto')->find($serv[$i]['id']);
            $pre_actual->setServicioid(null);
            $em->persist($pre_actual);
            $em->flush();
        }

        $em->remove($servicio);
        $em->flush();
        return $this->redirectToRoute('servicio_ver');
    }
    /**
     * @Route("/servicio/editar/{id}", name="servicio_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();
        $servicio = $em->getRepository('AppBundle:Servicio')->find($id);

        if ($request->request->count() > 1) {

            $serviciotext = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $desc = $request->request->get('f3');
            $precio = $request->request->get('f4');
            //
            $idmoneda = $request->request->get('f5');
            //
//            if($idmoneda!='')
//            $moneda = $em->getRepository('AppBundle:Moneda')->find($idmoneda);
//            else $moneda=null;
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Servicio/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $serviciotext . '/' . $file;

            if (!file_exists(UPLOADPATH . $serviciotext)) {
                mkdir(UPLOADPATH . $serviciotext);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $servicio->setServicio($serviciotext);
            $servicio->setTipo($tipo);
            $servicio->setDescripcion($desc);
            $servicio->setPrecio($precio);
            $servicio->setMonedaid(null);
            $servicio->setNotas($notas);
            $servicio->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicio);
            $em->flush();
            return $this->redirectToRoute('servicio_ver');
        }
        return $this->render('servicio/editar.html.twig',array('moneda'=>$moneda,'servicio'=>$servicio));
    }
    /**
     * @Route("/servicio/insertar", name="servicio_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->findAll();

        if ($request->request->count() > 1) {

            $serviciotext = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $desc = $request->request->get('f3');
            //$precio = $request->request->get('f4');
            //
            $idmoneda = $request->request->get('f5');
            //
//            if($idmoneda!='')
//                $moneda = $em->getRepository('AppBundle:Moneda')->find($idmoneda);
//            else $moneda=null;
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Servicio/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $serviciotext . '/' . $file;

            if (!file_exists(UPLOADPATH . $serviciotext)) {
                mkdir(UPLOADPATH . $serviciotext);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $servicio = new Servicio();
            $servicio->setServicio($serviciotext);
            $servicio->setTipo($tipo);
            $servicio->setDescripcion($desc);
            //$servicio->setPrecio();
            $servicio->setMonedaid(null);
            $servicio->setNotas($notas);
            $servicio->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicio);
            $em->flush();
            return $this->redirectToRoute('servicio_ver');
        }

        return $this->render('servicio/insertar.html.twig',array('moneda'=>$moneda));
    }

    /**
     * @Route("/servicio/{name}", name="fichero_servicio")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Servicio/');
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
        return $this->render('servicio/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}