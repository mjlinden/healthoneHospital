<?php


namespace App\Controller;


use App\Entity\Medicijn;
use App\Entity\Recept;
use App\Form\ReceptType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DokterController extends AbstractController
{
    /**
     * @Route("/dokter", name="dokter_homepage")
     */
    public function indexAction()
    {
        return $this->render('dokter/index.html.twig');
    }

    /**
     * @Route("/dokter/recepten", name="dokter_recepten")
     */
    public function receptenAction()
    {
        $repository=$this->getDoctrine()->getRepository(Recept::class);
        $recepten=$repository->findAll();
        return $this->render('dokter/recepten.html.twig',array('recepten'=>$recepten));

    }

    /**
     * @Route("/dokter/add", name="add_recept")
     */
    public function addAction(Request $request)
    {
        // create a medicijn
        $recept=new Recept();

        $form = $this->createForm(ReceptType::class, $recept);
        $form->add('save', SubmitType::class, array('label'=>"aanmaken"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();

            $this->addFlash(
                'notice',
                'recept toegevoegd!'
            );
            return $this->redirectToRoute('dokter_recepten');
        }

        return $this->render('dokter/add_recept.html.twig',array('form'=>$form->createView(),'naam'=>'toevoegen'));

    }
}