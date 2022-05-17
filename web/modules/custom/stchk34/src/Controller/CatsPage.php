<?php

/**
 * @file 
 */

 namespace Drupal\stchk34\Controller;

 /**
  * Provides route for our custom module
  */
  class CatsPage{
 
    /**
     * Display simple page
     */
    public function content(){
        return array(
            '#markup' => 'Hello! You can add here a photo of your cat.',
        );
    }
  }
  