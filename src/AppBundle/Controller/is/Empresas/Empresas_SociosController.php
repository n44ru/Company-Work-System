<?php

namespace AppBundle\Controller\is\Empresas;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Socios;

class Empresas_SociosController extends Controller
{
    /**
     * @Route("Empresas/Socios", name="socios_ver_empresas")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('AppBundle:Socios')->findAll();
        return $this->render('is/Empresas/Socios/ver.html.twig', array('s'=>$s));
    }
    /**
     * @Route("Empresas/Socios/detalles/{id}", name="socios_detalles_empresas")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('AppBundle:Socios')->find($id);
        return $this->render('is/Empresas/Socios/detalles.html.twig', array('s'=>$s));
    }
    /**
     * @Route("Empresas/Socios/eliminar/{id}", name="socios_eliminar_empresas")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Socios')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('socios_ver_empresas');
    }
    /**
     * @Route("Empresas/Socios/insertar", name="socios_insertar_empresas")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $acciones = $request->request->get('f2');
            $fechaadq = $request->request->get('f3');
            $accionescompradas = $request->request->get('f4');
            $venta = $request->request->get('f5');
            $accionesvendidas = $request->request->get('f6');
            $notas = $request->request->get('f7');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Socios/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Socios();
            $op->setNombre($nombre);
            $op->setAcciones($acciones);
            $op->setFechaadq($fechaadq);
            $op->setAccionescompradas($accionescompradas);
            $op->setVenta($venta);
            $op->setAccionesvendidas($accionesvendidas);
            $op->setNotas($notas);

            $op->setPersonaid(null);
            $op->setEmpresaid($c);

            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('socios_ver_empresas');
        }
        return $this->render('is/Empresas/Socios/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Empresas/Socios/editar/{id}", name="socios_editar_empresas")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();
        $s = $em->getRepository('AppBundle:Socios')->find($id);
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $acciones = $request->request->get('f2');
            $fechaadq = $request->request->get('f3');
            $accionescompradas = $request->request->get('f4');
            $venta = $request->request->get('f5');
            $accionesvendidas = $request->request->get('f6');
            $notas = $request->request->get('f7');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Socios/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $s->setNombre($nombre);
            $s->setAcciones($acciones);
            $s->setFechaadq($fechaadq);
            $s->setAccionescompradas($accionescompradas);
            $s->setVenta($venta);
            $s->setAccionesvendidas($accionesvendidas);
            $s->setNotas($notas);
            //
            $s->setPersonaid(null);
            $s->setEmpresaid($c);
            //
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('socios_ver_empresas');
        }
        return $this->render('is/Empresas/Socios/editar.html.twig', array('s'=>$s,'todos' => $clientes));
    }
    /**
     * @Route("Empresas/Socios/{name}", name="fichero_socios_empresas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Socios/');
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
        return $this->render('is/Empresas/Socios/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}