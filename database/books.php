<?php

require "config.php";

function getAllBooks() {
  $sql = "SELECT * FROM books";
  
  $db = getConnection();
  $statement = $db->query($sql);
  $books = $statement->fetchAll(PDO::FETCH_OBJ);

  return $books;
}

function getBookById($id) {
  $sql = "SELECT * FROM books WHERE id = $id";

  $db = getConnection();
  $statement = $db->query($sql);
  $statement->execute();
  $book = $statement->fetchObject();

  return $book;
}

function saveBook($book) {
  $sql = "INSERT INTO books VALUES (:id, :title, :author, :year)";

  $db = getConnection();
  $statement = $db->prepare($sql);
  $statement->bindParam("id", $book['id']);
  $statement->bindParam("title", $book['title']);
  $statement->bindParam("author", $book['author']);
  $statement->bindParam("year", $book['year']);

  $statement->execute();

  $book['id'] = $db->lastInsertId();
  return $book;
}

function editBook($book, $id) {

  $sql = "UPDATE books SET 
            title = :title, 
            author = :author, 
            year = :year 
          WHERE id = :id";

  $db = getConnection();

  $statement = $db->prepare($sql);
  $statement->bindParam("id", $id);
  $statement->bindParam("title", $book['title']);
  $statement->bindParam("author", $book['author']);
  $statement->bindParam("year", $book['year']);

  $statement->execute();

  return $book;
}

function deleteBook($id) {

  $sql = "DELETE FROM books WHERE id = $id";

  $db = getConnection();
  $response = $db->query($sql);

  return $response;
}