<?php

namespace Drupal\training_module\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Step two of our multistep form.
 */
class MultiStepTwoForm extends MultiStepBaseForm {

  /**
   * Get the formId.
   *
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_two';
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email address'),
      '#default_value' => $this->store->get('email') ? $this->store->get('email') : '',
    ];

    return $form;
  }

  /**
   * Submit fonction.
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->store->set('email', $form_state->getValue('email'));

    $triggering = $form_state->getTriggeringElement();
    $action = $triggering['#id'];
    switch ($action) {
      case 'edit-submit':
        parent::saveData();
        $form_state->setRedirect('training_module.multistep_one');
        break;

      case 'edit-reverse':
        $form_state->setRedirect('training_module.multistep_one');
        break;

      default:
        $form_state->setRedirect('training_module.multistep_one');
    }
  }

}
