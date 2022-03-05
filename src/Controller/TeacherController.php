<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="teacher")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Teacher::class);
        $teachers = $repository->findById(1);

        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    /**
     * @Route("/teacher/create", name="create_teacher")
     */
    public function create(Request $request): Response
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if( $form->isSubmitted() and $form->isValid()){
            $em->persist($teacher);
            $em->flush();
            //return $this->redirect('/teacher');
        }

        return $this->render('teacher/create.html.twig', [
            'teacher_form' => $form->createView(),
        ]);
    }


}
