<?php

namespace SetBased\Abc\Request;

/**
 * Class providing information about an HTTP request.
 *
 * It provides an interface to retrieve request parameters from
 * <ul>
 * <li>$_SERVER resolving inconsistency among different web servers
 * <li>$_POST
 * <li>$_COOKIES
 * <li>REST parameters sent via other HTTP methods
 * </ul>
 */
class CoreRequest implements Request
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the method of the current request.
   *
   * @return string
   *
   * @api
   * @since 1.0.0
   */
  public function getMethod(): string
  {
    if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']))
    {
      return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
    }

    if (isset($_SERVER['REQUEST_METHOD']))
    {
      return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    return 'GET';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the requested relative URL after. It includes the query part if any.
   *
   * @return string
   *
   * @api
   * @since 1.0.0
   */
  public function getRequestUri(): string
  {
    if (isset($_SERVER['REQUEST_URI']))
    {
      $requestUri = $_SERVER['REQUEST_URI'];
      if ($requestUri!=='' && $requestUri[0]!=='/')
      {
        $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
      }

      return $requestUri;
    }

    throw new \LogicException('Unable to resolve requested URI');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is an AJAX (XMLHttpRequest) request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isAjax(): bool
  {
    return (($_SERVER['HTTP_X_REQUESTED_WITH']) ?? '')==='XMLHttpRequest';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a DELETE request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isDelete(): bool
  {
    return $this->getMethod()==='DELETE';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if the current environment is a development environment.
   *
   * @return bool
   */
  public function isEnvDev(): bool
  {
    return ($_SERVER['ABC_ENV']==='dev');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if the current environment is a production environment.
   *
   * @return bool
   */
  public function isEnvProd(): bool
  {
    return ($_SERVER['ABC_ENV']==='prod');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a GET request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isGet(): bool
  {
    return $this->getMethod()==='GET';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a HEAD request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isHead(): bool
  {
    return $this->getMethod()==='HEAD';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a OPTIONS request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isOptions(): bool
  {
    return $this->getMethod()==='OPTIONS';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a PATCH request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isPatch(): bool
  {
    return $this->getMethod()==='PATCH';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a POST request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isPost(): bool
  {
    return $this->getMethod()==='POST';
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if this is a PUT request. Otherwise returns false.
   *
   * @return bool
   *
   * @api
   * @since 1.0.0
   */
  public function isPut(): bool
  {
    return $this->getMethod()==='PUT';
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
