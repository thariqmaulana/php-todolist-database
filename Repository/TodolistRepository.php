<?php

// 2nd Layer : Repository

// Semua manipulasi data todolist dilakukan disini
// di kasus ini adalah menambah, menghapus, mengambil todolist

// Format Penamaan file repository
//  EntityRepository = TodolistRepository

// Dalam OOP, Logic, yaitu repository, service kita akan definisikan prototypenya dulu
// jadi interfacenya dulu
// akan berguna di unit test mocking

// kalau sudah berhubungan dengan DB maka repositorylah yg akan 
// berhubungan dengan DB
// Sesuai nama Repository. tempat menyimpan data

namespace Repository {

  use Entity\Todolist;
  use PDO;

  interface TodolistRepository
  {
    // tidak perlu saveTodolist. karena sudah jelas repository todolist
    function save(Todolist $todo): void;

    function remove(int $number): bool;

    function findAll(): array;
  }

  class TodolistRepositoryImpl implements TodolistRepository
  {
    // bisa diganti ke public dulu untuk testing jika belum impl add
    public array $todolist = [];

    private PDO $connection;

    public function __construct(PDO $connection)
    {
      $this->connection = $connection;
    }

    function save(Todolist $todolist): void
    {
      // $number = sizeof($this->todolist) + 1;
      // $this->todolist[$number] = $todolist; 

      $sql = "INSERT INTO todolist(todo) VALUES (?)";
      $statement = $this->connection->prepare($sql);
      $statement->execute([$todolist->getTodo()]);
    }

    function remove(int $number): bool
    {
      // if ($number > sizeof($this->todolist)) {
      //   return false;
      // } 

      // apakah perlu i? atau langsung number saja?
      // for ($i = $number; $i <= sizeof($this->todolist) ; $i++) { 
      //   // tidak lucu kalau unset di tengah langsung. jadi kosong nomornya
      //   // langsung lompat
      //   // makanya kita urutkan ulang di nomor yg dihapus dan setelahnya
      //   // hingga akhir
      //   // yg sebelumnya tidak perlu di otak-atik
      //   // $this->todolist[$i] = $this->todolist[$i + 1];// pas di arr terakhir bermasalah
      //   if ($i == sizeof($this->todolist)) {
      //     unset($this->todolist[sizeof($this->todolist)]);// nah baru yg terakhir dihapus
      //     return true;  
      //   } else {
      //     $this->todolist[$i] = $this->todolist[$i + 1];
      //     //fix
      //   }
      //   // data terakhir diisi value data + 1? padahal dia data terakhir
      //   // tinggal dimainkan if else
      //   // di versi pzn mungkin belum warning

      //   // yg masih perlu diperbaiki adalah ketika tidak memasukkan string angka
      // }

      $sql = "SELECT id FROM TODOLIST WHERE id = ?";
      $statement = $this->connection->prepare($sql);
      $statement->execute([$number]);

      if ($statement->fetch()) {
        $sql = "DELETE FROM TODOLIST WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$number]);
        return true;
      } else {
        return false;
      }

      // unset($this->todolist[sizeof($this->todolist)]);// nah baru yg terakhir dihapus

      // return true;
    }

    function findAll(): array
    {
      // $todo = array();
      $result = array();
      $sql = "SELECT id, todo FROM TODOLIST";
      $statement = $this->connection->prepare($sql);
      $statement->execute();

      // $todolist = $statement->fetchAll();
      // foreach ($todolist as $row) {
      //   $todo[$row['id']] = new Todolist($row['todo']);
      // }
      // // var_dump($todo);
      // return $todo;
      
      foreach ($statement as $row) {
        $todolist = new Todolist();
        $todolist->setId($row['id']);
        $todolist->setTodo($row['todo']);

        $result[] = $todolist;
      }

      // for ($i=0; $i <count($result) ; $i++) { 
      //   echo $result[$i]->getId() . PHP_EOL;
      // }

      return $result;
    }
  }
}
