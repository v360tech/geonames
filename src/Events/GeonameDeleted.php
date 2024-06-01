<?php

namespace V360Tech\Geonames\Events;

use Illuminate\Queue\SerializesModels;
use V360Tech\Geonames\Models\GeonamesDelete;

/**
 * Class GeonameDeleted
 * @package V360Tech\Geonames\Events
 */
class GeonameDeleted
{
  use SerializesModels;

  public $geonameDelete;

  /**
   * Create a new Event instance.
   * GeonameDeleted constructor.
   * @param GeonamesDelete $geonameDelete
   */
  public function __construct(GeonamesDelete $geonameDelete)
  {
    $this->geonameDelete = $geonameDelete;
  }
}
