<?php
namespace Versionable\Prospect\Adapter;

use Versionable\Prospect\Request\RequestInterface;
use Versionable\Prospect\Response\FileResponseInterface;
use Versionable\Prospect\Response\ResponseInterface;

use Versionable\Prospect\Adapter\Exception\CurlFileException;

class CurlFile extends Curl
{
  private $fileHandle;

  public function initialise()
  {
    parent::initialise();

    $this->setCurlOption(\CURLOPT_RETURNTRANSFER, false);
    $this->setCurlOption(\CURLOPT_HEADER, false);
  }

  protected function send(RequestInterface $request, ResponseInterface $response)
  {
    $this->createDestinationFile($response);

    $this->setCurlOption(\CURLOPT_FILE, $this->fileHandle);

    try{
      $returned = parent::send($request, $response);
      \fclose($this->fileHandle);
    }
    catch(\RuntimeException $e){
      //catch any exception and make sure to close the file
      \fclose($this->fileHandle);
      throw $e;
    }

    $info = \curl_getinfo($this->getHandle());
    $response->setCode($info['http_code']);
  }

  /**
   * This function creates the destination file from the response filename
   *
   * @param ResponseInterface $response
   * @throws Exception\CurlFileException
   */
  protected function createDestinationFile(ResponseInterface $response)
  {
    if (!($response instanceof FileResponseInterface)) {
      throw new CurlFileException('The response instance provided did not implement FileResponseInterface');
    }

    $this->fileHandle = \fopen($response->getFilename(), 'w+');
  }
}
