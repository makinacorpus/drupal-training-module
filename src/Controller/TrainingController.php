<?php

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines a controller to show implementations related to properties of route.
 */
class TrainingController extends ControllerBase {

  /**
   * Simple controller render a markup.
   *
   * This callback is mapped to the path /controller.
   */
  public function render() {
    return [
      '#markup' => 'Hello world \o/',
    ];
  }

  /**
   * Simple controller render a markup.
   *
   * This callback is mapped to the path /controller/request.
   */
  public function request(Request $request) {
    dump($request);
    return [
      '#markup' => 'Hello world \o/',
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
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   *   If the parameters are invalid.
   */
  public function renderArgument($foo, $bar) {
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
   * @param Drupal\Core\Session\AccountInterface $user
   *   The entire entity.
   */
  public function renderAccountInterface(AccountInterface $user) {
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
   * @param Drupal\node\NodeInterface $node
   *   The entire entity.
   */
  public function renderNodeInterface(NodeInterface $node) {
    return [
      '#markup' => $node->getTitle(),
      '#prefix' => '<p>',
      '#suffix' => '</p>',
    ];
  }

  /**
   * Create a title.
   */
  public function getTitle() {
    return $this->currentUser()->getAccountName();
  }

}
