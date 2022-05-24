<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Our simple form class.
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
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('stchk34.settings')
      ->set('cats_name', $form_state->getValue('cats_name'))
      ->save();

    parent::submitForm($form, $form_state);
  }
 
   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['cats_name'] = [
         '#type' => 'textfield',
         '#title' => $this->t('Your cat’s name:'),
         '#description'=>t('Мінімальна довжина імені-2 символи, максимальна-32.'),
         '#required' => TRUE,
         '#default_value' => $this->config('stchk34.settings')->get('cats_name'),
    ];
    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Add cat')
    ];

    return $form;
  }
 }