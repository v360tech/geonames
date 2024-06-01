<?php

namespace V360Tech\Geonames\Models;

use V360Tech\Geonames\Console\AlternateName as AlternateNameConsole;

class AlternateNamesWorking extends AlternateName
{

  protected $table = AlternateNameConsole::TABLE_WORKING;
}
