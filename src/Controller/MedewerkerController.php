<?php


namespace App\Controller;


use App\Entity\Medicijn;
use App\Form\MedicijnType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        // create a medicijn
        $medicijn=new Medicijn();

        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->add('save', SubmitType::class, array('label'=>"voeg toe"));
        $form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($medicijn);
            $em->flush();

            $this->addFlash(
                'notice',
                'medicijn toegevoegd!'
            );
            return $this->redirectToRoute('medewerker_medicijnen');
        }

        return $this->render('medewerker/edit_medicijn.html.twig',array('form'=>$form->createView(),'naam'=>'toevoegen'));
    }

    /**
     * @Route("/medewerker/update/{id}", name="update_medicijn")
     */
    public function updateAction($id, Request $request)
    {
        $medicijn=$this->getDoctrine()
            ->getRepository(Medicijn::class)
            ->find($id);

        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->add('save', SubmitType::class, array('label'=>"aanpassen"));
        $form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($medicijn);
            $em->flush();

            $this->addFlash(
                'notice',
                'medicijn aangepast!'
            );
            return $this->redirectToRoute('medewerker_medicijnen');
        }

        return $this->render('medewerker/edit_medicijn.html.twig',array('form'=>$form->createView(),'naam'=>'aanpassen'));
    }

    /**
     * @Route("/medewerker/delete/{id}", name="delete_medicijn")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $medicijn= $this->getDoctrine()
            ->getRepository(Medicijn::class)->find($id);
        $em->remove($medicijn);
        $em->flush();

        $this->addFlash(
            'notice',
            'medicijn verwijderd!'
        );
        return $this->redirectToRoute('medewerker_medicijnen');
    }

}