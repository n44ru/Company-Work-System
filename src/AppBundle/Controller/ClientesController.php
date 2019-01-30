<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Persona;

class ClientesController extends Controller
{
    /**
     * @Route("/clientes", name="clientes_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->findAll();
        return $this->render('clientes/ver.html.twig', array('clientes' => $clientes));
    }

    /**
     * @Route("/clientes/detalles/{id}", name="clientes_detalles")
     */
    public function detallesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->find($id);
        return $this->render('clientes/detalles.html.twig', array('clientes' => $clientes));
    }

    /**
     * @Route("/clientes/insertar", name="clientes_insertar")
     */
    public function insertarAction(Request $request)
    {
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $identificacion_fisica = $request->request->get('f2');
            $objetosocial = $request->request->get('f3');
            $grupo = $request->request->get('f4');
            $presidente = $request->request->get('f5');
            $direccion = $request->request->get('f6');
            $ciudad = $request->request->get('f7');
            $pais = $request->request->get('f8');
            $telefono = $request->request->get('f9');
            $correo = $request->request->get('f10');
            $web = $request->request->get('f11');
            $actividad = $request->request->get('f12');
            $descripcion = $request->request->get('f13');
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Clientes/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $clientes = new Persona();
            $clientes->setNombreRazonsocial($nombre);
            $clientes->setIdentificacionFisica($identificacion_fisica);
            $clientes->setObjetosocial($objetosocial);
            $clientes->setGrupo($grupo);
            $clientes->setPresidente($presidente);
            $clientes->setDireccion($direccion);
            $clientes->setCiudad($ciudad);
            $clientes->setPais($pais);
            $clientes->setTelefono($telefono);
            $clientes->setEmail($correo);
            $clientes->setWeb($web);
            $clientes->setActividad($actividad);
            $clientes->setDescripcion($descripcion);
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('clientes_ver');
        }
        return $this->render('clientes/insertar.html.twig');
    }

    /**
     * @Route("/clientes/editar/{id}", name="clientes_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->find($id);

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $identificacion_fisica = $request->request->get('f2');
            $objetosocial = $request->request->get('f3');
            $grupo = $request->request->get('f4');
            $presidente = $request->request->get('f5');
            $direccion = $request->request->get('f6');
            $ciudad = $request->request->get('f7');
            $pais = $request->request->get('f8');
            $telefono = $request->request->get('f9');
            $correo = $request->request->get('f10');
            $web = $request->request->get('f11');
            $actividad = $request->request->get('f12');
            $descripcion = $request->request->get('f13');
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Clientes/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $clientes->setNombreRazonsocial($nombre);
            $clientes->setIdentificacionFisica($identificacion_fisica);
            $clientes->setObjetosocial($objetosocial);
            $clientes->setGrupo($grupo);
            $clientes->setPresidente($presidente);
            $clientes->setDireccion($direccion);
            $clientes->setCiudad($ciudad);
            $clientes->setPais($pais);
            $clientes->setTelefono($telefono);
            $clientes->setEmail($correo);
            $clientes->setWeb($web);
            $clientes->setActividad($actividad);
            $clientes->setDescripcion($descripcion);
            $clientes->setNotas($notas);
            $clientes->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientes);
            $em->flush();
            return $this->redirectToRoute('clientes_ver');
        }
        return $this->render('clientes/editar.html.twig', array('clientes' => $clientes));
    }

    /**
     * @Route("/clientes/eliminar/{id}", name="clientes_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Persona')->find($id);
        // Eliminando las relaciones de Socios.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Socios m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Socios')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Administradores.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Administradores m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Administradores')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Apoderados.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Apoderados m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Apoderados')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de DomicilioSocial.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Domiciliosocial m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Domiciliosocial')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Denominacion Social.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Denominacionsocial m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Denominacionsocial')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de ActasCuentas.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Actascuentas m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Actascuentas')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Subclientes.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Subclientes m WHERE m.personaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Subclientes')->find($empresa_pre[$i]['id']);
            $pre_actual->setPersonaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        $em->remove($clientes);
        $em->flush();
        return $this->redirectToRoute('clientes_ver');
    }

    /**
     * @Route("/clientes/{name}", name="fichero_clientes")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Clientes/');
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
        return $this->render('clientes/ficheros.html.twig', array('ficheros' => $ficheros));

    }
}