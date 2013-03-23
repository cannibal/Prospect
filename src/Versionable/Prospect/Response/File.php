<?php

namespace Versionable\Prospect\Response;

use Versionable\Prospect\Response\FileResponseInterface;

class File extends Response implements FileResponseInterface
{
  /**
   * @var string Filename
   */
  protected $filename = null;

  public function __construct()
  {
      $this->filename = sys_get_temp_dir().DIRECTORY_SEPARATOR.uniqid('prospect_', true);
  }

  public function getFilename()
  {
      return $this->filename;
  }

  public function setFilename($filename)
  {
      $this->filename = $filename;
  }
}
