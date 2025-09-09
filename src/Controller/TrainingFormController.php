<?php

declare(strict_types=1);

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\TempStore\PrivateTempStore;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a controller to show the different fields usable in a custom form.
 */
class TrainingFormController extends ControllerBase {

  /**
   * The request manager.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected RequestStack $requestManager;

  /**
   * The store using by our class.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStore
   */
  protected PrivateTempStore $store;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('request_stack'),
        $container->get('tempstore.private'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(
    RequestStack $requestManager,
    PrivateTempStoreFactory $tempStoreFactory
  ) {
    $this->requestManager = $requestManager;
    $this->store = $tempStoreFactory->get('training_form');
  }

  /**
   * You can access to the query params.
   *
   * @return array
   *   A render array.
   */
  public function formRedirectUsingRequestManager(Request $request): array {
    $params = $request->query->all();
    dump($params);
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
   *
   * @return array
   *   A render array.
   */
  public function formRedirectUsingTempStore(): array {
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
