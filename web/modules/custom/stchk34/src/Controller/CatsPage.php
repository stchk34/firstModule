<?php

namespace Drupal\stchk34\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;

/**
 * Provides route for our custom module.
 *
 * @method database()
 */
class CatsPage extends ControllerBase {

  /**
   * Getting form from Catsform.
   */
  public function content() {
    $form = \Drupal::formBuilder()->getForm('\Drupal\stchk34\Form\CatsForm');
    return [
      '#theme' => 'cat_page',
      '#markup' => 'Hello! You can add here a photo of your cat.',
      '#form' => $form,
      '#list' => $this->getCatsInfo(),
    ];
  }

  /**
   * Get database.
   */
  public function getCatsInfo(): array {
    $current_user = \Drupal::currentUser();
    $roles = $current_user->getRoles();
    $admin = "administrator";
    $query = \Drupal::database();
    $result = $query->select('stchk34', 's')
      ->fields('s', ['cats_name', 'email', 'image', 'date', 'id'])
      ->orderBy('date', 'DESC')
      ->execute()->fetchAll();
    $data = [];
    foreach ($result as $row) {
      $file = File::load($row->image);
      $uri = $file->getFileUri();
      $catImage = [
        '#theme' => 'image',
        '#uri' => $uri,
        '#alt' => 'Cat',
        '#title' => 'Cat',
        '#width' => 255,
      ];
      $variable = [
        'cats_name' => $row->cats_name,
        'email' => $row->email,
        'image' => [
          'data' => $catImage,
        ],
        'date' => date('d-m-Y H:i:s', $row->date),
      ];
      if (in_array($admin, $roles)) {
        $url = Url::fromRoute('delete_form', ['id' => $row->id]);
        $url_edit = Url::fromRoute('edit_form', ['id' => $row->id]);
        $project_link = [
          '#title' => 'Delete',
          '#type' => 'link',
          '#url' => $url,
          '#attributes' => [
            'class' => ['use-ajax'],
            'data-dialog-type' => 'modal',
          ],
          '#attached' => [
            'library' => ['core/drupal.dialog.ajax'],
          ],
        ];
        $link_edit = [
          '#title' => 'Edit',
          '#type' => 'link',
          '#url' => $url_edit,
          '#attributes' => [
            'class' => ['use-ajax'],
            'data-dialog-type' => 'modal',
          ],
          '#attached' => [
            'library' => ['core/drupal.dialog.ajax'],
          ],
        ];
        $variable['link'] = [
          'data' => [
            "#theme" => 'operations',
            'delete' => $project_link,
            'edit' => $link_edit,
          ],
        ];
      }
      $data[] = $variable;
    }
    $build['table'] = [
      '#type' => 'table',
      '#rows' => $data,
    ];
    return $build;
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
