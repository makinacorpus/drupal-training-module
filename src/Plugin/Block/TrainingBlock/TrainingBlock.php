<?php

namespace Drupal\training_module\Plugin\Block\TrainingBlock;

use Drupal\Core\Block\BlockBase;

/**
 * Return hello world.
 *
 * @Block(
 *  id = "training_block",
 *  admin_label = @Translation("Training block"),
 *  category = @Translation("Training module"),
 * )
 */
class TrainingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => 'Hello block \o/',
    ];
  }

}
