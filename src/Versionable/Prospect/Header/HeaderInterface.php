<?php

namespace Versionable\Prospect\Header;

interface HeaderInterface
{
  public function getName();

  public function getValue();

  public function toString();
}
