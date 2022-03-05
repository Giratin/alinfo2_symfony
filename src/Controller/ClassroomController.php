<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/classroom/all", name="classroom_list")
     */
    public function list(ClassroomRepository $repository): Response {
        //$repository = $this->getDoctrine()->getRepository(Classroom::class);
        $classrooms = $repository->findAll();

        return $this->render("classroom/list.html.twig", array(
            'classrooms' => $classrooms
        ));
    }

    /**
     * @Route("/classroom/create", name="classroom_create")
     */
    public function Create(Request $req): Response {

        $em = $this->getDoctrine()->getManager();
        $classroom = new Classroom();

        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->handleRequest($req);

        if($form->isSubmitted() and $form->isValid()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirect("/classroom/all");
        }
        $isUpdate = false;
        return $this->render("classroom/create.html.twig", array(
            'formClass' => $form->createView(),
            'isUpdate' => $isUpdate
        ));
    }

    /**
     * @Route("/classroom/update/{id}", name="classroom_update")
     */
    public function Update(Request $req, $id, ClassroomRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository(Classroom::class);
        $classroom = $repository->find($id);

        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->handleRequest($req);
        $isUpdate = true;
        if($form->isSubmitted() and $form->isValid()){
            $em->flush();
            return $this->redirect("/classroom/all");
        }

        return $this->render("classroom/create.html.twig", array(
            'formClass' => $form->createView(),
            'isUpdate' => $isUpdate
        ));
    }
    /**
     * @Route("/classroom/delete/{id}", name="classroom_delete")
     */
    public function Delete(Request $req, $id, ClassroomRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository(Classroom::class);
        $classroom = $repository->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirect("/classroom/all");
    }
}
