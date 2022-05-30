<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Deleting cats.
 */
class DeleteForm extends ConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'delete_form';
  }

  /**
   * Drupal\Core\Database defenition.
   *
   * @var \Drupal\Core\Database\Connection|object|null
   */
  private $database;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): DeleteForm {
    $instance = parent::create($container);
    $instance->database = $container->get('database');
    $instance->messenger = $container->get('messenger');
    return $instance;
  }

  /**
   * Cats ids storaging.
   *
   * @var null
   */
  private $id;

  /**
   * {@inheritdoc}
   */
  public function getQuestion(): TranslatableMarkup {
    return $this->t('Are you sure?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl(): Url {
    return new Url('Meow.cats');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL): array {
    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state):void {
    $this->database->delete('stchk34')
      ->condition('id', $this->id)
      ->execute();
    $this->messenger->addStatus($this->t('You successfully deleted a cat!'));
    $form_state->setRedirect('Meow.cats');
  }

}
