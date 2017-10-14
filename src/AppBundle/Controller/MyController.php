<?php
/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 14.10.2017
 * Time: 20:09
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MyController
{
    /**
     * @Route("/")
     */
    public function startAction()
    {
        return new Response("Hello world!");
    }
}