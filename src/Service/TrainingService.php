<?php

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
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxy $current_user) {
    $this->currentUSer = $current_user;
  }

  /**
   * Return account name.
   */
  public function getAccountName() {
    return $this->currentUSer->getAccountName();
  }

  /**
   * Return foo !
   */
  public function doFoo() {
    return 'foo';
  }

  /**
   * Return bar !
   */
  public function doBar() {
    return 'bar';
  }

}
