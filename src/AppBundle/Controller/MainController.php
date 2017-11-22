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

class MainController extends Controller
{
    /**
     * @Route("/zaloguj")
     */
    public function showAction()
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
    public function showAbout()
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

    public function login()
    {

    }
}