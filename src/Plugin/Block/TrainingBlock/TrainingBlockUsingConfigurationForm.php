<?php

namespace Drupal\training_module\Plugin\Block\TrainingBlock;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Training block with configuration form.
 *
 * @Block(
 *  id = "training_block_config_form",
 *  admin_label = @Translation("Training block using a configuration form"),
 *  category = @Translation("Training module"),
 * )
 */
class TrainingBlockUsingConfigurationForm extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text'),
      '#size' => 60,
      '#maxlength' => 128,
      '#default_value' => isset($config['text']) ? $config['text'] : $this->t('This my default text'),
      '#attributes' => ['placeholder' => $this->t('Your text')],
    ];

    $form['number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your number ?'),
      '#default_value' => isset($config['number']) ? $config['number'] : '00 00 00 00 00',
      '#size' => 60,
      '#maxlength' => 14,
      '#attributes' => ['placeholder' => $this->t('What is your number ?')],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['text'] = $values['text'];
    $this->configuration['number'] = $values['number'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();

    $text = !empty($config['text']) ? $config['text'] : '';
    $number = !empty($config['number']) ? $config['number'] : '';

    return [
      '#markup' => 'Text: ' . $text . '</br>Number: ' . $number,
    ];

    // return [
    //   '#theme' => 'block_template',
    //   '#text' => $text,
    //   '#number' => $number,
    // ];
  }

}
