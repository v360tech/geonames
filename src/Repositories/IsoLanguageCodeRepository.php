<?php

namespace V360Tech\Geonames\Repositories;

use Illuminate\Support\Collection;
use V360Tech\Geonames\Models\IsoLanguageCode;

class IsoLanguageCodeRepository
{

  /**
   * @return Collection
   */
  public function all()
  {
    return IsoLanguageCode::all();
  }
}
