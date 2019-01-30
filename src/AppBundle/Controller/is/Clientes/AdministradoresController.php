<?php

namespace AppBundle\Controller\is\Clientes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Administradores;

class AdministradoresController extends Controller
{
    /**
     * @Route("Clientes/Admins", name="admins_ver_clientes")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Administradores')->findAll();
        return $this->render('is/Clientes/Admin/ver.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Clientes/Admins/detalles/{id}", name="admins_detalles_clientes")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Administradores')->find($id);
        return $this->render('is/Clientes/Admin/detalles.html.twig', array('a'=>$a));
    }
    /**
     * @Route("/Admins/eliminar/{id}", name="admins_eliminar_clientes")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Administradores')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('admins_ver_clientes');
    }
    /**
     * @Route("Clientes/Admins/insertar", name="admins_insertar_clientes")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $fecha_nomb = $request->request->get('f3');
            $fecha_cese = $request->request->get('f4');
            $notas = $request->request->get('f5');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Administradores/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Administradores();
            $op->setNombre($nombre);
            $op->setTipo($tipo);
            $op->setFechanomb($fecha_nomb);
            $op->setFechacese($fecha_cese);
            $op->setNotas($notas);
            $op->setPersonaid($c);
            $op->setEmpresaid(null);
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('admins_ver_clientes');
        }
        return $this->render('is/Clientes/Admin/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Clientes/Admins/editar/{id}", name="admins_editar_clientes")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();

        $op = $em->getRepository('AppBundle:Administradores')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $tipo = $request->request->get('f2');
            $fecha_nomb = $request->request->get('f3');
            $fecha_cese = $request->request->get('f4');
            $notas = $request->request->get('f5');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Administradores/');
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
            $op->setFechanomb($fecha_nomb);
            $op->setFechacese($fecha_cese);
            $op->setNotas($notas);
            //
            $op->setPersonaid($c);
            $op->setEmpresaid(null);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('admins_ver_clientes');
        }
        return $this->render('is/Clientes/Admin/editar.html.twig', array('a'=>$op,'todos' => $clientes));
    }
    /**
     * @Route("Clientes/Admin/{name}", name="fichero_admins_clientes")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Administradores/');
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
        return $this->render('is/Clientes/Admin/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}