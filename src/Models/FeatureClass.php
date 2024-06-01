<?php

namespace V360Tech\Geonames\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureClass extends Model
{
  protected $table        = 'geonames_feature_classes';
  protected $primaryKey   = 'id';
  protected $keyType      = 'string';
  public    $incrementing = false;
  public    $timestamps   = false;
}
