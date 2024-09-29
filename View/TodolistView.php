<?php

// View berbentuk class

// Kenapa tidak diberi parameter? karena view ini yang akan berhubungan langsung dengan user, menerima input
// dia hanya akan merender tampilan saja, bukan logic aplikasi

namespace View {

  require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Service/TodolistService.php";
require_once __DIR__ . "/../View/TodolistView.php";
require_once __DIR__ . "/../Helper/InputHelper.php";

    use Helper\InputHelper;
    use Repository\TodolistRepositoryImpl;
    use Service\TodolistService;
    use Service\TodolistServiceImpl;

  class TodolistView
  {

    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService) {
      $this->todolistService = $todolistService;
    }
    
    function showTodolist(): void
    {
      while (true) {
        // sebgaian this di view merujuk ke service
        // sebagian this di service ke repo. 
        // turun begitu jadi
        $this->todolistService->showTodolist();

        echo "MENU" . PHP_EOL;
        echo "1. Tambah Todo" . PHP_EOL;
        echo "2. Hapus Todo" . PHP_EOL;
        echo "x. Keluar" . PHP_EOL;

        $pilihan = InputHelper::input("Pilih");

        if ($pilihan == "1") {
          $this->addTodolist();
        } else if ($pilihan == "2") {
          $this->removeTodolist();
        } else if ($pilihan == "x") {
          break;
        } else {
          echo "Pilihan tidak dimengerti" . PHP_EOL;
        }
      }
      echo "Sampai Jumpa" . PHP_EOL;
    }

    function addTodolist(): void
    {
      echo "Menambah Todo" . PHP_EOL;

      $todo = InputHelper::input("Todo (x untuk batal)");

      if ($todo == "x") {
        echo "Batal Menambah Todo" . PHP_EOL;
      } else {
        $this->todolistService->addTodolist($todo);
      }
    }

    function removeTodolist(): void
    {
      echo "Menghapus Todo" . PHP_EOL;

      $number = InputHelper::input("Nomor todo (x untuk batal)");


      if ($number == "x") {
        echo "Batal menghapus todo" . PHP_EOL;
      } else {
        $this->todolistService->removeTodolist($number);
      }
    }

  }
}