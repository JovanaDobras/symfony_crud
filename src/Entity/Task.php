<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ORM\Table('tasks')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    #[ORM\ManyToOne(targetEntity: Employee::class, inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private $employee;

    #[ORM\Column(type: 'string', length: 255)]
    private $task_description;

    #[ORM\Column(type: 'string', length: 255)]
    private $task_deadline;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getTaskDescription(): ?string
    {
        return $this->task_description;
    }

    public function setTaskDescription(string $task_description): self
    {
        $this->task_description = $task_description;

        return $this;
    }

    public function getTaskDeadline(): ?string
    {
        return $this->task_deadline;
    }

    public function setTaskDeadline(string $task_deadline): self
    {
        $this->task_deadline = $task_deadline;

        return $this;
    }
}
