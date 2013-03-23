<?php

namespace Versionable\Prospect\Request;

use Versionable\Prospect\Url\UrlInterface;
use Versionable\Prospect\Cookie\CollectionInterface as CookieCollectionInterface;
use Versionable\Prospect\Header\CollectionInterface as HeaderCollectionInterface;
use Versionable\Prospect\Parameter\CollectionInterface as ParameterCollectionInterface;
use Versionable\Prospect\File\CollectionInterface as FileCollectionInterface;

interface RequestInterface
{
  public function setUrl(UrlInterface $url);

  /**
   * This method returns the uri for the current request
   *
   * @return \Versionable\Prospect\Url\UrlInterface
   */
  public function getUrl();

  /**
   * This function sets the body of the request
   *
   * @param $body
   */
  public function setBody($body);

  /**
   * This function returns the body of the request
   *
   * @return string
   */
  public function getBody();

  /**
   * This function sets the parameters to be used when the request is sent
   *
   * @param ParameterCollectionInterface $parameters
   */
  public function setParameters(ParameterCollectionInterface $parameters);

  /**
   * This function returns a collection of parameters
   *
   * @return \Versionable\Prospect\Parameter\CollectionInterface
   */
  public function getParameters();

  /**
   * This function sets the files to be uploaded when the request is sent
   *
   * @param FileCollectionInterface $files
   */
  public function setFiles(FileCollectionInterface $files);

  /**
   * This function returns a collection of files
   *
   * @return \Versionable\Prospect\File\CollectionInterface
   */
  public function getFiles();

  /**
   * This function sets the method of the request
   *
   * @param $method
   */
  public function setMethod($method);

  /**
   * This function returns the method of the request
   *
   * @return mixed
   */
  public function getMethod();

  /**
   * This function returns a collection of headers
   *
   * @return \Versionable\Prospect\Header\CollectionInterface
   */
  public function getHeaders();

  /**
   * This function sets the headers to use for this request
   *
   * @param HeaderCollectionInterface $headers
   */
  public function setHeaders(HeaderCollectionInterface $headers);

  /**
   * @return \Versionable\Prospect\Cookie\CollectionInterface
   */
  public function getCookies();

  /**
   * This function sets the cookie values
   *
   * @param CookieCollectionInterface $collection
   */
  public function setCookies(CookieCollectionInterface $collection);

  /**
   * This function sets the port to use for this request
   *
   * @param $port
   */
  public function setPort($port);

  /**
   * This function returns the port
   *
   * @return int|null
   */
  public function getPort();

  /**
   * This function sets the version
   *
   * @param $version
   */
  public function setVersion($version);

  /**
   * This function returns the version
   *
   * @return mixed
   */
  public function getVersion();
}
