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

    /**
     * @Route("registreren", name="registreren")
     */
    public function registreren(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, array('label'=>"registreren"));
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // 2.5) Is the user new, gebruikersnaam moet uniek zijn
            $repository=$this->getDoctrine()->getRepository(User::class);
            $bestaande_user=$repository->findOneBy(['username'=>$form->getData()->getUsername()]);

            if($bestaande_user==null)
            {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                $user->setRoles(['ROLE_USER']);
                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'notice',
                    $user->getNaam().' is geregistreerd!'
                );

                return $this->redirectToRoute('homepage');
            }
            else
            {
                $this->addFlash(
                    'error',
                    $user->getUsername()." bestaat al!"
                );
                return $this->render('bezoeker/registreren.html.twig', [
                    'form'=>$form->createView()
                ]);
            }
        }

        return $this->render('bezoeker/registreren.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        if (isset($error)) {
            $this->addFlash(
                'error',
                'Gegevens kloppen niet. Probeer opnieuw.'
            );
        } else {

            $this->addFlash(
                'notice',
                'Vul uw gegevens in'
            );
        }
        return $this->render('bezoeker/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

}