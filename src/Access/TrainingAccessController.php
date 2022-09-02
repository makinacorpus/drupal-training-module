<?php

namespace Drupal\training_module\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;

/**
 * Defines TrainingAccessController class.
 */
class TrainingAccessController extends ControllerBase {

  /**
   * Manage access to controller.
   */
  public function checkAccess() {

    $roles = $this->currentUser()->getRoles();
    if (!\in_array('administrator', $roles)) {
      return AccessResult::forbidden();
    }
    return AccessResult::allowed();
  }

}
