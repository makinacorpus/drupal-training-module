<?php

declare(strict_types=1);

namespace Drupal\training_module\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultAllowed;
use Drupal\Core\Access\AccessResultForbidden;
use Drupal\Core\Controller\ControllerBase;

/**
 * Defines TrainingAccessController class.
 */
class TrainingAccessController extends ControllerBase {

  /**
   * Manage access to controller.
   */
  public function checkAccess(): AccessResultAllowed|AccessResultForbidden {

    $roles = $this->currentUser()->getRoles();
    if (!\in_array('administrator', $roles)) {
      return AccessResult::forbidden();
    }

    return AccessResult::allowed();
  }

}
