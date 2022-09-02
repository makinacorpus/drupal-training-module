<?php

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a controller to show the different ways to query the database.
 */
class TrainingDatabaseController extends ControllerBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('database'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * Database queries examples.
   *
   * This callback is mapped to the path /controller/database.
   */
  public function readDatabase() {

    $query = $this->database->select('users', 'u')
      ->fields('u', ['uid', 'uuid']);
    $result = $query->execute();

    \dump('--------------------');
    \dump('Iterating on records');
    \dump('--------------------');
    foreach ($result as $record) {
      \dump($record);
    }

    \dump('-------------------');
    \dump('Using fetch methods');
    \dump('-------------------');

    \dump('fetchField');
    \dump($query->execute()->fetchField());
    \dump('fetchAll');
    \dump($query->execute()->fetchAll());
    \dump('fetchCol');
    \dump($query->execute()->fetchCol());
    \dump('fetchAssoc');
    \dump($query->execute()->fetchAssoc());
    \dump('fetchAllAssoc');
    \dump($query->execute()->fetchAllAssoc('uid'));
    \dump('fetchAllKeyed');
    \dump($query->execute()->fetchAllKeyed());
  }

  /**
   * EntityQuery's examples.
   *
   * This callback is mapped to the path /controller/entityquery.
   */
  public function readEntity() {

    $entity_type = 'user';
    // $entity_type = 'node';
    // $entity_type = 'block_content';
    // $entity_type = 'taxonomy_term';
    // $entity_type = 'contact_form';
    // $entity_type = 'file';
    $uids = $this->entityTypeManager()
      ->getStorage($entity_type)
      ->getQuery()
      ->count()
      ->execute();

    $nids = $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'article', '=')
      ->count()
      ->execute();

    $list = [
      $this->t('Account: @number', ['@number' => $uids]),
      $this->t('Articles: @number', ['@number' => $nids]),
    ];

    return [
      '#theme' => 'item_list',
      '#items' => $list,
    ];
  }

}
