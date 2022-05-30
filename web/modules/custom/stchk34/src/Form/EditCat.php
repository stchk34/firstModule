<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Url;
use Drupal\Core\Ajax\RedirectCommand;

/**
 * Form for adding cats.
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
    $form['adding_cat'] = [
      '#type' => 'textfield',
      '#default_value' => $data[0]->name,
      '#title' => $this->t('Your cat’s name:'),
      '#required' => TRUE,
      '#placeholder' => $this->t('The name must be in range from 2 to 32 symbols...'),
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email:'),
      '#placeholder' => $this->t('Only English letters, - and _'),
      '#required' => TRUE,
      '#default_value' => $data[0]->email,
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
    $form['cat_photo'] = [
      '#title' => $this->t('Your cat’s image:'),
      '#description' => $this->t('Cat photo'),
      '#type' => 'managed_file',
      '#default_value' => [$data[0]->image],
      '#size' => 40,
      '#attributes' => [
        'class' => ['.clear_class'],
      ],
      '#required' => TRUE,
      '#upload_location' => 'public://img',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_size' => [2097152],
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'submit',
      '#ajax' => [
        'callback' => '::setMessage',
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
            $this->t('You can use only _ - and English letters')
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
    $file_data = $form_state->getValue('cat_photo');
    $file = File::load($file_data[0]);
    if ($file !== NULL) {
      $file->setPermanent();
      $file->save();
      $this->database
        ->update('evilargest')
        ->condition('id', $this->id)
        ->fields([
          'name' => $form_state->getValue(['adding_cat']),
          'email' => $form_state->getValue('email'),
          'image' => $form_state->getValue('cat_photo')[0],
        ])
        ->execute();
    }
    $this->messenger->addStatus($this->t('Hurray! You edited your cat!'));
    $form_state->setRedirect('cats');
  }

  /**
   * Form validation.
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    if ((mb_strlen($form_state->getValue('adding_cat')) < 2)) {
      $form_state->setErrorByName(
        'adding_cat',
        $this->t('Your name is less than 2 symbols.'));
    }
    if ((mb_strlen($form_state->getValue('adding_cat')) > 32)) {
      $form_state->setErrorByName(
        'adding_cat',
        $this->t('Your name is longer than 32 symbols.')
      );
    }
    $regularexp = '/[-_@A-Za-z.]/';
    $line = $form_state->getValue('email');
    $linelength = strlen($line);
    for ($i = 0; $i < $linelength; $i++) {
      if (!preg_match($regularexp, $line[$i])) {
        $form_state->setErrorByName('email', 'Your email is not valid');
      }
    }
  }

  /**
   * Submit Ajax.
   */
  public function setMessage(array &$form, FormStateInterface $form_state) : AjaxResponse {
    $response = new AjaxResponse();
    $url = Url::fromRoute('cats');
    $command = new RedirectCommand($url->toString());
    $response->addCommand($command);
    return $response;
  }

}
