<?php

/**
 * @file 
 */

 namespace Drupal\stchk34\Controller;

 use Drupal\Core\Controller\ControllerBase;

 /**
  * Provides route for our custom module
  */
  class CatsPage extends ControllerBase {
 
    /**
     * Display simple page
     */
    public function content():array {
        $form = \Drupal::formBuilder()->getForm('Drupal\stchk34\Form\CatsForm');
        $build['content'] =[
          '#markup'=> t('Hello! You can add here a photo of your cat.'),
          '#form' => $form,
        ];
        return $build;
    }
  }
 