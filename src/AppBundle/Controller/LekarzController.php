<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:20
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LekarzController extends Controller
{
    /**
     * @Route("/lekarz/home")
     */
    public function showHome()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}