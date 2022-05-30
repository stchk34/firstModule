<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form for adding cats.
 *
 * @property $row*/
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
   * @var \Drupal\Core\Database\Connection|object|null
   */
  public $database;

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'edit_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL): array {
    $this->id = $id;
    $data = $this->database->select('stchk34', 's')
      ->condition('s.id', $id, '=')
      ->fields('s', ['id', 'cats_name', 'email', 'image'])
      ->execute()->fetchAll();
    $form['#prefix'] = '<div id="edit_wrapper">';
    $form['#suffix'] = '</div>';
    $form['cats_name'] = [
      '#type' => 'textfield',
      '#default_value' => $data[0]->cats_name,
      '#prefix' => '<div class="error-message-modal"></div>',
      '#title' => $this->t('Your cat’s name:'),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email:'),
      '#required' => TRUE,
      '#default_value' => $data[0]->email,
      '#suffix' => '<div class="email-message-modal"></div>',
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'input',
        'disable-refocus' => TRUE,
        'progress' => [
          'type' => 'none',
          'message' => $this->t('Verifying email..'),
        ],
      ],
    ];
    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div id ="edit_email_error">&nbsp;</div>',
    ];
    $form['image'] = [
      '#title' => $this->t('Your cat’s image:'),
      '#description' => $this->t('Cat photo'),
      '#type' => 'managed_file',
      '#default_value' => [$data[0]->image],
      '#size' => 40,
      '#attributes' => [
        'class' => ['.clear_class'],
      ],
      '#required' => TRUE,
      '#upload_location' => 'public://stchk34/cats',
      '#upload_validators' => [
        'file_validate_extensions' => ['jpeg jpg png'],
        'file_validate_size' => [2100000],
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'submit',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'edit_wrapper',
        'progress' => [
          'type' => 'none',
        ],
      ],
    ];
    return $form;
  }

  /**
   * Dynamic email validation.
   */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    $regularexp = '/[-_@A-Za-z.]/';
    $line = $form_state->getValue('email');
    $linelength = strlen($line);
    for ($i = 0; $i < $linelength; $i++) {
      if (!preg_match($regularexp, $line[$i])) {
        $response->addCommand(
          new HtmlCommand(
            '#edit_email_error',
            $this->t('Email names can only contain Latin letters, underscores, or hyphens')
          )
        );
        break;
      }
      $response->addCommand(
        new HtmlCommand(
          '#edit_email_error',
          '&nbsp;',
        )
      );
    }
    return $response;
  }

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   * @throws \Exception
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $file_data = $form_state->getValue('image');
    $file = File::load($file_data[0]);
    if ($file !== NULL) {
      $file->setPermanent();
      $file->save();
      $this->database
        ->update('stchk34')
        ->condition('id', $this->id)
        ->fields([
          'cats_name' => $form_state->getValue(['cats_name']),
          'email' => $form_state->getValue('email'),
          'image' => $form_state->getValue('image')[0],
        ])
        ->execute();
    }
    $this->messenger->addStatus($this->t('You edited your cat!'));
    $form_state->setRedirect('Meow.cats');
  }

  /**
   * Form validation.
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    if ((mb_strlen($form_state->getValue('cats_name')) < 2)) {
      $form_state->setErrorByName(
        'cats_name',
        $this->t('Your name is less than 2 symbols.'));
    }
    if ((mb_strlen($form_state->getValue('cats_name')) > 32)) {
      $form_state->setErrorByName(
        'cats_name',
        $this->t('Your name is longer than 32 symbols.')
      );
    }
    $email = $form_state->getValue('email');
    $stableExpression = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    if (!preg_match($stableExpression, $email)) {
      $form_state->setErrorByName('email', 'Your email is not valid');
    }
  }

  /**
   * Submit Ajax.
   */
  public function ajaxSubmit(array &$form, FormStateInterface $form_state) : AjaxResponse {
    $response = new AjaxResponse();
    $url = Url::fromRoute('Meow.cats');
    $command = new RedirectCommand($url->toString());
    $response->addCommand($command);
    return $response;
  }

}
