<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(StudentRepository $repository): Response
    {
        $students = $repository->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/student/create", name="student_create")
     */
    public function create(Request $request): Response
    {
        $student = new Student();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($student);
            $em->flush();
        }

        return $this->render('student/create.html.twig', [
            'form_student' => $form->createView(),
        ]);
    }
}
