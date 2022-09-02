<?php

namespace Drupal\training_module\Form\Multistep;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\SessionManagerInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Define the base form of our multistep form.
 */
abstract class MultiStepBaseForm extends FormBase {

  /**
   * The tempstore service.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStoreFactory
   */
  protected $tempStoreFactory;

  /**
   * The session manager.
   *
   * @var \Drupal\Core\Session\SessionManagerInterface
   */
  private $sessionManager;

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
      $container->get('session_manager'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(PrivateTempStoreFactory $temp_store_factory, SessionManagerInterface $session_manager) {
    $this->tempStoreFactory = $temp_store_factory;
    $this->sessionManager = $session_manager;
    $this->store = $this->tempStoreFactory->get('training_exemple_form');
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Start a manual session for anonymous users.
    if ($this->currentUser()->isAnonymous() && !isset($_SESSION['multistep_form_holds_session'])) {
      $_SESSION['multistep_form_holds_session'] = TRUE;
      $this->sessionManager->start();
    }

    $form = [];

    $form['actions']['#type'] = 'actions';

    $form['actions']['reverse'] = [
      '#type' => 'submit',
      '#value' => $this->t('Return'),
      '#weight' => 0,
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#weight' => 10,
    ];

    return $form;
  }

  /**
   * Saves the data from the multistep form.
   */
  protected function saveData() {
    // Logic for saving data goes here.
    $this->deleteStore();
    $this->messenger()->addStatus($this->t('The form has been saved.'));
  }

  /**
   * Helper method that removes all the keys from the store collection.
   */
  protected function deleteStore() {
    $keys = ['name', 'email', 'postal_code', 'location'];
    foreach ($keys as $key) {
      $this->store->delete($key);
    }
  }

}
