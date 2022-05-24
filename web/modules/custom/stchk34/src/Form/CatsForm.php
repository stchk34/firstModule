<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Our simple form class.
 * 
 *  @package Drupal\stchk34\Form
 */
 class CatsForm extends ConfigFormBase{
  public function getFormId(){
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
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if (strlen($form_state->getValue('cats_name')) < 2)
    {
      $form_state->setErrorByName('cats_name', $this->t('name is too short, minimum is 2 characters.'));
    }
    elseif(strlen($form_state->getValue('cats_name')) > 32)
    {
      $form_state->setErrorByName('cats_name', $this->t('name is too long, maximum is 32 characters.'));
    }
    }

     /**
      * Validates that the email field is correct.
      */
      
protected function validateEmail(array &$form, FormStateInterface $form_state) {
  $stableExpression = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    if (preg_match($stableExpression, $email)){
      return TRUE;
    }
  return FALSE;
}

  /**
 * Ajax callback to validate the email field.
 */
public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
  $valid = $this->validateEmail($form, $form_state);
  $response = new AjaxResponse();
  if ($valid) {
    $css = ['border' => '1px solid green'];
    $this->messenger()->addStatus(t("Email ok!"));
  }
  else {
    $css = ['border' => '1px solid red'];
    $form_state->setErrorByName('cats_name',$this->t('Email not valid.'));
  }
  $response->addCommand(new CssCommand('#edit-email', $css));
  $response->addCommand(new HtmlCommand('.email-valid-message', $message));
  return $response;
}
   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['container'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'message_ajaxform'],
    ];

    $form['cats_name'] = [
         '#type' => 'textfield',
         '#title' => t('Your cat’s name:'),
         '#description'=>t('the minimum length of the name-2 and the maximum-32'),
         '#required' => TRUE,
         '#default_value' => $this->config('stchk34.settings')->get('cats_name'),
    ];

    $form['personal_info']['email'] = array(
      '#type' => 'email',
      '#title' => t('Your email:'),
      '#required' => TRUE,
      '#description' => t('Email names can only contain Latin letters, underscores, or hyphens'),
      '#maxlength' => 25,
      '#ajax' => [
        'disable-refocus' => TRUE,
        'callback' => '::validateEmailAjax',
        'event' => 'finishedinput',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Verifying email...'),
        ),
      ],
      '#suffix' => '<span class="email-valid-message"></span>'
    );

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Add cat'),
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'message_ajaxform',
        'progress' => [
          'type' => 'throbber',
          'message' => t('Adding the cat\'s name..'),
        ],        
      ],  
  ];

    return $form;
  }

  public function ajaxSubmit(array &$form, FormStateInterface $form_state) {
    $element = $form['container'];
    if ($form_state->hasAnyErrors()) {
      return $element;
    }
    else {  
      $this->messenger()->addStatus(t("Name of the cat was added!"));
    }
    return $element;
  }
 }