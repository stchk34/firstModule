<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Our simple form class.
 *
 * @package Drupal\stchk34\Form
 */
class CatsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): CatsForm {
    $instance = parent::create($container);
    $instance->messenger = $container->get('messenger');
    $instance->database = $container->get('database');
    return $instance;
  }

  /**
   * Drupal\Core\Database defenition.
   *
   * @var \Drupal\Core\Database\Connection
   */
  public $database;

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'stchk34';
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
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'input',
        'progress' => 'none',
      ],
    ];

    $form['image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Your cat’s image:'),
      '#required' => TRUE,
      '#description' => $this->t('Valid extensions: jpeg, jpg, png. Max file size 2MB'),
      '#multiple' => FALSE,
      '#default_value' => $this->config('stchk34')->get('image'),
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
   * Form validation handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validateEmail($form, $form_state);
    if (strlen($form_state->getValue('cats_name')) < 2) {
      $form_state->setErrorByName('cats_name', $this->t('Name is too short.'));
    }
    elseif (strlen($form_state->getValue('cats_name')) > 32) {
      $form_state->setErrorByName('cats_name', $this->t('Name is too long.'));
    }
    if (!$valid) {
      $form_state->setErrorByName('email', $this->t('Invalid email'));
    }
  }

  /**
   * Email validation handler.
   *
   * @return bool
   *
   *   The current state of the form.
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
    $file_data = $form_state->getValue(['image']);
    $file = File::load($file_data[0]);
    if ($file !== NULL) {
      $file->setPermanent();
      $file->save();
      $this->database
        ->insert('stchk34')
        ->fields([
          'cats_name' => $form_state->getValue(['cats_name']),
          'email' => $form_state->getValue('email'),
          'image' => $form_state->getValue(['image'])[0],
          'date' => date(),
        ])
        ->execute();
    }
    $this->messenger->addStatus($this->t('Hi! You added your cat!'));
  }

  /**
   * Submit Ajax.
   */
  public function ajaxSubmit(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    if ($form_state->hasAnyErrors()) {
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
  public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
    $valid = $this->validateEmail($form, $form_state);
    $response = new AjaxResponse();
    if (!$valid) {
      $response->addCommand(new MessageCommand('Invalid Email', NULL, ['type' => 'error']));
    }
    else {
      $response->addCommand(new MessageCommand(''));
    }
    return $response;
  }

}
