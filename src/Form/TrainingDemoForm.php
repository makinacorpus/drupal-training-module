<?php

namespace Drupal\training_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * TrainingDemoForm.
 *
 * This example demonstrates the different input elements that are used to
 * collect data in a form.
 */
class TrainingDemoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'training_demo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Checkboxes.
    $form['item'] = [
      '#type' => 'item',
      '#markup' => $this->t('This example shows the use of all input-types.'),
    ];

    // Checkboxes.
    $form['checkboxes'] = [
      '#type' => 'checkboxes',
      '#options' => ['coffee' => $this->t('Coffee'), 'tea' => $this->t('Tea')],
      '#title' => $this->t('Tea or coffee'),
      '#description' => $this->t('Checkboxes, #type = checkboxes'),
    ];

    // Color.
    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => '#189ADB',
      '#description' => $this->t('Color, #type = color'),
    ];

    // Date.
    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Simple date'),
      '#default_value' => [
        'year' => 2020,
        'month' => 2,
        'day' => 15,
      ],
      '#description' => $this->t('Date, #type = date'),
    ];

    // Date-time.
    $form['datetime'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Date Time'),
      '#date_increment' => 1,
      '#date_timezone' => \date_default_timezone_get(),
      '#default_value' => \date_default_timezone_get(),
      '#description' => $this->t('Date time, #type = datetime'),
    ];

    // URL.
    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Url'),
      '#maxlength' => 255,
      '#size' => 30,
      '#description' => $this->t('Url, #type = url'),
    ];

    // Email.
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Email, #type = email'),
    ];

    // Number.
    $form['number'] = [
      '#type' => 'number',
      '#title' => $this->t('Quantity'),
      '#description' => $this->t('Number, #type = number'),
    ];

    // Password.
    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#description' => $this->t('Password, #type = password'),
    ];

    // Password Confirm.
    $form['password_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('New Password'),
      '#description' => $this->t('PasswordConfirm, #type = password_confirm'),
    ];

    // Range.
    $form['range'] = [
      '#type' => 'range',
      '#title' => $this->t('Range'),
      '#min' => 10,
      '#max' => 100,
      '#description' => $this->t('Range, #type = range'),
    ];

    // Radios.
    $form['settings']['active'] = [
      '#type' => 'radios',
      '#title' => $this->t('Only one choice is possible'),
      '#options' => [
        0 => $this->t('Yes'),
        1 => $this->t('No'),
      ],
      '#description' => $this->t('Radios, #type = radios'),
    ];

    // Search.
    $form['search'] = [
      '#type' => 'search',
      '#title' => $this->t('Search'),
      '#description' => $this->t('Search, #type = search'),
    ];

    // Select.
    $form['select'] = [
      '#type' => 'select',
      '#title' => $this->t('Only one choice is possible'),
      '#options' => [
        'red' => $this->t('Red'),
        'blue' => $this->t('Blue'),
        'green' => $this->t('Green'),
      ],
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Select, #type = select'),
    ];

    // Multiple values option elements.
    $form['select_multiple'] = [
      '#type' => 'select',
      '#title' => $this->t('Select (multiple choice)'),
      '#multiple' => TRUE,
      '#options' => [
        0 => $this->t('Nothing'),
        1 => $this->t('This one'),
        2 => $this->t('This one'),
        3 => $this->t('This one'),
        4 => $this->t('This one'),
      ],
      '#default_value' => [0],
      '#description' => $this->t('Select Multiple'),
    ];

    // Telephone.
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Telephone'),
      '#description' => $this->t('Tel, #type = tel'),
    ];

    // Details.
    $form['details'] = [
      '#type' => 'details',
      '#title' => $this->t('Details'),
      '#description' => $this->t('Details, #type = details'),
    ];

    // TableSelect.
    $options = [
      1 => [
        'first_name' => 'Jone',
        'last_name' => 'Doe',
      ],
      2 => [
        'first_name' => 'Jone',
        'last_name' => 'Doe',
      ],
      3 => [
        'first_name' => 'Jone',
        'last_name' => 'Doe',
      ],
    ];
    $header = [
      'first_name' => $this->t('First name'),
      'last_name' => $this->t('Last name'),
    ];
    $form['tableselect'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('Table select'),
      '#description' => $this->t('Table form, #type = tableselect'),
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),

    ];

    // Textarea.
    $form['textarea'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Textarea'),
      '#description' => $this->t('Textarea, #type = textarea'),
    ];

    // Text format.
    $form['text_format'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Text format'),
      '#format' => 'plain_text',
      '#expected_value' => [
        'value' => 'Text value',
        'format' => 'plain_text',
      ],
      '#description' => $this->t('Text format, #type = text_format'),
    ];

    // Textfield.
    $form['textfield'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Textfield'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Textfield, #type = textfield'),
    ];

    // Weight.
    $form['weight'] = [
      '#type' => 'weight',
      '#title' => $this->t('Weight'),
      '#delta' => 10,
      '#description' => $this->t('Weight, #type = weight'),
    ];

    // File.
    $form['file'] = [
      '#type' => 'file',
      '#title' => $this->t('File'),
      '#description' => $this->t('File, #type = file'),
    ];

    // Manage file.
    $form['managed_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Managed file'),
      '#description' => $this->t('Manage file, #type = managed_file'),
    ];

    // Image Buttons.
    $form['image_button'] = [
      '#type' => 'image_button',
      '#value' => $this->t('Image button'),
      '#src' => drupal_get_path('module', 'training_module') . '/images/drupalicon.png',
      '#attributes' => [
        'width' => '100px',
      ],
      '#description' => $this->t('Image file, #type = image_button'),
    ];

    // Button.
    $form['button'] = [
      '#type' => 'button',
      '#value' => $this->t('Button'),
      '#description' => $this->t('Button, #type = button'),
    ];

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit, #type = submit'),
    ];

    // Add a reset button that handles the submission of the form.
    $form['actions']['reset'] = [
      '#type' => 'button',
      '#button_type' => 'reset',
      '#value' => $this->t('Reset'),
      '#description' => $this->t('Submit, #type = button, #button_type = reset, #attributes = this.form.reset();return false'),
      '#attributes' => [
        'onclick' => 'this.form.reset(); return false;',
      ],
    ];

    // Extra actions for the display.
    $form['actions']['dropbutton'] = [
      '#type' => 'dropbutton',
      '#title' => $this->t('Dropdown button'),
      '#description' => $this->t('Dropdown button, #type = dropbutton'),
      '#links' => [
        'simple_form' => [
          'title' => $this->t('Simple Form'),
          'url' => Url::fromRoute('training_module.form'),
        ],
        'demo' => [
          'title' => $this->t('Build Demo'),
          'url' => Url::fromRoute('training_module.form'),
        ],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
