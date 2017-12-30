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
     * @Route("/register/addressapteki", name="addressAptekiRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAddressAptekiAction(Request $request)
    {
        $active="addressApteki";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/apteka", name="aptekaRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAptekaAction(Request $request)
    {
        $active="apteka";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/choroba", name="chorobaRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerChorobaAction(Request $request)
    {
        $active="choroba";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/godzinyprzyjec", name="godzinyPrzyjecRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerGodzinyPrzyjecAction(Request $request)
    {
        $active="godzinyPrzyjec";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/lek", name="lekRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerLekAction(Request $request)
    {
        $active="lek";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/lekarz", name="lekarzRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerLekarzAction(Request $request)
    {
        $active="lekarz";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/pacjent", name="pacjentRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerPacjentAction(Request $request)
    {
        $active="pacjent";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/stanmagazynu", name="stanMagazynuRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerStanMagazynuAction(Request $request)
    {
        $active="stanMagazynu";

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
            'active' => $active,
        ]);
    }

    /**
     * @Route("/register/user", name="userRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registeUserrAction(Request $request)
    {
        $active="user";

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
            'active' => $active,
        ]);
    }
}