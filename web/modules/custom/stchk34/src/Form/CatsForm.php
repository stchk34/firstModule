<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Our simple form class.
 *
 * @package Drupal\stchk34\Form
 */
class CatsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'stchk34_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return ['stchk34.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['cats_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat’s name:'),
      '#description' => $this->t('the minimum length of the name-2 and the maximum-32'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email:'),
      '#required' => TRUE,
      '#description' => $this->t('Email names can only contain Latin letters, underscores, or hyphens'),
      '#maxlength' => 25,
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'keyup',
      ],
    ];

    $form['cat_picture'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Your cat’s image:'),
      '#required' => TRUE,
      '#description' => $this->t('Valid extensions: jpeg, jpg, png. Max file size 2MB'),
      '#multiple' => FALSE,
      '#default_value' => $this->config('stchk34.settings')->get('cat_picture'),
      '#upload_location' => 'public://stchk34/cats',
      '#upload_validators' => [
        'file_validate_extensions' => ['jpeg jpg png'],
        'file_validate_size' => [2100000],
      ],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
      ],
    ];
    return $form;
  }

  /**
   * Validate form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('cats_name')) < 2) {
      $form_state->setErrorByName('cats_name', $this->t('Name is too short.'));
    }
    elseif (strlen($form_state->getValue('cats_name')) > 32) {
      $form_state->setErrorByName('cats_name', $this->t('Name is too long.'));
    }
  }

  /**
   * @return bool
   *   email validation.
   */
  protected function validateEmail(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $stableExpression = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    if (preg_match($stableExpression, $email)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $picture = $form_state->getValue('cat_picture');
    $data = [
      'cats_name' => $form_state->getValue('cats_name'),
      'email' => $form_state->getValue('email'),
      'timestamp' => time(),
      'cat_image' => $picture[0],
    ];

    $file = File::load($picture[0]);
    $file->setPermanent();
    $file->save();

    \Drupal::database()->insert('stchk34')->fields($data)->execute();
  }

  /**
   * @return \Drupal\Core\Ajax\AjaxResponse
   *
   *   Validation Email.
   */
  public function ajaxSubmit(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $valid = $this->validateEmail($form, $form_state);
    if ($form_state->hasAnyErrors() || !$valid) {
      foreach ($form_state->getErrors() as $errors_array) {
        $response->addCommand(new MessageCommand($errors_array));
      }
    }
    else {
      $response->addCommand(new MessageCommand('You added a cat!'));
    }
    $this->messenger()->deleteAll();
    return $response;
  }

  /**
   * @return \Drupal\Core\Ajax\AjaxResponse
   *
   *   Validation Email.
   */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state): AjaxResponse {
    $valid = $this->validateEmail($form, $form_state);
    $response = new AjaxResponse();
    if (!$valid) {
      $response->addCommand(new MessageCommand('Invalid Email'));
    }
    else {
      $response->addCommand(new MessageCommand('', ".null", [], TRUE));
    }
    return $response;
  }

}
