<?php

require "config.php";

function getAllBooks() {
  $sql = "SELECT * FROM books";
  
  try{
    
    $db = getConnection();
    $statement = $db->query($sql);
    $books = $statement->fetchAll(PDO::FETCH_OBJ);
    return ["success" => true, "books" => $books];

  } catch (PDOException $e) {
    return ["success" => false, "error" => $e->errorInfo];
  }
}

function getBookById($id) {
  $sql = "SELECT * FROM books WHERE id = $id";

  try {
    $db = getConnection();
    $statement = $db->query($sql);
    $statement->execute();
    $book = $statement->fetchObject();
    return ["success" => true, "book" => $book];

  } catch (PDOException $e) {
    return ["success" => false, "error" => $e->errorInfo];
  }
}

function saveBook($book) {
  $sql = "INSERT INTO books VALUES (:id, :title, :author, :year)";
  
  try {
    $db = getConnection();
    $statement = $db->prepare($sql);
    $statement->bindParam("id", $book['id']);
    $statement->bindParam("title", $book['title']);
    $statement->bindParam("author", $book['author']);
    $statement->bindParam("year", $book['year']);

    $statement->execute();

    $book['id'] = $db->lastInsertId();
    return ["success" => true, "book" => $book];

  } catch (PDOException $e) {
    return ["success" => false, "error" => $e->errorInfo]; 
  }
}

function editBook($book, $id) {

  $sql = "UPDATE books SET 
            title = :title, 
            author = :author, 
            year = :year 
          WHERE id = :id";

  try {
    $db = getConnection();
    $statement = $db->prepare($sql);
    $statement->bindParam("id", $id);
    $statement->bindParam("title", $book['title']);
    $statement->bindParam("author", $book['author']);
    $statement->bindParam("year", $book['year']);

    $statement->execute();
    return ["success" => true, "book" => $book];

  } catch (PDOException $e) {
    return ["success" => false, "error" => $e->errorInfo];
  }
}

function deleteBook($id) {

  $sql = "DELETE FROM books WHERE id = $id";

  try {
    $db = getConnection();
    $response = $db->query($sql);
    
    return ["success" => true];

  } catch (PDOException $e) {
    return ["success" => false, "error" => $e->errorInfo];
  }
}