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

class AptekarzController extends Controller
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

        return $this->render('logged/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}