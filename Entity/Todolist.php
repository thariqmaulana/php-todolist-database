<?php

// First Layer : Entity
// 1. Tahap pertama pembuatan aplikasi adalah membuat entity. 

// Agar terorganisir dengan baik
// mulai saat ini akan menerapkan namespace
// nama namespace sesuaikan nama folder

// Inilah isi dari array todolist nanti
// jadi bukan langsung string todolistnya apa
// tapi dibuat dalam bentuk obj

namespace Entity {

  class Todolist
  {
    private string $todo;

    private int $id;

    public function __construct(string $todo = "")
    {
      $this->todo = $todo;
    }

    public function getTodo(): string
    {
      return $this->todo;
    }

    public function setTodo(string $todo): void
    {
      $this->todo = $todo;
    }

    public function getId(): string
    {
      return $this->id;
    }

    public function setId(int $id): void
    {
      $this->id = $id;
    }
  }
}
