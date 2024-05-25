<?php

declare(strict_types=1);

namespace Drupal\admin_toolbar\Entity;

use Drupal\admin_toolbar\TestEntityInterface;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the test entity entity class.
 *
 * @ContentEntityType(
 *   id = "admin_toolbar_test_entity",
 *   label = @Translation("Test Entity"),
 *   label_collection = @Translation("Test Entities"),
 *   label_singular = @Translation("test entity"),
 *   label_plural = @Translation("test entities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count test entities",
 *     plural = "@count test entities",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\admin_toolbar\TestEntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\admin_toolbar\TestEntityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\admin_toolbar\Form\TestEntityForm",
 *       "edit" = "Drupal\admin_toolbar\Form\TestEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "admin_toolbar_test_entity",
 *   admin_permission = "administer admin_toolbar_test_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/test-entity",
 *     "add-form" = "/test-entity/add",
 *     "canonical" = "/test-entity/{admin_toolbar_test_entity}",
 *     "edit-form" = "/test-entity/{admin_toolbar_test_entity}/edit",
 *     "delete-form" = "/test-entity/{admin_toolbar_test_entity}/delete",
 *     "delete-multiple-form" = "/admin/content/test-entity/delete-multiple",
 *   },
 *   field_ui_base_route = "entity.admin_toolbar_test_entity.settings",
 * )
 */
final class TestEntity extends ContentEntityBase implements TestEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the test entity was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the test entity was last edited.'));

    return $fields;
  }

}
