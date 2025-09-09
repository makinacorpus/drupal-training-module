<?php

declare(strict_types=1);

namespace Drupal\training_module\Plugin\Block\TrainingBlock;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Return hello world.
 */
#[Block(
  id: 'training_block',
  admin_label:  new TranslatableMarkup('Training block'),
  category:  new TranslatableMarkup('Training module'),
)]
class TrainingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#markup' => 'Hello block \o/',
    ];
  }

}
