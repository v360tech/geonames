<?php

namespace V360Tech\Geonames\Tests;

use V360Tech\Geonames\Models\GeoSetting;

class InstallGeoSettingTest extends BaseInstallTestCase
{

  /**
   * This same code was being called repeatedly through these tests.
   */
  protected function geoSettingInstallForTest()
  {
    echo "\nCalling GeoSetting::install()...";
    GeoSetting::install(
      ['BS', 'YU', 'UZ'],
      ['en'],
      'geonames',
      $this->DB_CONNECTION
    );
    echo "\nComplete.\n";
  }

  /**
   * This same code was being called repeatedly through these tests.
   */
  protected function geoSettingInitForTest()
  {
    echo "\nCalling GeoSetting::init()...\n";
    GeoSetting::init(
      ['BS', 'YU', 'UZ'],
      ['en'],
      'geonames',
      $this->DB_CONNECTION
    );
  }


  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingGetConnectionNameShouldReturnString()
  {
    $this->geoSettingInstallForTest();
    $connectionName = GeoSetting::getDatabaseConnectionName();
    $this->assertEquals($this->DB_CONNECTION, $connectionName);
  }

  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingInstall()
  {
    $this->geoSettingInstallForTest();
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
  }


  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingInstallAfterInstall()
  {
    $this->geoSettingInstallForTest();
    $this->geoSettingInstallForTest();
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
  }

  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingInit()
  {
    $this->geoSettingInitForTest();
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
  }


  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingInitAfterInstall()
  {
    $this->geoSettingInstallForTest();
    $this->geoSettingInitForTest();
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
  }


  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingAddExistingLanguageAfterInstall()
  {
    $this->geoSettingInstallForTest();
    GeoSetting::addLanguage('en', 'testing');
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
    $this->assertIsArray($geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertEquals('en', $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES}[0]);
  }

  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingAddNewLanguageAfterInstall()
  {
    $this->geoSettingInstallForTest();
    GeoSetting::addLanguage('gb', 'testing');
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
    $this->assertIsArray($geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertCount(2, $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertEquals('gb', $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES}[1]);
  }

  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingRemoveNewlyAddedLanguage()
  {
    $this->geoSettingInstallForTest();

    GeoSetting::addLanguage('gb', 'testing');
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
    $this->assertIsArray($geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertCount(2, $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertEquals('gb', $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES}[1]);

    GeoSetting::removeLanguage('en', 'testing');
    $geoSetting = GeoSetting::first();
    $this->assertInstanceOf(GeoSetting::class, $geoSetting);
    $this->assertIsArray($geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertCount(1, $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES});
    $this->assertEquals('gb', $geoSetting->{GeoSetting::DB_COLUMN_LANGUAGES}[0]);
  }


  /**
   * @test
   * @group install
   * @group geosetting
   */
  public function testGeoSettingAttemptToRemoveNonexistentLanguageShouldReturnTrue()
  {
    $this->geoSettingInstallForTest();
    $result = GeoSetting::removeLanguage('xx', 'testing');
    $this->assertTrue($result);
  }
}
