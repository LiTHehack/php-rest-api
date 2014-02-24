<?php

require 'Slim/Slim.php';
require 'database/users.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim;

/**
 * Index route
 */
$app->get('/', function(){
  echo "nothing more here";
});

/**
 * Get all users
 */
$app->get('/users/', function() {
  echo getUsers();
});

/**
 * Get user by name
 */
$app->get('/users/:name/', function($name) {
  echo getUserByName($name);
});

/**
 * Create new user
 */
$app->post('/users/', function() {
  $request = \Slim\Slim::getInstance()->request();
  $user = json_decode($request->getBody());

  echo createUser($user);
});

/**
 * Update user
 */
$app->put('/users/:id', function($id) {
  $request = \Slim\Slim::getInstance()->request();
  $user = json_decode($request->getBody());

  echo updateUser($id, $user);
});

/**
 * Delete user
 */
$app->delete('/users/:id', function($id) {
  echo deleteUser($id);
});

$app->run();