<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function __construct(
        private DocumentManager $documentManager
    ) {
    }

    #[Route('/task/create', name: 'task_create')]
    public function createTaskAction() : Response
    {
        $task = new Task('Task ' . rand(1, 1000));
        $this->documentManager->persist($task);
        $this->documentManager->flush();
        
        return new Response('Created task id: ' . $task->getId());
    }

    #[Route('/task/list', name: 'task_list')]
    public function getTasksAction() : Response
    {
        $tasks = $this->documentManager->getRepository(Task::class)->findAll();

        $response = '';
        foreach ($tasks as $task) {
            $response .= $task->getId() . ' - ' . $task->getName() . PHP_EOL;
        }

        return new Response($response);
    }
}