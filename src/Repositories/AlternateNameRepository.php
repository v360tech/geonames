<?php

namespace V360Tech\Geonames\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use V360Tech\Geonames\Models\AlternateName;


class AlternateNameRepository
{


  /**
   * @param int $geonameId
   * @return Collection
   */
  public function getByGeonameId(int $geonameId): Collection
  {

    return AlternateName::on(env('DB_GEONAMES_CONNECTION'))
      ->where('geonameid', $geonameId)
      ->get();
  }
}
