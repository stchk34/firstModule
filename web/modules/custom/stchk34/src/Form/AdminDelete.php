<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;

/**
 * Class DeleteForm.
 *
 * @package Drupal\mymodule\Form
 */
class AdminDelete extends ConfirmFormBase {
  public $id;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('Meow.cats');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return t('Do you want to delete cat?');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return t('Cancel');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {

    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = \Drupal::database();
    $query->delete('stchk34')
      ->condition('id', $this->id)
      ->execute();
    \Drupal::messenger()->addStatus('Succesfully deleted.');
    $form_state->setRedirect('cats_list');
  }

}
