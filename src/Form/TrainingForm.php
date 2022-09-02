<?php

namespace Drupal\training_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;

/**
 * Defines an example form.
 */
class TrainingForm extends FormBase {

  /**
   * The tempstore service.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStoreFactory
   */
  protected $tempStoreFactory;

  /**
   * The store using by our class.
   *
   * @var \Drupal\user\PrivateTempStore
   */
  protected $store;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('tempstore.private'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(PrivateTempStoreFactory $temp_store_factory) {
    $this->tempStoreFactory = $temp_store_factory;
    $this->store = $this->tempStoreFactory->get('training_form');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'training_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This example shows the imlementation of a simple form'),
    ];

    $form['input_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My object'),
      '#description' => $this->t('The description of the input'),
      '#size' => 60,
      '#maxlength' => 128,
    ];

    $form['checkbox'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('You can check this'),
      '#description' => $this->t("The description of the checbox's purpose"),
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $input = $form_state->getValue('input_text');
    if (preg_match('/\d/', $input)) {
      $form_state->setErrorByName('input_text', $this->t('Numbers are not allowed !'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Using query parameters.
    $parameters = [
      'input' => $form_state->getValue('input_text'),
    ];
    $form_state->setRedirect('training_module.redirection_using_qp', $parameters);

    // Using tempStore.
    $this->store->set('input', $form_state->getValue('input_text'));
    $form_state->setRedirect('training_module.redirection_using_ts');

    $this->logger('Channel')->notice($this->t('My message'));
  }

}
