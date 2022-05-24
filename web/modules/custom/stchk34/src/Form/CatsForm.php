<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Our simple form class.
 */
 class CatsForm extends FormBase{
  public function getFormId(){
      return 'stchk34';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['cats_name'] = [
         '#type' => 'textfield',
         '#title' => $this->t('Your cat’s name:'),
         '#description'=>t('Мінімальна довжина імені-2 символи, максимальна-32.'),
         '#required' => TRUE,
    ];
    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Add cat')
    ];

    return $form;
  }

   /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      drupal_set_message($form_state->getValue('cats_name'));
    }
 }