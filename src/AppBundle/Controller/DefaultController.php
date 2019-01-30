<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/informacion/societaria/clientes", name="is_clientes")
     */
    public function info_clientes_Action(Request $request)
    {

        return $this->render('is/ver_por_clientes.html.twig');
    }
    /**
     * @Route("/informacion/societaria/empresas", name="is_empresas")
     */
    public function info_empresas_Action(Request $request)
    {

        return $this->render('is/ver_por_empresas.html.twig');
    }
}
