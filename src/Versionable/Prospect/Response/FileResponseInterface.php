<?php
/**
 * Created by Adam White (cannibal234@gmail.com)
 */

namespace Versionable\Prospect\Response;

interface FileResponseInterface 
{
  /**
   * This function gets the destination filename
   *
   * @return string
   */
  public function getFilename();

  /**
   * This function sets the destination filename that will be used to contain the curl response
   *
   * @param $filename
   */
  public function setFilename($filename);
}