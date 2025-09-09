<?php

declare(strict_types=1);

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines a controller to show services provide by the ControllerBase.
 */
class BaseClassExamplesController extends ControllerBase {

  /**
   * Controller base prodive many services.
   *
   * This callback is mapped to the path /controller/extends.
   *
   * @return array
   *   A render array.
   */
  public function services(): array {

    // Return current user.
    // @return \Drupal\Core\Session\AccountInterface
    $currentUser = $this->currentUser();
    \dump($currentUser);

    // Return Entity Type Mananger.
    // Allows to load or to make a request on entities.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21EntityTypeManagerInterface.php/interface/EntityTypeManagerInterface/8.7.x
    // @return \Drupal\Core\Entity\EntityTypeManagerInterface
    $this->entityTypeManager();

    // Get an entity.
    $entityTypeId = 'user';
    // $entityTypeId = 'node';
    // $entityTypeId = 'comment';
    // $entityTypeId = 'taxonomy_term';
    // $entityTypeId = 'contact_message';
    $id = $uid = $nid = $cid = $tid = 1;
    $userStorage = $this->entityTypeManager()->getStorage($entityTypeId);
    $loadedUser = $userStorage->load($id);
    \dump($loadedUser);

    // Make a query on an entity.
    $userId = $this->entityTypeManager()->getStorage($entityTypeId)->getQuery()
      ->accessCheck()
      ->condition('uid', $uid, '=')
      ->execute();
    \dump($userId);

    // Return the form builder.
    // Allows to create custom form.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Form%21FormBuilderInterface.php/8.2.x
    $this->formBuilder();

    // Return the entity form builder.
    // Allows to create entity form.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21EntityFormBuilderInterface.php/interface/EntityFormBuilderInterface/8.2.x
    // @return \Drupal\Core\Entity\EntityFormBuilderInterface
    $this->entityFormBuilder();

    // Fisrt, get the entity.
    // Next, construct the form.
    $entityTypeId = 'contact_message';
    $formEntity = $this->entityTypeManager()
      ->getStorage($entityTypeId)
      ->create([
        'contact_form' => 'feedback',
      ]);

    $form = $this->entityFormBuilder->getForm($formEntity);
    \dump($form);

    // Make redirections.
    // Build a redirect response object that may be returned by the controller.
    // @return \Symfony\Component\HttpFoundation\RedirectResponse
    $redirect = $this->redirect('entity.user.canonical', ['user' => $uid]);
    \dump($redirect);

    // Return config parameters.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Config%21Config.php/class/Config/8.2.x
    // @return \Drupal\Core\Config\Config
    $name = 'system.site';
    $config = $this->config($name)->getRawData();
    \dump($config);

    // Log messages, available in back-office.
    // @param string $name le nom du channel
    // @see https://api.drupal.org/api/drupal/vendor!psr!log!Psr!Log!LoggerInterface.php/interface/LoggerInterface/8.8.x
    $this->getLogger($this->t('My channel'))->notice($this->t('My message'));

    return [
      '#markup' => 'Hello World \o/',
    ];
  }

}
