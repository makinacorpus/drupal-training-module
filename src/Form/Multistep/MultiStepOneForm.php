<?php

namespace Drupal\training_module\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Step 1 of the form.
 */
class MultiStepOneForm extends MultiStepBaseForm {

  /**
   * Get the formId.
   *
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_one';
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name'),
      '#default_value' => $this->store->get('name') ? $this->store->get('name') : '',
    ];

    $form['actions']['submit']['#value'] = $this->t('Next');
    $form['actions']['reverse']['#access'] = FALSE;

    return $form;
  }

  /**
   * Submit fonction.
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->store->set('name', $form_state->getValue('name'));
    $form_state->setRedirect('training_module.multistep_two');
  }

}
