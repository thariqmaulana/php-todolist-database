<?php

// berbentuk interface karena sebuah bussines logic
// Sesuai nama service. tempat pelayanan, pengambilan data maupun pengiriman data

namespace Service {

    use Entity\Todolist;
    use Repository\TodolistRepository;

  interface TodolistService 
  {
    function showTodolist(): void;

    function addTodolist(string $todo): void;

    function removeTodolist(int $number): void;
  }

  class TodolistServiceImpl implements TodolistService
  {

    private TodolistRepository $todolistRepository;

    public function __construct(TodolistRepository $todolistRepository) {
      $this->todolistRepository = $todolistRepository;
    }

    function showTodolist(): void
    {
      echo "*** TODOLIST APP IS RUNNING >>> ***" . PHP_EOL;

      $todolist = $this->todolistRepository->findAll();
      // foreach ($todolist as $key => $value) {
      //   echo "$key. $value" . PHP_EOL;
      //   // jadi kalau pzn dia yg dimasukkan array adalah objnya
      // karena new Todolist
      //   // jadi disini baru diaskses getTodo
      // }
      // var_dump($todolist); tess liat isi
      foreach ($todolist as $key => $value) {
        // echo "$key. ". $value->getTodo() . PHP_EOL;
        echo $value->getId() .  ". " . $value->getTodo() . PHP_EOL;
        // jadi kalau pzn dia yg dimasukkan array adalah objnya
        // jadi disini baru diaskses getTodo
      }
    }

    function addTodolist(string $todo): void
    {
      // lihat nih. dia ambil input dari user ke variabel todolist
      // dan mengirim ke repository agar mengelola ke database
      // jadi service ini berhubungan langsung dengan IO user
      $todolist = new Todolist($todo);
      $this->todolistRepository->save($todolist);
      echo "SUKSES MENAMBAH TODOLIST" . PHP_EOL;
    }

    function removeTodolist(int $number): void
    {
      
      $result = $this->todolistRepository->remove($number);
      // $this->todolistRepository->remove($number);
      // di bawah hanya tambahan. karena semua sudah selesai di repository
      // sebenarnya. tentu di real app kita perlu memberi tahu user seperti ini
      
      // cara lain. langsung masukkan this->todolistrepo->remove(number)
      // ini kan resultnya sudah bool. jadi langsung masuk if bisa
      // tidak perlu == false
      if ($result == false) {
        echo "GAGAL MENGHAPUS TODOLIST" . PHP_EOL;
      } else {
        // $todolist = $this->todolistRepository->todolist[$number]->getTodo();
        // !!! kalau di todolist terakhir akan error. karena dia akan fetch apa?
        // hahaaaahahah
        // kalau todolist diatas. maka bagaimana akan fetch dengan number
        // yg tidak ada? maka akan error. jadi pastikan tidak false dulu
        // alias datanya ada
        echo "SUKSES MENGHAPUS TODOLIST`" . PHP_EOL;
      }
    }
  }

}