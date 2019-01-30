<?php

namespace AppBundle\Controller\is\Empresas;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Actascuentas;

class Empresas_ActasCuentasController extends Controller
{
    /**
     * @Route("Empresas/Actascuentas", name="ac_ver_empresas")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Actascuentas')->findAll();
        return $this->render('is/Empresas/Actascuentas/ver.html.twig', array('a'=>$a));

    }
    /**
     * @Route("Empresas/Actascuentas/detalles/{id}", name="ac_detalles_empresas")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Actascuentas')->find($id);
        return $this->render('is/Empresas/Actascuentas/detalles.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Empresas/Actascuentas/eliminar/{id}", name="ac_eliminar_empresas")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Actascuentas')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('ac_ver_empresas');
    }
    /**
     * @Route("Empresas/Actascuentas/insertar", name="ac_insertar_empresas")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $notas = $request->request->get('f2');
            // Insertar el Cliente Asociado.
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Actascuentas/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Actascuentas();
            $op->setNombre($nombre);
            $op->setNotas($notas);
            //
            $op->setPersonaid(null);
            $op->setEmpresaid($c);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('ac_ver_empresas');
        }
        return $this->render('is/Empresas/Actascuentas/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Empresas/Actascuentas/editar/{id}", name="ac_editar_empresas")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();
        $op = $em->getRepository('AppBundle:Actascuentas')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $notas = $request->request->get('f2');
            // Insertar el Cliente Asociado.
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Actascuentas/');
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
            $op->setNotas($notas);
            //
            $op->setPersonaid(null);
            $op->setEmpresaid($c);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('ac_ver_empresas');
        }
        return $this->render('is/Empresas/Actascuentas/editar.html.twig', array('a'=>$op,'todos' => $clientes));
    }
    /**
     * @Route("Empresas/Actascuentas/{name}", name="fichero_ac_empresas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Actascuentas/');
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
        return $this->render('is/Empresas/Actascuentas/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}