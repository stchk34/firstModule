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
      'timestamp' => $this->t('Submitting date'),
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
        '#markup' => '<div class="process-head">' . $this->t('Hello! You can add here a photo of your cat.') . '</div>',
      ],
      '#form' => $form,
      '#table' => $table,
    ];
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCatsInfo() {
    $output = \Drupal::database()->select('stchk34', 's')
      ->fields('s', ['cats_name', 'email', 'image', 'timestamp'])
      ->orderBy('id', 'DESC')
      ->execute();
    $data = [];
    foreach ($output as $cat) {
      $data[] = [
        'name' => $cat->cats_name,
        'email' => $cat->email,
        'image' => File::load($cat->image)->getFileUri(),
        'timestamp' => $cat->timestamp,
      ];
    }
    return $data;
  }

}
