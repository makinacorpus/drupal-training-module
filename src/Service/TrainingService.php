<?php

declare(strict_types=1);

namespace Drupal\training_module\Service;

use Drupal\Core\Session\AccountProxy;

/**
 * Defines a controller to show services provide by the ControllerBase.
 */
class TrainingService {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected AccountProxy $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxy $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * Return account name.
   */
  public function getAccountName(): string {
    return $this->currentUser->getAccountName();
  }

  /**
   * Return foo.
   */
  public function doFoo(): string {
    return 'foo';
  }

  /**
   * Return bar.
   */
  public function doBar(): string {
    return 'bar';
  }

}
