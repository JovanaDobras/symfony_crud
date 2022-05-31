<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    #[Route('/tasks', name: 'app_tasks')]
    public function AllTasks(EmployeeRepository $er): Response
    {

        $ispisi = $er->sortBySalary();

        return $this->render('tasks/index.html.twig', ['ispisi' => $ispisi]);
    }

    #[Route('tasksDeliverer', name: 'tasksDeliverer')]

    public function TasksDeliverer(TaskRepository $tr){

        $tasks = $tr->findAll();

        return $this->render('tasks/tasks.html.twig', ['tasks' => $tasks]);
    }

    #[Route('/tasks/{id}', name: 'tasksDetalji')]
    public function tasksDetalji($id,TaskRepository $tr, Request $request){

            $tasksDeliverer = $tr->filterByDeliverer($id);
            
            return $this->render('tasks/detalji.html.twig', ['tasks' => $tasksDeliverer]);

    }

}
