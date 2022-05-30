<?php

namespace Drupal\stchk34\Form;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\file\Entity\File;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a confirmation form to confirm deletion cat by id.
 *
 * @method database()
 */
class DeleteForm extends ConfirmFormBase {

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
  public function buildForm(array $form, FormStateInterface $form_state, string $id = NULL): array {
    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $image = $form_state->getValue('image');
    $database = $this->database();
    $result = $database->select('stchk34', 's')
      ->fields('s', ['image'])
      ->condition('id', $this->id)
      ->execute()->fetch();
    if ($result->image) {
      File::load($result->image)->delete();
    }
    $database->delete('stchk34')
      ->condition('id', $this->id)
      ->execute();
    $this->messenger()->addStatus('Succesfully deleted.');
    $form_state->setRedirect('Meow.cats');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return "delete_form";
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() : Url {
    return new Url('Meow.cats');
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion(): TranslatableMarkup {
    $database = $this->database();
    $result = $database->select('stchk34', 's')
      ->fields('s', ['id'])
      ->condition('id', $this->id)
      ->execute()
      ->fetch();
    return $this->t('Do you want to delete this cat?');
  }

}
