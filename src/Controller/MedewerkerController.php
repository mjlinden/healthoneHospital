<?php


namespace App\Controller;


use App\Entity\Medicijn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{

    /**
     * @Route("/medewerker", name="medewerker_homepage")
     */
    public function indexAction()
    {
        return $this->render('medewerker/index.html.twig');
    }

    /**
     * @Route("/medewerker/medicijnen", name="medewerker_medicijnen")
     */
    public function medicijnenAction()
    {
        $repository=$this->getDoctrine()->getRepository(Medicijn::class);
        $medicijnen=$repository->findAll();
        return $this->render('medewerker/medicijnen.html.twig',array('medicijnen'=>$medicijnen));

    }

    /**
     * @Route("/medewerker/add", name="add_medicijn")
     */
    public function addAction(Request $request)
    {
    }

    /**
     * @Route("/medewerker/update/{id}", name="update_medicijn")
     */
    public function updateAction($id, Request $request)
    {
    }

    /**
     * @Route("/medewerker/delete/{id}", name="delete_medicijn")
     */
    public function deleteAction($id)
    {
    }

}