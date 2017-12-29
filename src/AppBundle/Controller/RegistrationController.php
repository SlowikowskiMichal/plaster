<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 29.12.2017
 * Time: 17:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction()
    {
        $user = new User();

        $form = $this->createForm(UserType::class,$user, [

        ]);

        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }

}