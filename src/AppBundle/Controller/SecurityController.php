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
        $level = '';

        $options = [
            'Zaloguj',
            'About'
        ];

        return $this->render('base.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $level = '';

        $options = [
            'Zaloguj',
            'About'
        ];

        return $this->render('main/login.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        $level = '';
        $options = [
            'Zaloguj',
            'About'
        ];

        return $this->render('main/about.html.twig', array(
            'options' => $options,
            'level' => $level
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