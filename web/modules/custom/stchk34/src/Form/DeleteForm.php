<?php

namespace Drupal\stchk34\Form;

/**
 * @file
 * Contains \Drupal\stchk34\Form\DeleteForm.
 */

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Cats delete form class.
 */
class DeleteForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL): array {
    $form['question'] = [
      '#markup' => '<p class="delete-question">' . $this->t('You really want ot delete it?') . '</p>',
    ];
    $form['actions']['delete'] = [
      '#type' => 'submit',
      '#value' => $this->t("Delete"),
    ];
    $form['id'] = [
      '#type' => 'hidden',
      '#value' => $id,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = $form_state->getValue('id');
    if ($id != NULL) {
      $conn = \Drupal::database()->delete('stchk34');
      $conn->condition('id', $id);
      $conn->execute();
      $form_state->setRedirect('stchk34.main');
    }
    else {
      \Drupal::database()->delete('stchk34')->execute();
      $form_state->setRedirect('stchk34.cats_list');
    }


    \Drupal::messenger()->addStatus($this->t("Delete successful"));
  }

}
