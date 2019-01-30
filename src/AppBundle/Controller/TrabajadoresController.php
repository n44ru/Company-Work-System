<?php
/**
 * Created by PhpStorm.
 * User: Carlos M
 * Date: 28/05/2016
 * Time: 11:53
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Trabajadores;

class TrabajadoresController extends Controller
{
    /**
     * @Route("/trabajadores", name="trabajadores_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->findAll();
        return $this->render('trabajadores/ver.html.twig', array('trabajadores' => $trabajadores));
    }

    /**
     * @Route("/trabajadores/detalles/{id}", name="trabajadores_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $trabajadores = $em->getRepository('AppBundle:Trabajadores')->find($id);
        return $this->render('trabajadores/detalles.html.twig', array('trabajadores' => $trabajadores));
    }

    /**
     * @Route("/trabajadores/insertar", name="trabajadores_insertar")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $tipo = $em->getRepository('AppBundle:Tipos')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $dni = $request->request->get('f2');
            $direccion = $request->request->get('f3');
            $ciudad = $request->request->get('f4');
            $pais = $request->request->get('f5');
            $telefono = $request->request->get('f6');
            $web = $request->request->get('f7');
            $correo = $request->request->get('f8');
            $descripcion = $request->request->get('f9');
            $id_oficina = $request->request->get('f11');
            $id_tipos = $request->request->get('f10');
            $notas = $request->request->get('notas');

            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Trabajadores/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //Fix
            if($id_oficina!='')
            $oficina = $em->getRepository('AppBundle:Oficina')->find($id_oficina);
            else $oficina=null;
            //End Fix
            $tipo = $em->getRepository('AppBundle:Tipos')->find($id_tipos);

            $clientes = new Trabajadores();
            $clientes->setNombre($nombre);
            $clientes->setDni($dni);
            $clientes->setDireccion($direccion);
            $clientes->setCiudad($ciudad);
            $clientes->setPais($pais);
            $clientes->setTelefono($telefono);
            $clientes->setWeb($web);
            $clientes->setCorreo($correo);
            $clientes->setDescripcion($descripcion);
            //
            $clientes->setOficinaid($oficina);
            $clientes->setTiposid($tipo);
            //
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('trabajadores_ver');
        }
        return $this->render('trabajadores/insertar.html.twig', array('oficina'=>$oficina, 'tipos'=>$tipo));
    }

    /**
     * @Route("/trabajadores/editar/{id}", name="trabajadores_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Trabajadores')->find($id);
        $oficina = $em->getRepository('AppBundle:Oficina')->findAll();
        $tipo = $em->getRepository('AppBundle:Tipos')->findAll();

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $dni = $request->request->get('f2');
            $direccion = $request->request->get('f3');
            $ciudad = $request->request->get('f4');
            $pais = $request->request->get('f5');
            $telefono = $request->request->get('f6');
            $web = $request->request->get('f7');
            $correo = $request->request->get('f8');
            $descripcion = $request->request->get('f9');
            $id_oficina = $request->request->get('f11');
            $id_tipos = $request->request->get('f10');
            $notas = $request->request->get('notas');

            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Trabajadores/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $oficina = $em->getRepository('AppBundle:Oficina')->find($id_oficina);
            $tipo = $em->getRepository('AppBundle:Tipos')->find($id_tipos);
            //
            $clientes->setNombre($nombre);
            $clientes->setDni($dni);
            $clientes->setDireccion($direccion);
            $clientes->setCiudad($ciudad);
            $clientes->setPais($pais);
            $clientes->setTelefono($telefono);
            $clientes->setWeb($web);
            $clientes->setCorreo($correo);
            $clientes->setDescripcion($descripcion);
            //
            $clientes->setOficinaid($oficina);
            $clientes->setTiposid($tipo);
            //
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('trabajadores_ver');
        }
        return $this->render('trabajadores/editar.html.twig', array('trabajadores' => $clientes,'oficina'=>$oficina, 'tipos'=>$tipo));
    }

    /**
     * @Route("/trabajadores/eliminar/{id}", name="trabajadores_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Trabajadores')->find($id);
        // Eliminando las relaciones de Presupuesto.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Presupuesto m WHERE m.trabajadoresid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Presupuesto')->find($empresa_pre[$i]['id']);
            $pre_actual->setTrabajadoresid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Tareas.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Tareas m WHERE m.trabajadoresid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Tareas')->find($empresa_pre[$i]['id']);
            $pre_actual->setTrabajadoresid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        $em->remove($clientes);
        $em->flush();
        return $this->redirectToRoute('trabajadores_ver');
    }

    /**
     * @Route("/trabajadores/{name}", name="fichero_trabajadores")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Trabajadores/');
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
        return $this->render('trabajadores/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}