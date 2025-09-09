<?php

declare(strict_types=1);

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Defines a controller to show implementations related to properties of route.
 */
class TrainingController extends ControllerBase {

  /**
   * Simple controller render a markup.
   *
   * This callback is mapped to the path /controller.
   *
   * @return array
   *   A render array.
   */
  public function render(): array {
    return [
      '#markup' => $this->t('Hello world'),
    ];
  }

  /**
   * Simple controller render a markup.
   *
   * This callback is mapped to the path /controller.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JsonResponse object.
   */
  public function renderJson(): JsonResponse {
    $data = [
      [
        'id' => '1',
        'title' => 'Title 1',
      ],
      [
        'id' => '2',
        'title' => 'Title 2',
      ],
    ];

    return new JsonResponse($data, 200);
 }

  /**
   * Simple controller render a markup.
   *
   * This callback is mapped to the path /controller/request.
   *
   * @return array
   *   A render array.
   */
  public function request(Request $request): array {
    dump($request);
    return [
      '#markup' => $this->t('Hello world'),
    ];
  }

  /**
   * Controller can use argument.
   *
   * This callback is mapped to the path /controller/{foo}/{bar}
   *
   * @param string $foo
   *   First parmater, a string to use, should be a number.
   * @param string $bar
   *   Second parameter.
   *
   * @return array
   *   A render array.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   *   If the parameters are invalid.
   */
  public function renderArgument($foo, $bar): array {
    // Make sure you don't trust the URL to be safe! Always check for exploits.
    if (!is_numeric($foo) || !is_string($bar)) {
      // We will just show a standard "access denied" page in this case.
      throw new AccessDeniedHttpException();
    }

    $list[] = $this->t("Foo number was @number.", ['@number' => $foo]);
    $list[] = $this->t("Bar string was @string.", ['@string' => $bar]);

    return [
      // The theme function to apply to the #items.
      '#theme' => 'item_list',
      // The list itself.
      '#items' => $list,
      '#title' => $this->t('Argument Information'),
    ];
  }

  /**
   * Controller can access to the entire entity.
   *
   * This callback is mapped to the path /controller/user/{user}
   *
   * @param \Drupal\Core\Session\AccountInterface $user
   *   The entire entity.
   *
   * @return array
   *   A render array.
   */
  public function renderAccountInterface(AccountInterface $user): array {
    return [
      '#markup' => $user->getAccountName(),
      '#prefix' => '<p>',
      '#suffix' => '</p>',
    ];
  }

  /**
   * Controller can access to the entire entity.
   *
   * This callback is mapped to the path /controller/user/{user}
   *
   * @param \Drupal\node\NodeInterface $node
   *   The entire entity.
   *
   * @return array
   *   A render array.
   */
  public function renderNodeInterface(NodeInterface $node): array {
    return [
      '#markup' => $node->getTitle(),
      '#prefix' => '<p>',
      '#suffix' => '</p>',
    ];
  }
}
