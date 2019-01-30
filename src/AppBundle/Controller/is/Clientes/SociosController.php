<?php

namespace AppBundle\Controller\is\Clientes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Socios;

class SociosController extends Controller
{
    /**
     * @Route("Clientes/Socios", name="socios_ver_clientes")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('AppBundle:Socios')->findAll();
        return $this->render('is/Clientes/Socios/ver.html.twig', array('s'=>$s));
    }
    /**
     * @Route("Clientes/Socios/detalles/{id}", name="socios_detalles_clientes")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('AppBundle:Socios')->find($id);
        return $this->render('is/Clientes/Socios/detalles.html.twig', array('s'=>$s));
    }
    /**
     * @Route("Clientes/Socios/eliminar/{id}", name="socios_eliminar_clientes")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Socios')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('socios_ver_clientes');
    }
    /**
     * @Route("Clientes/Socios/insertar", name="socios_insertar_clientes")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();

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
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
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

            $op->setPersonaid($c);
            $op->setEmpresaid(null);

            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('socios_ver_clientes');
        }
        return $this->render('is/Clientes/Socios/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Clientes/Socios/editar/{id}", name="socios_editar_clientes")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();
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
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
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
            $s->setPersonaid($c);
            $s->setEmpresaid(null);
            //
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('socios_ver_clientes');
        }
        return $this->render('is/Clientes/Socios/editar.html.twig', array('s'=>$s,'todos' => $clientes));
    }
    /**
     * @Route("Clientes/Socios/{name}", name="fichero_socios_clientes")
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
        return $this->render('is/Clientes/Socios/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}