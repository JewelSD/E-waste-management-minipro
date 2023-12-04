<?php 
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: ../index.php');	
		exit;
	// since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to login
	}
  else
  {
    header('location: shopping/index.php');	
  }
  ?>