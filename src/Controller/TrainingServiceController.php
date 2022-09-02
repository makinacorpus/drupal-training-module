<?php

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\training_module\Service\TrainingService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a controller to show the different fields usable in a custom form.
 */
class TrainingServiceController extends ControllerBase {

  /**
   * The store using by our class.
   *
   * @var \Drupal\training_module\Service\TrainingService
   */
  protected $trainingService;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('training_module.training_service'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(TrainingService $training_service) {
    $this->trainingService = $training_service;
  }

  /**
   * You can access to the query params.
   */
  public function render() {
    $items_list = [
      $this->trainingService->getAccountName(),
      $this->trainingService->doFoo(),
      $this->trainingService->doBar(),
    ];

    return [
      '#theme' => 'item_list',
      '#items' => $items_list,
    ];
  }

}
