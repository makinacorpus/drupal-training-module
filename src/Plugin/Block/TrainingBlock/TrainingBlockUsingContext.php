<?php

namespace Drupal\training_module\Plugin\Block\TrainingBlock;

use Drupal\Core\Block\BlockBase;

/**
 * Return hello world.
 *
 * @Block(
 *   id = "training_block_using_context",
 *   admin_label = @Translation("Training block using context elements"),
 *   category = @Translation("Training module"),
 *   context_definitions = {
 *     "node" = @ContextDefinition(
 *         "entity:node",
 *         label = @Translation("Node"),
 *         description = @Translation("Node context"),
 *         required = FALSE,
 *     ),
 *   }
 * )
 */
class TrainingBlockUsingContext extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $definitions = $this->getContextDefinitions();
    $contexts = $this->getContextValues();

    $node = $this->getContextValue('node');
    if (\is_null($node)) {
      return [
        '#markup' => 'Hello world',
      ];
    }

    return [
      '#markup' => $node->getTitle(),
    ];
  }

}
