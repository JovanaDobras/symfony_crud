<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeesType;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employes', name: 'employees_')]

class EmployesController extends AbstractController
{
    #[Route('/allEmployees', name: 'allEmployees')]
    public function AllEmployees(EmployeeRepository $er): Response
    {

        $employees = $er->findAll();


        return $this->render('employes/index.html.twig', ['employees' => $employees]);
    }

    #[Route('/employesDelete/{id}', name: 'delete')]

    public function DeleteEmployee($id, EmployeeRepository $er){

        $deleteEmployee = $er->find($id);
        $er->remove($deleteEmployee);
        $employees = $er->findAll();

        return $this->render('employes/index.html.twig', ['employees' => $employees]);

    }

    #[Route('/employesUpdate/{id}', name: 'update')]

    public function UpdateEmployees($id, EmployeeRepository $er, Request $request){

        $updateEmployee = $er->find($id);

        $form = $this->createForm(EmployeesType::class, $updateEmployee);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $editEmployee = $form->getData();
            $er->add($editEmployee,true);
            
            return $this->redirectToRoute('employees_allEmployees');
        }

        return $this->render('employes/updateEmployees.html.twig', ['form' => $form->createView()]);

    }

    #[Route('/employesAdd', name: 'add')]

    public function addEmployees(EmployeeRepository $er, Request $request){

        $newEmployee = new Employee();

        $form = $this->createForm(EmployeesType::class, $newEmployee);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newEmployee = $form->getData();
            $er->add($newEmployee);

            return $this->redirectToRoute('employees_allEmployees');
        }

        return $this->render('employes/addEmployee.html.twig', [ 'form' => $form->createView()]);

    }

    
}
