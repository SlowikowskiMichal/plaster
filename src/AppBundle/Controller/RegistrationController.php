<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 29.12.2017
 * Time: 17:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\AdressApteki;
use AppBundle\Entity\Apteka;
use AppBundle\Entity\Choroba;
use AppBundle\Entity\GodzinyPrzyjec;
use AppBundle\Entity\Lek;
use AppBundle\Entity\Lekarz;
use AppBundle\Entity\Pacjent;
use AppBundle\Entity\User;
use AppBundle\Form\AdressAptekiType;
use AppBundle\Form\AptekaType;
use AppBundle\Form\ChorobaType;
use AppBundle\Form\GodzinyPrzyjecType;
use AppBundle\Form\LekarzType;
use AppBundle\Form\LekType;
use AppBundle\Form\UserType;
use Doctrine\ORM\Mapping\Entity;
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
        $form = $this->constructForm(new AdressApteki(),AdressAptekiType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "addressApteki",
        ]);
    }

    /**
     * @Route("/register/apteka", name="aptekaRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAptekaAction(Request $request)
    {
        $form = $this->constructForm(new Apteka(),AptekaType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "apteka",
        ]);
    }

    /**
     * @Route("/register/choroba", name="chorobaRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerChorobaAction(Request $request)
    {
        $form = $this->constructForm(new Choroba(),ChorobaType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "choroba",
        ]);
    }

    /**
     * @Route("/register/godzinyprzyjec", name="godzinyPrzyjecRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerGodzinyPrzyjecAction(Request $request)
    {
        $form = $this->constructForm(new GodzinyPrzyjec(),GodzinyPrzyjecType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "godzinyPrzyjec",
        ]);
    }

    /**
     * @Route("/register/lek", name="lekRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerLekAction(Request $request)
    {
        $form = $this->constructForm(new Lek(),LekType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "lek",
        ]);
    }

    /**
     * @Route("/register/lekarz", name="lekarzRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerLekarzAction(Request $request)
    {
        $form = $this->constructForm(new Lekarz(),LekarzType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "lekarz",
        ]);
    }

    /**
     * @Route("/register/pacjent", name="pacjentRegistration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerPacjentAction(Request $request)
    {
        $form = $this->constructForm(new Pacjent(),Pacjent::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "pacjent",
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
    public function registerUserAction(Request $request)
    {
        $form = $this->constructForm(new User(),UserType::class,$request);
        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "user",
        ]);
    }

    /**
     * @param $entityToConstruct
     * @param $formClassType
     * @param Request $request
     * @return \Symfony\Component\Form\Form
     */
    private function constructForm($entityToConstruct, $formClassType, Request $request){

        $form = $this->createForm($formClassType,$entityToConstruct, [

        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($entityToConstruct);
            $em->flush();

            $this->addFlash('success',"Udało zarejestrować się Adres Apteki");
//            return $this->redirectToRoute('login');
        }
        return $form;
    }
}