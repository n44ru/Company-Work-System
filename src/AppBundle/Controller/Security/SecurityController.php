<?php

namespace AppBundle\Controller\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'default/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function logoutAction(Request $request)
    {
    }
    /**
     * @Route("/admin/user/edit/{id}", name="myuser_edit")
     */
    public function myusereditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        //
        if ($request->request->count() > 1) {
            $pass = $request->request->get('password1');
            if ($pass != '' || $pass != null) {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($pass, $user->getSalt());
                //
                $user->setPassword($password);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/user/editar.html.twig', array('user' => $user));
    }
}