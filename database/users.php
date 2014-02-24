<?php 

require "config.php";

function getUsers() {
  
  $query = "SELECT * FROM users";
  $response = "";

  try{
    
    $db = getConnection();
    $stmt = $db->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;

    $response = [
      "sucess" => true,
      "users" => $users
    ];

  } catch (PDOException $e){
    $response = [
      "success" => false,
      "error" => $e->getMessage()
    ];
  }

  return json_encode( $response );
}

function getUserByName($name) {
  $query = "SELECT * FROM users WHERE username = '" . $name . "'";
  $response = "";

  try{
    
    $db = getConnection();
    $stmt = $db->query($query);
    $stmt->execute();
    $user = $stmt->fetchObject();
    $db = null;

    $response = [
      "sucess" => true,
      "user" => $user
    ];

  } catch (PDOException $e){
    $response = [
      "success" => false,
      "error" => $e->getMessage()
    ];
  }

  return json_encode( $response );
}

function createUser($user) {

  $response = "";
  $name = "";
  $pass = "";

  try{
    $name = $user->name;
    $pass = $user->pass;
  } catch (Exception $e) {
    $response = [
      "success" => false,
      "error" => "Malformed request body"
    ];

    return json_encode($response);
  }
  
  $query = "INSERT INTO users (id, username, password) VALUES ('', :name, :pass)";

  try{
    
    $db = getConnection();
    
    $stmt = $db->prepare($query);
    $stmt->bindParam("name", $name);
    $stmt->bindParam("pass", $pass);

    $stmt->execute();
    $user->id = $db->lastInsertId();
    $db = null;

    $response = [
      "sucess" => true,
      "user" => $user
    ];

  } catch (PDOException $e){
    $response = [
      "success" => false,
      "error" => $e
    ];
  }

  return json_encode( $response );
}

function updateUser($user) {

}

function deleteUserById($id) {

}