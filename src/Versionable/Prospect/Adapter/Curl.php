<?php

namespace Versionable\Prospect\Adapter;

use Versionable\Prospect\Request\RequestInterface;
use Versionable\Prospect\Response\ResponseInterface;
use Versionable\Prospect\Parameter\ParameterInterface;
use Versionable\Prospect\File\FileInterface;

class Curl extends AdapterAbstract
{
  /** @var resource Curl resource */
  private $handle = null;

  public function __construct()
  {
    if (!extension_loaded('curl')) {
      throw new \RuntimeException('Curl extension not loaded');
    }
  }

  /**
   * This function initialised the curl filehandle
   */
  protected function initialiseHandle()
  {
    $this->handle = curl_init();
  }

  protected function getHandle()
  {
    return $this->handle;
  }

  public function initialise()
  {
    $this->initialiseHandle();

    $this->setOption(\CURLOPT_RETURNTRANSFER, true);
    $this->setOption(\CURLOPT_NOBODY, null);
    $this->setOption(\CURLOPT_FOLLOWLOCATION, true);
    $this->setOption(\CURLOPT_MAXREDIRS, 5);
    $this->setOption(\CURLOPT_HEADER, true);
  }

  protected function setCurlOptions()
  {
    foreach($this->getOptions() as $option => $value){
      $this->setCurlOption($option, $value);
    }
  }

  protected function setCurlOption($option, $value)
  {
    \curl_setopt($this->getHandle(), $option, $value);
  }

  protected function setUrl(RequestInterface $request)
  {
    $this->setOption(\CURLOPT_URL, $request->getUrl());
    $this->setOption(\CURLOPT_PORT, $request->getPort());
  }

  protected function setRequestMethod(RequestInterface $request)
  {
    if ($request->getMethod() == 'GET') {
      $this->setOption(\CURLOPT_HTTPGET, true);

    } elseif ($request->getMethod() == 'POST') {
      $this->setOption(\CURLOPT_POST, true);

    } else {
      $this->setOption(\CURLOPT_CUSTOMREQUEST, $request->getMethod());
    }
  }

  protected function setFields(RequestInterface $request)
  {
    $post = array();
    /** @var ParameterInterface $param */
    foreach ($request->getParameters() as $param) {
      $post[$param->getName()] = $param->getValue();
    }

    $files = array();
    /** @var FileInterface $file */
    foreach ($request->getFiles() as $file) {
      $files[$file->getName()] = '@' . $file->getValue() . ';type=' . $file->getType();
    }

    switch ($request->getMethod()) {
      case 'POST':
      case 'PUT':
      case 'PATCH':
        // Files and any parameters - note body is not used
        if (!empty($files)) {
          $body = array_merge($post, $files);
        } // Only parameters
        elseif (!empty($post)) {
          $body = http_build_query($post);
        } else {
          $body = $request->getBody();
        }

        $this->setOption(\CURLOPT_POSTFIELDS, $body);
        break;
    }
  }


  protected function setHeaders(RequestInterface $request)
  {
    if (!$request->getHeaders()->isEmpty()) {
      $this->setOption(\CURLOPT_HTTPHEADER, $request->getHeaders()->toArray());
    }
  }

  protected function setCookies(RequestInterface $request)
  {
    if (!$request->getCookies()->isEmpty()) {
      $this->setOption(\CURLOPT_COOKIE, $request->getCookies()->toString());
    }
  }

  /**
   * This function executes the curl request
   *
   * @return mixed
   */
  protected function send(RequestInterface $request, ResponseInterface $response)
  {
    $this->setCurlOptions();

    $returned =  \curl_exec($this->handle);

    if (!$returned) {
      throw new \RuntimeException('Error connecting to host: ' . $request->getUrl()->getHostname());
    }

    return $returned;
  }

  public function call(RequestInterface $request, ResponseInterface $response)
  {
    $this->initialise();

    $this->setUrl($request);
    $this->setRequestMethod($request);

    $this->setFields($request);

    $this->setCookies($request);
    $this->setHeaders($request);

    $returned = $this->send($request, $response);

    $response->parse($returned);

    return $response;
  }
}
