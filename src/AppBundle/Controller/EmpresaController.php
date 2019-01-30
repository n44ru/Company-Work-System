<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Empresa;

class EmpresaController extends Controller
{
    /**
     * @Route("/empresa", name="empresa_ver")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('AppBundle:Empresa')->findAll();
        return $this->render('empresa/ver.html.twig', array('empresa'=>$empresa));
    }
    /**
     * @Route("/empresa/detalles/{id}", name="empresa_detalles")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('AppBundle:Empresa')->find($id);
        return $this->render('empresa/detalles.html.twig', array('empresa'=>$empresa));
    }
    /**
     * @Route("/empresa/insertar", name="empresa_insertar")
     */
    public function insertarAction(Request $request)
    {
        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $cif = $request->request->get('f2');
            $direcc = $request->request->get('f3');
            $pais = $request->request->get('f4');
            $ciudad = $request->request->get('f5');
            $banco = $request->request->get('f6');
            $swift = $request->request->get('f7');
            $iban = $request->request->get('f8');
            $cuenta = $request->request->get('f9');
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Empresa/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $empresa = new Empresa();
            $empresa->setNombre($nombre);
            $empresa->setCif($cif);
            $empresa->setDireccion($direcc);
            $empresa->setPais($pais);
            $empresa->setCuidad($ciudad);
            $empresa->setBanco($banco);
            $empresa->setSwift($swift);
            $empresa->setIban($iban);
            $empresa->setCuenta($cuenta);
            $empresa->setNotas($notas);
            $empresa->setFichero($target);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresa);
            $em->flush();
            return $this->redirectToRoute('empresa_ver');
        }

        return $this->render('empresa/insertar.html.twig');
    }
    /**
     * @Route("/empresa/eliminar/{id}", name="empresa_eliminar")
     */
    public function EliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('AppBundle:Empresa')->find($id);
        // Eliminando las relaciones de Socios.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Socios m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Socios')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Administradores.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Administradores m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Administradores')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Apoderados.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Apoderados m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Apoderados')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de DomicilioSocial.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Domiciliosocial m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Domiciliosocial')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de Denominacion Social.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Denominacionsocial m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Denominacionsocial')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }
        // Eliminando las relaciones de ActasCuentas.
        $query_1 = $em->createQuery('SELECT m.id FROM AppBundle:Actascuentas m WHERE m.empresaid = '.$id.'');
        $empresa_pre = $query_1->getResult();
        for($i=0;$i<count($empresa_pre);$i++)
        {
            $pre_actual = $em->getRepository('AppBundle:Actascuentas')->find($empresa_pre[$i]['id']);
            $pre_actual->setEmpresaid(null);
            $em->persist($pre_actual);
            $em->flush();
        }

        $em->remove($empresa);
        $em->flush();
        return $this->redirectToRoute('empresa_ver');
    }
    /**
     * @Route("/empresa/editar/{id}", name="empresa_editar")
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('AppBundle:Empresa')->find($id);

        if ($request->request->count() > 1) {

            $nombre = $request->request->get('f1');
            $cif = $request->request->get('f2');
            $direcc = $request->request->get('f3');
            $pais = $request->request->get('f4');
            $ciudad = $request->request->get('f5');
            $banco = $request->request->get('f6');
            $swift = $request->request->get('f7');
            $iban = $request->request->get('f8');
            $cuenta = $request->request->get('f9');
            $notas = $request->request->get('notas');
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Empresa/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $empresa->setNombre($nombre);
            $empresa->setCif($cif);
            $empresa->setDireccion($direcc);
            $empresa->setPais($pais);
            $empresa->setCuidad($ciudad);
            $empresa->setBanco($banco);
            $empresa->setSwift($swift);
            $empresa->setIban($iban);
            $empresa->setCuenta($cuenta);
            $empresa->setNotas($notas);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresa);
            $em->flush();
            return $this->redirectToRoute('empresa_ver');
        }

        return $this->render('empresa/editar.html.twig', array('empresa' => $empresa));
    }
    /**
     * @Route("/empresa/{name}", name="fichero_empresa")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        $dirArray=array();
        //
        define('FICHERO_PATH', 'files/uploads/Empresa/');
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
        return $this->render('empresa/ficheros.html.twig', array('ficheros' => $ficheros));

    }


}