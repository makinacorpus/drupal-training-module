<?php

declare(strict_types=1);

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
  protected TrainingService $trainingService;

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
  public function __construct(TrainingService $trainingService) {
    $this->trainingService = $trainingService;
  }

  /**
   * You can use the service.
   *
   * @return array
   *   A render array.
   */
  public function render(): array {
    $itemsList = [
      $this->trainingService->getAccountName(),
      $this->trainingService->doFoo(),
      $this->trainingService->doBar(),
    ];

    return [
      '#theme' => 'item_list',
      '#items' => $itemsList,
    ];
  }

}
