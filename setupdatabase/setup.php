<?php
include_once '../includes/dbh.inc.php';

/* create database*/
$query = "CREATE DATABASE urban_dictionary";
//$conn_create->query($query) or die ($conn->error);


/* Create table queries */

$query = "CREATE TABLE users(
  user_id INT(20) NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(50) NOT NULL,
  user_type ENUM('author', 'administrator'),
  PRIMARY KEY (user_id)
)";
$conn->query($query) or die ($conn->error);

$query = "CREATE TABLE topics(
  topic_id INT(20) NOT NULL AUTO_INCREMENT,
  topic_name VARCHAR(20) NOT NULL,
  user_id INT,
  PRIMARY KEY (topic_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
)";
$conn->query($query) or die ($conn->error);


$query = "CREATE TABLE entries(
  entry_id INT(20) NOT NULL AUTO_INCREMENT,
  title VARCHAR(20) NOT NULL,
  pub_date DATE NOT NULL,
  content VARCHAR(255),
  user_id INT,
  topic_id INT,
  PRIMARY KEY (entry_id),
  FOREIGN KEY (topic_id) REFERENCES topics(topic_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
)";
$conn->query($query) or die ($conn->error);



?>
