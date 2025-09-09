<?php

declare(strict_types=1);

namespace Drupal\training_module\Plugin\Block\Cache;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Training block illustrating the cache management.
 *
 * @Block(
 *  id = "training_cache_management",
 *  admin_label = @Translation("Training Cache : Cache management"),
 *  category = @Translation("Training module"),
 * )
 */
class TrainingCacheManagementBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
      '#cache' => [
        'tags' => ['node:' . $node->id()],
        'contexts' => ['url.path'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    $tags = [];
    if ($this->routeMatch->getRouteName() === 'entity.node.canonical') {
      $node = $this->routeMatch->getParameter('node');
      $tags = ['node:' . $node->id()];
    }
    return Cache::mergeTags(parent::getCacheTags(), $tags);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts(): array {
    return Cache::mergeContexts(parent::getCacheContexts(), ['url.path']);
  }

}
