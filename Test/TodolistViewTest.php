<?php

require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Service/TodolistService.php";
require_once __DIR__ . "/../View/TodolistView.php";
require_once __DIR__ . "/../Helper/InputHelper.php";

use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;
use View\TodolistView;

function testViewShowTodolist(): void
{
  $todolistRepository = new TodolistRepositoryImpl();
  $todolistService = new TodolistServiceImpl($todolistRepository);
  $todolistView = new TodolistView($todolistService);

  $todolistService->addTodolist("Belajar PHP");
  $todolistService->addTodolist("Belajar PHP Database");
  $todolistService->addTodolist("Belajar PHP WEB");

  $todolistView->showTodolist();

}

function testViewAddTodolist(): void
{
  $todolistRepository = new TodolistRepositoryImpl();
  $todolistService = new TodolistServiceImpl($todolistRepository);
  $todolistView = new TodolistView($todolistService);

  $todolistView->showTodolist();
  // semua dari showTodolist. inilah awal menjalankan aplikasi
  // alias halaman awal
}

// testViewShowTodolist();
testViewAddTodolist();