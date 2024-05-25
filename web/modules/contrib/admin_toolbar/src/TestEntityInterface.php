<?php

declare(strict_types=1);

namespace Drupal\admin_toolbar;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a test entity entity type.
 */
interface TestEntityInterface extends ContentEntityInterface, EntityChangedInterface {

}
