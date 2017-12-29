<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AptekaController extends Controller
{
    /**
     * @Route("/aptekarz/home")
     */
    public function showHome()
    {
        $level = 'aptekarz';

        $options = [
            'Home',
            'Recepty',
            'Magazyn',
            'Leki'
        ];

        return $this->render('logged/aptekarz/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/aptekarz/leki")
     */
    public function showLeki()
    {
        $level = 'aptekarz';

        $options = [
            'Home',
            'Recepty',
            'Magazyn',
            'Leki'
        ];

        return $this->render('logged/aptekarz/leki.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/aptekarz/magazyn")
     */
    public function showMagazyn()
    {
        $level = 'aptekarz';

        $options = [
            'Home',
            'Recepty',
            'Magazyn',
            'Leki'
        ];

        return $this->render('logged/aptekarz/magazyn.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/aptekarz/recepty")
     */
    public function showRecepty()
    {
        $level = 'aptekarz';

        $options = [
            'Home',
            'Recepty',
            'Magazyn',
            'Leki'
        ];

        return $this->render('logged/aptekarz/recepty.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}