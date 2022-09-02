<?php

namespace Drupal\training_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines a controller to show how entities are structured.
 */
class EntityManagementController extends ControllerBase {

  /**
   * Dump entities.
   *
   * This callback is mapped to the path /entity-management.
   */
  public function dump() {

    // $entity_type_id = 'node';
    // $entity_type_id = 'taxonomy_term';
    // $entity_type_id = 'block_content';
    // $entity_type_id = 'user';
    // $entity_type_id = 'contact_message';
    $entity_type_id = 'node';

    // Set the nid of a pokemon.
    $nid = 15;
    $node_storage_interface = $this->entityTypeManager()->getStorage($entity_type_id);
    $entity = $node_storage_interface->load($nid);

    \dump('----------------------------------------------');
    \dump('##                NODE TITLE                ##');
    \dump('----------------------------------------------');
    \dump($entity->label());


    \dump('----------------------------------------------');
    \dump('##             DUMP FULL ENTITY             ##');
    \dump('----------------------------------------------');
    \dump($entity);

    // Use the magic method __get() for getting object properties.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21ContentEntityBase.php/class/ContentEntityBase/9.x
    // UseFieldableEntityInterface for getting the field item object.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21FieldableEntityInterface.php/interface/FieldableEntityInterface/9.x
    \dump('-----------------------------------------------');
    \dump('##              DUMP FIELD ITEM              ##');
    \dump('-----------------------------------------------');

    // Use magic-method, return null if an invalid field name is given.
    \dump($entity->field_id);
    // @throws \InvalidArgumentException
    \dump($entity->get('field_id'));

    \dump('-----------------------------------------------');
    \dump('##             TITLE INFORMATION             ##');
    \dump('-----------------------------------------------');
    // Use ContentEntityInterface for getting entities commons datas.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21ContentEntityInterface.php/interface/ContentEntityInterface/9.x
    \dump($entity->title->value);
    \dump($entity->getTitle());

    \dump('----------------------------------------------');
    \dump('##               COMMON FIELD               ##');
    \dump('----------------------------------------------');

    // Use the magic method __get() for getting object properties.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FieldItemList.php/class/FieldItemList/9.x
    // You can use the FieldItemListInterface for getting the field item object.
    // @see
    // https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FieldItemListInterface.php/interface/FieldItemListInterface/9.x

    \dump($entity->field_id->value);
    \dump($entity->get('field_id')->value);
    \dump($entity->get('field_id')->first()->getValue());

    \dump('------------------------------------------------');
    \dump('##           ENTITY REFERENCE FIELD           ##');
    \dump('------------------------------------------------');

    // EntityReferenceFieldItemListInterface interface.
    // @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21EntityReferenceFieldItemListInterface.php/interface/EntityReferenceFieldItemListInterface/9.x

    // Due to cardinality configuration, the field contains several references.
    \dump('-- Using magic method');
    // You get the first reference.
    \dump($entity->field_types->target_id);
    // You get the first reference.
    \dump($entity->get('field_types')->target_id);

    \dump('-- Using getters');
    // You get all the references.
    \dump($entity->get('field_types')->getValue());
    // You get the first reference.
    \dump($entity->get('field_types')->first()->getValue());
    // You get the first reference.
    \dump($entity->get('field_types')->getString());
    // You get all the entities.
    \dump($entity->get('field_types')->referencedEntities());
  }

}
