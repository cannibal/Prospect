<?php

namespace Versionable\Prospect\File;

interface FileInterface
{
  public function toString();

  public function getName();

  public function getValue();

  public function getContent();

  public function getType();

  public function setType($type);
}
