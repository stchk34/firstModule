<?php

namespace Drupal\stchk34\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;

/**
 * Provides route for our custom module.
 */
class CatsPage extends ControllerBase {

  /**
   * Display simple page.
   *
   * @return array
   *   Comment.
   */
  public function content() {
    $form = $this->formBuilder()->getForm('Drupal\stchk34\Form\CatsForm');
    $heading = [
      'cats_name' => $this->t('Cat name'),
      'email' => $this->t('E-mail'),
      'image' => $this->t('Cat image'),
      'date' => $this->t('Submitting date'),
    ];
    $table = [
      '#type' => 'table',
      '#header' => $heading,
      '#rows' => $this->getCatsInfo(),
    ];
    $build['content'] = [
      '#theme' => 'cat_page',
      '#header' => [
        '#type' => 'markup',
        '#markup' => $this->t('Hello! You can add here a photo of your cat.'),
      ],
      '#form' => $form,
      '#table' => $table,
    ];
    return $build;
  }

  /**
   * Get database.
   */
  public function getCatsInfo() {
    $output = \Drupal::database()->select('stchk34', 's')
      ->fields('s', ['cats_name', 'email', 'image', 'date'])
      ->orderBy('id', 'DESC')
      ->execute();
    $data = [];
    foreach ($output as $cat) {
      $data[] = [
        'name' => $cat->cats_name,
        'email' => $cat->email,
        'image' => File::load($cat->image)->getFileUri(),
        'date' => date('d-m-Y H:i:s', $cat->date),
      ];
    }
    return $data;
  }

}
