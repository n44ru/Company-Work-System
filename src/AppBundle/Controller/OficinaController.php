<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Oficina;

class OficinaController extends Controller
{
    /**
     * @Route("/oficina", name="oficina_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        return $this->render('oficina/ver.html.twig', array('oficina'=>$oficina));
    }
    /**
     * @Route("/oficina/detalles/{id}", name="oficina_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $oficina = $em->getRepository('AppBundle:Oficina')->find($id);
        return $this->render('oficina/detalles.html.twig', array('oficina'=>$oficina));
    }
    /**
     * @Route("/oficina/eliminar/{id}", name="oficina_eliminar")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $oficina = $em->getRepository('AppBundle:Oficina')->find($id);
        // Eliminando las relaciones de Presupuesto.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Proyecto m WHERE m.oficinaid = '.$id.'');
        $oficina_pre = $query_1->getResult();
        for($i=0;$i<count($oficina_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Proyecto')->find($oficina_pre[$i]['id']);
            $pre_actual->setOficinaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Trabajadores.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Trabajadores m WHERE m.oficinaid = '.$id.'');
        $oficina_pre = $query_1->getResult();
        for($i=0;$i<count($oficina_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Trabajadores')->find($oficina_pre[$i]['id']);
            $pre_actual->setOficinaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        $em->remove($oficina);
        $em->flush();
        return $this->redirectToRoute('oficina_ver');
    }
    /**
     * @Route("/oficina/editar/{id}", name="oficina_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('AppBundle:Trabajadores')->findAll();
        $oficina = $em->getRepository('AppBundle:Oficina')->find($id);

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $direcc = $request->request->get('f2');
            $email = $request->request->get('f3');
            //
            $idpersona = $request->request->get('f4');
            //
            $persona = $em->getRepository('AppBundle:Trabajadores')->find($idpersona);
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Oficina/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $oficina->setNombre($nombre);
            $oficina->setDireccion($direcc);
            $oficina->setEmail($email);
            $oficina->setTrabajadoresid($persona);
            $oficina->setNotas($notas);
            $oficina->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($oficina);
            $em->flush();
            return $this->redirectToRoute('oficina_ver');
        }

        return $this->render('oficina/editar.html.twig',array('cliente'=>$persona,'oficina'=>$oficina));
    }
    /**
     * @Route("/oficina/insertar", name="oficina_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('AppBundle:Trabajadores')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $direcc = $request->request->get('f2');
            $email = $request->request->get('f3');
            //
            $idpersona = $request->request->get('f4');
            //
            if($idpersona!='')
            $persona = $em->getRepository('AppBundle:Trabajadores')->find($idpersona);
            else $persona=null;
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Oficina/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $oficina = new Oficina();
            $oficina->setNombre($nombre);
            $oficina->setDireccion($direcc);
            $oficina->setEmail($email);
            $oficina->setTrabajadoresid($persona);
            $oficina->setNotas($notas);
            $oficina->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($oficina);
            $em->flush();
            return $this->redirectToRoute('oficina_ver');
        }

        return $this->render('oficina/insertar.html.twig',array('cliente'=>$persona));
    }
    /**
     * @Route("/oficina/{name}", name="fichero_oficina")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Oficina/');
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
        return $this->render('oficina/ficheros.html.twig', array('ficheros' => $ficheros));

    }


}