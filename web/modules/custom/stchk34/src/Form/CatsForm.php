<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\MessageCommand;

 /**
 * Our simple form class.
 * 
 *  @package Drupal\stchk34\Form
 */
class CatsForm extends ConfigFormBase{
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
        '#title' => t('Your cat’s name:'),
        '#description'=>t('the minimum length of the name-2 and the maximum-32'),
        '#required' => TRUE,
      ];

      $form['email'] = [
        '#type' => 'email',
        '#title' => t('Your email:'),
        '#required' => TRUE,
        '#description' => t('Email names can only contain Latin letters, underscores, or hyphens'),
        '#maxlength' => 25,
        '#ajax' => [
          'callback' => '::validateEmailAjax',
          'event' => 'keyup',
        ],
      ];

      $form['cat_image'] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Your cat’s image:'),
        '#required' => true,
        '#description' => $this->t('Valid extensions: jpeg, jpg, png. Max file size 2MB'),
        '#multiple' => FALSE,
        '#default_value' => $this->config('stchk34.settings')->get('cat_image'),
        '#upload_location' => 'public://stchk34/cats',
        '#upload_validators' => [
          'file_validate_extensions' => ['jpeg jpg png'],
          'file_validate_size' => [2100000]
        ],
      ];

      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => t('Add cat'),
        '#button_type' => 'primary',
        '#ajax' => [
          'callback' => '::ajaxSubmit',
        ],
      ];
      return $form;
    }

  /**
  * Validate form
  */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
      $email=$form_state->getValue('email');
        if (strlen($form_state->getValue('cats_name')) < 2) {
          $form_state->setErrorByName('cats_name', $this->t('Name is too short.'));
        } elseif (strlen($form_state->getValue('cats_name')) >32) {
          $form_state->setErrorByName('cats_name', $this->t('Name is too long.'));
        }
        if((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (strpbrk($email,$stableExpression))){
          $form_state->setErrorByName('cats_name', $this->t('Invalid email'));
        }
    }

  /**
  * {@inheritdoc}
  */
    public function ajaxSubmit(array $form, FormStateInterface $form_state)
    {
      $response = new AjaxResponse();
      if ($form_state->hasAnyErrors()) {
        foreach ($form_state->getErrors() as $errors_array) {
          $response->addCommand(new MessageCommand($errors_array));
        }
      } else {
          $response->addCommand(new MessageCommand('You adedd a cat!'));
      }
      \Drupal::messenger()->deleteAll();
      return $response;
    }

  /**
  * {@inheritdoc}
  */
    public function validateEmailAjax(array &$form, FormStateInterface $form_state)
    {
      $response = new AjaxResponse();
      $email=$form_state->getValue('email');
      $stableExpression = '/[^A-Za-z_\-]+@\w+(?:\.\w+)+$/';
      if(strpbrk($email,$stableExpression)){
        $response->addCommand(new MessageCommand('Invalid Email'));
      } else{
          $response->addCommand(new MessageCommand('',".null",[],true));
      }
      return $response;
    }

}