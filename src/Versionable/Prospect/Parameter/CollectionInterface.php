<?php

namespace Versionable\Prospect\Parameter;

interface CollectionInterface
{
  public function toString();

  /**
   * @return array
   */
  public function toArray();
}
