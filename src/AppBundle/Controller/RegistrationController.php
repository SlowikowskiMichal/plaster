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
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register/user", name="userRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registeUserrAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class,$user, [

        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $user,
                    $user->getPlainPassword()
                )
            ;

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success',"Udało zarejestrować się nowego użytkownika");
            return $this->redirectToRoute('login');
        }

        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }

    /**
     *
     */

}