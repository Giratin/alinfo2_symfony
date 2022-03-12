<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    /**
     * @Route("/club/create", name="club_create")
     */
    public function create(Request $request): Response
    {
        $club = new Club();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($club);
            $em->flush();
        }

        return $this->render('club/create.html.twig', [
            'form_club' => $form->createView(),
        ]);
    }


    /**
     * @Route("/club/list", name="get_all_clubs")
     */
    public function getList(): Response
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020', 'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));

        return $this->render('club/list.html.twig', [
            'formations' =>  $formations,
        ]);
    }


    /**
     * @Route("/club/{nom}", name="get_club_by_name")
     */
    public function getName($nom): Response
    {
        return $this->render('club/detail.html.twig', [
            'name' => $nom,
        ]);
    }


}
