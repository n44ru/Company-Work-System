<?php

namespace AppBundle\Controller\is\Empresas;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Domiciliosocial;

class Empresas_DomicilioSocialController extends Controller
{
    /**
     * @Route("Empresas/Domiciliosocial", name="ds_ver_empresas")
     */
    public function verAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Domiciliosocial')->findAll();
        return $this->render('is/Empresas/Domiciliosocial/ver.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Empresas/Domiciliosocial/detalles/{id}", name="ds_detalles_empresas")
     */
    public function detallesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AppBundle:Domiciliosocial')->find($id);
        return $this->render('is/Empresas/Domiciliosocial/detalles.html.twig', array('a'=>$a));
    }
    /**
     * @Route("Empresas/Domiciliosocial/eliminar/{id}", name="ds_eliminar_empresas")
     */
    public function eliminarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('AppBundle:Domiciliosocial')->find($id);
        $em->remove($exp);
        $em->flush();
        return $this->redirectToRoute('ds_ver_empresas');
    }
    /**
     * @Route("Empresas/Domiciliosocial/insertar", name="ds_insertar_empresas")
     */
    public function insertarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();

        if ($request->request->count() > 1) {

            $ds = $request->request->get('f1');
            $fecha = $request->request->get('f2');
            $notas = $request->request->get('f3');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre=$ds;
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Domiciliosocial/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op = new Domiciliosocial();
            $op->setDomiciliosocial($ds);
            $op->setFecha($fecha);
            $op->setNotas($notas);
            //
            $op->setPersonaid(null);
            $op->setEmpresaid($c);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('ds_ver_empresas');
        }
        return $this->render('is/Empresas/Domiciliosocial/insertar.html.twig', array('clientes' => $clientes));
    }
    /**
     * @Route("Empresas/Domiciliosocial/editar/{id}", name="ds_editar_empresas")
     */
    public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //
        $clientes = $em->getRepository('AppBundle:Empresa')->findAll();
        $op = $em->getRepository('AppBundle:Domiciliosocial')->find($id);
        //
        if ($request->request->count() > 1) {

            $ds = $request->request->get('f1');
            $fecha = $request->request->get('f2');
            $notas = $request->request->get('f3');
            //
            $cliente = $request->request->get('cliente');
            $c = $em->getRepository('AppBundle:Empresa')->find($cliente);
            //Fix
            $nombre=$ds;
            $nombre = str_replace('/', '', $nombre);
            $nombre = str_replace('\\', '', $nombre);
            //
            // Metodo para SUBIR FICHEROS
            define('UPLOADPATH', 'files/uploads/Domiciliosocial/');
            //
            $file = $_FILES['fichero']['name'];
            $target = UPLOADPATH . $nombre . '/' . $file;

            if (!file_exists(UPLOADPATH . $nombre)) {
                mkdir(UPLOADPATH . $nombre);
            }
            //
            move_uploaded_file($_FILES['fichero']['tmp_name'], $target);
            //
            $op->setDomiciliosocial($ds);
            $op->setFecha($fecha);
            $op->setNotas($notas);
            //
            $op->setPersonaid(null);
            $op->setEmpresaid($c);
            //
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('ds_ver_empresas');
        }
        return $this->render('is/Empresas/Domiciliosocial/editar.html.twig', array('a'=>$op,'todos' => $clientes));
    }
    /**
     * @Route("Empresas/Domiciliosocial/{name}", name="fichero_ds_empresas")
     */
    public function FicherosAction(Request $request, $name)
    {
        $ficheros=array();
        //
        define('FICHERO_PATH', 'files/uploads/Domiciliosocial/');
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
        return $this->render('is/Empresas/Domiciliosocial/ficheros.html.twig', array('ficheros' => $ficheros));

    }

}