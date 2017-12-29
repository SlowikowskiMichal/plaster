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

class SecurityController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function afterLoginAction()
    {
        $user = $this->getUser();


        if(!$user)
        {
            $home = 'login';
        }
        else {
            $home = $user->getRole()->getRole()."Home";
        }

        return $this->redirectToRoute($home);
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $user = $this->getUser();


        if(!$user)
        {
            return $this->render('main/login.html.twig', array(

            ));
        }
        else {
            $home = $user->getRole()->getRole() . "Home";
            return $this->redirectToRoute($home);
        }
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
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
        return $this->redirectToRoute('login');
    }
}