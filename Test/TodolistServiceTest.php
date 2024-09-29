<?php

require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Service/TodolistService.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Config/Database.php";

use Entity\Todolist;
use PSpell\Config;
use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;

function testShowTodolist(): void
{
  $connection = \Config\Database::getConnection();
  $todolistRepository = new TodolistRepositoryImpl($connection);
  // $todolistRepository->todolist[1] = new Todolist("Belajar Java");
  // $todolistRepository->todolist[2] = new Todolist("Belajar PHP Database");
  // $todolistRepository->todolist[3] = new Todolist("Belajar PHP WEB");

  $todolistService = new TodolistServiceImpl($todolistRepository);

  $todolistService->showTodolist();
}

function testAddTodolist(): void
{
  $connection = \Config\Database::getConnection();
  $todolistRepository = new TodolistRepositoryImpl($connection);

  $todolistService = new TodolistServiceImpl($todolistRepository);
  $todolistService->addTodolist("Belajar PHP");
  $todolistService->addTodolist("Belajar PHP Database");
  $todolistService->addTodolist("Belajar PHP WEB");

  // $todolistService->showTodolist();
}

function testRemoveTodolist(): void
{
  $connection = \Config\Database::getConnection();
  $todolistRepository = new TodolistRepositoryImpl($connection);

  $todolistService = new TodolistServiceImpl($todolistRepository);

  // $todolistService->showTodolist();

  // $todolistService->addTodolist("Belajar PHP");
  // $todolistService->addTodolist("Belajar PHP Database");
  // $todolistService->addTodolist("Belajar PHP WEB");

  // $todolistService->showTodolist();

  echo PHP_EOL . PHP_EOL;

  // $todolistService->removeTodolist("adasd");
  $todolistService->removeTodolist(3);
  // $todolistService->removeTodolist(10);

  // $todolistService->showTodolist();


}

testShowTodolist();
// testAddTodolist();
// testRemoveTodolist();