<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form for adding cats.
 *
 * @method database()
 * @property \Drupal\Core\Database\Connection|mixed|object|null $database
 * @property mixed|null $id
 */
class EditCat extends FormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): EditCat {
    $instance = parent::create($container);
    $instance->messenger = $container->get('messenger');
    $instance->database = $container->get('database');
    return $instance;
  }

  /**
   * Cats ids storaging.
   *
   * @var null
   */
  public $id;

  /**
   * Drupal\Core\Database defenition.
   *
   * @var object
   */
  protected object $cat;

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return "edit_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {
    $this->id = $id;
    $query = $this->database();
    $data = $query
      ->select('stchk34', 's')
      ->condition('s.id', $id, '=')
      ->fields('s', ['cats_name', 'email', 'image', 'id'])
      ->execute()->fetchAll();
    $form['cats_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat’s name:'),
      '#default_value' => $data[0]->cats_name,
      '#required' => TRUE,
      '#prefix' => '<div class="error-message-modal"></div>',
    ];
    $form['email'] = [
      '#title' => $this->t('Your email:'),
      '#type' => 'email',
      '#required' => TRUE,
      '#default_value' => $data[0]->email,
      '#suffix' => '<div class="email-message-modal"></div>',
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'input',
      ],
    ];
    $form['image'] = [
      '#title' => 'Image',
      '#type' => 'managed_file',
      '#multiple' => FALSE,
      '#description' => $this->t('Valid extensions: jpeg, jpg, png. Max file size 2MB'),
      '#default_value' => [$data[0]->image],
      '#required' => TRUE,
      '#upload_location' => 'public://stchk34/cats',
      '#upload_validators' => [
        'file_validate_extensions' => ['jpeg jpg png'],
        'file_validate_size' => [2100000],
      ],
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Edit Cat'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
      ],
    ];
    return $form;
  }

  /**
   * Email validation handler.
   *
   * @return bool
   *
   *   The current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    if (strlen($form_state->getValue('name')) < 2) {
      $form_state->setErrorByName('name', $this->t('Name is too short.'));
    }
    elseif (strlen($form_state->getValue('name')) > 32) {
      $form_state->setErrorByName('name', $this->t('Name is too long.'));
    }
    if ((!filter_var($email, FILTER_VALIDATE_EMAIL))
      || (strpbrk($email, '1234567890+*/!#$^&*()='))) {
      $form_state->setErrorByName('name', $this->t('Invalid Email'));
    }
  }

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $file_data = $form_state->getValue(['image']);
    $file = File::load($file_data[0]);
    if ($file !== NULL) {
      $file->setPermanent();
      $file->save();
      $query = $this->database()->update('stchk34')
        ->condition('id', $this->id)
        ->fields([
          'cats_name' => $form_state->getValue('cats_name'),
          'email' => $form_state->getValue('email'),
          'image' => $file_data[0],
        ])
        ->execute();
    }
  }

  /**
   * Form validation.
   */
  public function ajaxSubmit(array $form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    $url = Url::fromRoute('cats');
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
  public function validateEmailAjax(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    $input = $form_state->getValue('email');
    $regex = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    if (preg_match($regex, $input)) {
      $response->addCommand(new MessageCommand(
        $this->t('Email valid'),
        '.email-massage-modal'));
    }
    else {
      $response->addCommand(new MessageCommand(
        $this->t('Email names can only contain Latin letters, underscores, or hyphens'),
        '.email-message-modal', ['type' => 'error']));
    }
    if (empty($input)) {
      $response->addCommand(new RemoveCommand('.email-message-modal .messages--error'));
    }
    return $response;
  }

}
