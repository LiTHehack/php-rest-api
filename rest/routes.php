<?php

require 'Slim/Slim.php';
require "database/books.php";
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/**
 * Index route
 */
$app->get('/', function(){
  echo "nothing more here";
});

/**
 * Get all books in the database
 */
$app->get('/books/', function () {
  $books = getAllBooks();

  echo json_encode($books);
});

/**
 * Get book by id
 */
$app->get('/books/:id', function ($id) {
  $book = getBookById($id);

  echo json_encode($book);
});

/**
 * Add book to database
 */
$app->post('/books/', function () {
  $request = \Slim\Slim::getInstance()->request();
  $book = json_decode( $request->getBody(), true );
  $response = saveBook($book);
  
  echo json_encode($response);
});

/**
 * Edit book
 */
$app->put('/books/:id/', function ($id) {
  $request = \Slim\Slim::getInstance()->request();
  $book = json_decode( $request->getBody(), true );
  $response = editBook($book, $id);

  echo json_encode($response);
});

/**
 * Delete book
 */
$app->delete('/books/:id/', function ($id) {
  $response = deleteBook($id);

  echo json_encode($response);
});

$app->run();