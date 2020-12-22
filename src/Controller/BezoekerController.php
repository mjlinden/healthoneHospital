<?php


namespace App\Controller;


use App\Entity\Medicijn;
use AppBundle\Entity\Soortactiviteit;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        return $this->render('bezoeker/index.html.twig');
    }
    /**
     * @Route("/medicijnen", name="medicijnen")
     */
    public function medicijnenAction()
    {
        $repository=$this->getDoctrine()->getRepository(Medicijn::class);
        $medicijnen=$repository->findAll();
        return $this->render('bezoeker/medicijnen.html.twig',array('medicijnen'=>$medicijnen));
    }




}