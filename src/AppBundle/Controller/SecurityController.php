<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 04.11.2017
 * Time: 17:20
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function afterLoginAction()
    {
        $user = $this->getUser();


        if(!$user) {
            $home = 'login';
        }
        elseif($user->getRoles() == ['ROLE_ADMIN']) {
            $home = 'userRegistration';
        }
        else {
            $home = $user->getRoles()[0]."Home";
        }

        return $this->redirectToRoute($home);
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $user = $this->getUser();

        $error = $authUtils->getLastAuthenticationError();

        if(!empty($error)){
            $this->addFlash('error', "Złe dane logowania!");
        }

        if(!$user)
        {
            return $this->render('main/login.html.twig', array(

            ));
        }
        elseif ($user->getRoles()[0] == "ROLE_ADMIN")
        {
            return $this->redirectToRoute('addressAptekiRegistration');
        }
        else {
            $home = $user->getRole()->getRole() . "Home";
            return $this->redirectToRoute($home);
        }
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('main/about.html.twig', array(
        ));
    }

    /**
     * @Route("/logout")
     * @throws \RuntimeException
     */
    public function logoutAction()
    {
        throw new \RuntimeException('This should never be called directly!');
    }
}