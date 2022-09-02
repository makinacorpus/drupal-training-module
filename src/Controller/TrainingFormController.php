<?php

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\TempStore\PrivateTempStoreFactory;

/**
 * Defines a controller to show the different fields usable in a custom form.
 */
class TrainingFormController extends ControllerBase {

  /**
   * The request manager.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestManager;

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
        $container->get('request_stack'),
        $container->get('tempstore.private'),
        $container->get('training_module.training_service'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(RequestStack $request_manager,
    PrivateTempStoreFactory $temp_store_factory
  ) {
    $this->requestManager = $request_manager;
    $this->tempStoreFactory = $temp_store_factory;
    $this->store = $this->tempStoreFactory->get('training_form');
  }

  /**
   * You can access to the query params.
   */
  public function formRedirectUsingRequestManager() {
    $input = (\array_key_exists('input', $params)) ?
      $this->t("My input: @string.", ['@string' => $params['input']]) :
      $this->t('Unavailable');

    return [
      '#markup' => $input,
      '#prefix' => '<p>',
      '#suffix' => '</p>',
    ];
  }

  /**
   * You can use a tempStore.
   */
  public function formRedirectUsingTempStore() {
    $input = !\is_null($this->store->get('input')) ?
      $this->t("My input: @string.", ['@string' => $this->store->get('input')]) :
      $this->t('Unavailable');

    $this->store->delete('input');

    return [
      '#markup' => $input,
      '#prefix' => '<p>',
      '#suffix' => '</p>',
    ];
  }

}
