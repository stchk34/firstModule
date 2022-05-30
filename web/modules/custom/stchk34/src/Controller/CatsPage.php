<?php

namespace Drupal\stchk34\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;

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

  /**
   * @param $id
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function delete($id): AjaxResponse {
    $response = new AjaxResponse();

    $delete_form = \Drupal::formBuilder()->getForm('Drupal\stchk34\Form\DeleteForm', $id);
    $response->addCommand(new OpenModalDialogCommand('Delete', $delete_form,
      [
        'width' => 350,
      ]
    ));

    return $response;
  }

  /**
   * Return modal window with edit form.
   */
  public function edit($id): AjaxResponse {
    $response = new AjaxResponse();

    $conn = $this->database()->select('stchk34', 's');
    $conn->fields('s', ['id', 'cats_name', 'email']);
    $conn->condition('id', $id);
    $results = $conn->execute()->fetchAssoc();

    $edit_form = $this->formBuilder()->getForm('Drupal\stchk34\Form\CatsForm', $results);
    $response->addCommand(new OpenModalDialogCommand('Edit', $edit_form, ['width' => 500]));

    return $response;
  }

}
