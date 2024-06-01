<?php

namespace V360Tech\Geonames\Events;

use Illuminate\Queue\SerializesModels;
use V360Tech\Geonames\Models\Geoname;

/**
 * Class GeonameUpdated
 * @package V360Tech\Geonames\Events
 */
class GeonameUpdated
{
  use SerializesModels;

  public $geoname;

  /**
   * Create a new Event instance.
   * GeonameUpdated constructor.
   * @param Geoname $geoname
   */
  public function __construct(Geoname $geoname)
  {
    $this->geoname = $geoname;
  }
}
