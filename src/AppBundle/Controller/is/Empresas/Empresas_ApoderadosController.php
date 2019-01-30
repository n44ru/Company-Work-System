<?php

namespace AppBundle\Controller\is\Empresas;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Apoderados;

class Empresas_ApoderadosController extends Controller
{
    /**
     * @Route("Empresas/Apoderados", name="apo_ver_empresas")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Apoderados')->findAll();
        return $this->render('is/Empresas/Apoderados/ver.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Empresas/Apoderados/detalles/{id}", name="apo_detalles_empresas")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Apoderados')->find($id);
        return $this->render('is/Empresas/Apoderados/detalles.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Empresas/Apoderados/eliminar/{id}", name="apo_eliminar_empresas")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Apoderados')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('apo_ver_empresas');
    }
    /**
     * @Route("Empresas/Apoderados/insertar", name="apo_insertar_empresas")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $fecha_poder = $request->request->get('f3');
            $fecha_cese = $request->request->get('f4');
            $notas = $request->request->get('f5');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Apoderados/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Apoderados();
            $op->setNombre($nombre);
            $op->setTipo($tipo);
            $op->setFechapoder($fecha_poder);
            $op->setFechacese($fecha_cese);
            $op->setNotas($notas);

            $op->setPersonaid(null);
            $op->setEmpresaid($c);

            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('apo_ver_empresas');
        }
        return $this->render('is/Empresas/Apoderados/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Empresas/Apoderados/editar/{id}", name="apo_editar_empresas")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();
        //
        $op = $em->getRepository('AppBundle:Apoderados')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $fecha_poder = $request->request->get('f3');
            $fecha_cese = $request->request->get('f4');
            $notas = $request->request->get('f5');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Apoderados/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op->setNombre($nombre);
            $op->setTipo($tipo);
            $op->setFechapoder($fecha_poder);
            $op->setFechacese($fecha_cese);
            $op->setNotas($notas);
            //
            $op->setPersonaid(null);
            $op->setEmpresaid($c);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('apo_ver_empresas');
        }
        return $this->render('is/Empresas/Apoderados/editar.html.twig', array('a'=>$op,'todos' => $clientes));
    }
    /**
     * @Route("Empresas/Apoderados/{name}", name="fichero_apo_empresas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Apoderados/');
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
        return $this->render('is/Empresas/Apoderados/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}