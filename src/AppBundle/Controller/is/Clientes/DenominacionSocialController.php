<?php

namespace AppBundle\Controller\is\Clientes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Denominacionsocial;

class DenominacionSocialController extends Controller
{
    /**
     * @Route("Clientes/Denominacionsocial", name="dds_ver_clientes")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Denominacionsocial')->findAll();
        return $this->render('is/Clientes/Denominacionsocial/ver.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Clientes/Denominacionsocial/detalles/{id}", name="dds_detalles_clientes")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Denominacionsocial')->find($id);
        return $this->render('is/Clientes/Denominacionsocial/detalles.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Clientes/Denominacionsocial/eliminar/{id}", name="dds_eliminar_clientes")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Denominacionsocial')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('dds_ver_clientes');
    }
    /**
     * @Route("Clientes/Denominacionsocial/insertar", name="dds_insertar_clientes")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();

        if ($request->request->count() > 1) {

            $dds = $request->request->get('f1');
            $fecha = $request->request->get('f2');
            $notas = $request->request->get('f3');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //Fix
            $nombre=$dds;
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Denominacionsocial/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Denominacionsocial();
            $op->setDenominacionsocial($dds);
            $op->setFecha($fecha);
            $op->setNotas($notas);

            $op->setPersonaid($c);
            $op->setEmpresaid(null);

            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('dds_ver_clientes');
        }
        return $this->render('is/Clientes/Denominacionsocial/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Clientes/Denominacionsocial/editar/{id}", name="dds_editar_clientes")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();
        $op = $em->getRepository('AppBundle:Denominacionsocial')->find($id);
        //
        if ($request->request->count() > 1) {

            $dds = $request->request->get('f1');
            $fecha = $request->request->get('f2');
            $notas = $request->request->get('f3');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //Fix
            $nombre=$dds;
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Denominacionsocial/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op->setDenominacionsocial($dds);
            $op->setFecha($fecha);
            $op->setNotas($notas);
            //
            $op->setPersonaid($c);
            $op->setEmpresaid(null);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('dds_ver_clientes');
        }
        return $this->render('is/Clientes/Denominacionsocial/editar.html.twig', array('a'=>$op,'todos' => $clientes));
    }
    /**
     * @Route("Clientes/Denominacionsocial/{name}", name="fichero_dds_clientes")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Denominacionsocial/');
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
        return $this->render('is/Clientes/Denominacionsocial/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}