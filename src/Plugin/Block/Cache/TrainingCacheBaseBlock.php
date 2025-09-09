<?php

declare(strict_types=1);

namespace Drupal\training_module\Plugin\Block\Cache;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Training block.
 *
 * @Block(
 *  id = "training_cache_base_block",
 *  admin_label = @Translation("Training Cache : Base block"),
 *  category = @Translation("Training module"),
 * )
 */
class TrainingCacheBaseBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The current route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected RouteMatchInterface $routeMatch;

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    RouteMatchInterface $routeMatch
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $routeMatch;
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    if ('entity.node.canonical' !== $this->routeMatch->getRouteName()) {
      return [];
    }

    $node = $this->routeMatch->getParameter('node');

    return [
      '#markup' => $node->getTitle(),
    ];
  }

}
