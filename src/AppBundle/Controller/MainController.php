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
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/main")
     */
    public function showAction()
    {
        $templating = $this->container->get('templating');
        $html = $templating->render('main/show.html.twig');

        return new Response($html);
    }
}