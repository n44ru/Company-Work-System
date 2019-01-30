<?php
/**
 * Created by PhpStorm.
 * User: Carlos M
 * Date: 28/05/2016
 * Time: 10:44
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Subclientes;


class SubClientesController extends Controller
{
    /**
     * @Route("clientes/subclientes/{id}", name="clientes_subclientes")
     */
    public function verporidAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT m FROM AppBundle:Subclientes m WHERE m.personaid = '.$id.'');
        $clientes = $query->getResult();
        //
        $query2 = $em->createQuery('SELECT m FROM AppBundle:Persona m WHERE m.id = '.$id.'');
        $nombre = $query2->getResult();
        //
        $this->get('twig')->addGlobal('nombre', $nombre[0]);
        return $this->render('clientes/subclientes/ver_por_id.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("/subclientes", name="subclientes_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Subclientes')->findAll();
        return $this->render('clientes/subclientes/ver.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("/subclientes/detalles/{id}", name="subclientes_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Subclientes')->find($id);
        return $this->render('clientes/subclientes/detalles.html.twig', array('clientes' => $clientes));
    }

    /**
     * @Route("/subclientes/insertar", name="subclientes_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();
        //
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $cargo = $request->request->get('f2');
            $telefono = $request->request->get('f3');
            $descripcion = $request->request->get('f13');
            $correo = $request->request->get('f10');
            $notas = $request->request->get('notas');
            // Insertar el Cliente Asociado.
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/SubClientes/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $clientes = new Subclientes();
            $clientes->setNombre($nombre);
            $clientes->setCargo($cargo);
            $clientes->setTelefono($telefono);
            $clientes->setCorreo($correo);
            $clientes->setDescripcion($descripcion);
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            $clientes->setPersonaid($c);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('subclientes_ver');
        }
        return $this->render('clientes/subclientes/insertar.html.twig', array('clientes' => $clientes));
    }

    /**
     * @Route("/subclientes/editar/{id}", name="subclientes_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Subclientes')->find($id);
        $clientes_todos = $em->getRepository('AppBundle:Persona')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $cargo = $request->request->get('f2');
            $telefono = $request->request->get('f3');
            $correo = $request->request->get('f10');
            $descripcion = $request->request->get('f13');
            $notas = $request->request->get('notas');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Persona')->find($cliente);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/SubClientes/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $clientes->setNombre($nombre);
            $clientes->setCargo($cargo);
            $clientes->setTelefono($telefono);
            $clientes->setCorreo($correo);
            $clientes->setDescripcion($descripcion);
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            $clientes->setPersonaid($c);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('subclientes_ver');
        }
        return $this->render('clientes/subclientes/editar.html.twig', array('clientes' => $clientes, 'todos' => $clientes_todos));
    }

    /**
     * @Route("/subclientes/eliminar/{id}", name="subclientes_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Subclientes')->find($id);
        $em->remove($clientes);
        $em->flush();
        return $this->redirectToRoute('subclientes_ver');
    }

    /**
     * @Route("/subclientes/{name}", name="fichero_subclientes")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/SubClientes/');
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
        return $this->render('clientes/subclientes/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}