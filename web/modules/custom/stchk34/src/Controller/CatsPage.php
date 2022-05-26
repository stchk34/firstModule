<?php

namespace Drupal\stchk34\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route for our custom module.
 */
class CatsPage extends ControllerBase {

  /**
   * Display simple page.
   *
   * @return array
   *   Input content
   */
  public function content() {
    $form = $this->formBuilder()->getForm('Drupal\stchk34\Form\CatsForm');
    $build['content'] = [
      '#markup' => $this->t('Hello! You can add here a photo of your cat.'),
      '#form' => $form,
    ];
    return $build;
  }

}
