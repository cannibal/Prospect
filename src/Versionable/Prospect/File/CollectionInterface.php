<?php

namespace Versionable\Prospect\File;

use Versionable\Prospect\File\FileInterface;

interface CollectionInterface
{
  public function toString();

  public function add(FileInterface $file);

  public function setBoundary($boundary);
}
