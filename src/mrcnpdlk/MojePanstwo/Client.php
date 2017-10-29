<?php
/**
 * MOJEPANSTWO-API
 *
 * Copyright © 2017 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */
declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo;


use mrcnpdlk\Psr16Cache\Adapter;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\SimpleCache\CacheInterface;

class Client
{
    /**
     * @var string
     */
    private $sApiUrl;
    /**
     * Cache handler
     *
     * @var CacheInterface
     */
    private $oCache;
    /**
     * @var Adapter
     */
    private $oCacheAdapter;
    /**
     * Logger handler
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $oLogger;

    /**
     * Client constructor.
     *
     * @param string $apiUrl
     */
    public function __construct(string $apiUrl = 'https://api-v3.mojepanstwo.pl/')
    {
        $this->sApiUrl = $apiUrl;
        $this->setLoggerInstance();
        $this->setCacheInstance();
    }

    /**
     * @param string $url
     *
     * @return mixed
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    private function curlRequest(string $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('Request Error: ' . curl_error($ch));
        }
        $respCode = curl_getinfo($ch, \CURLINFO_HTTP_CODE);
        if ($respCode !== 200) {
            throw new Exception('Request Error: ' . $respCode);
        }
        curl_close($ch);

        $resObj = json_decode($output);
        if (\JSON_ERROR_NONE !== json_last_error()) {
            throw new Exception('Unable to parse response body into JSON: ' . json_last_error());
        }

        return $resObj;
    }

    /**
     * Get logger instance
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->oLogger;
    }

    /**
     * @param string                                  $sPrefixedContext
     * @param string|null                             $id
     * @param \mrcnpdlk\MojePanstwo\QueryBuilder|null $oParams
     *
     * @return \stdClass
     * @internal param string $context
     */
    public function request(string $sPrefixedContext, string $id = null, QueryBuilder $oParams = null)
    {
        $tPath = [
            rtrim($this->sApiUrl, '/'),
            trim($sPrefixedContext, '/'),
        ];
        if (!is_null($id)) {
            $tPath[] = $id;
        }
        if (!is_null($oParams)) {
            $tPath[] = '?' . $oParams->getQuery();
        }
        $url = implode('/', $tPath);

        $this->getLogger()->debug(sprintf('REQ: %s', $url));

        return $this->oCacheAdapter->useCache(
            function () use ($url) {
                return $this->curlRequest($url);
            },
            [$url],
            60 * 60 * 24
        );
    }

    /**
     * Setting Cache Adapter
     *
     * @return $this
     */
    private function setCacheAdapter()
    {
        $this->oCacheAdapter = new Adapter($this->oCache, $this->oLogger);

        return $this;
    }

    /**
     * Set Cache handler (PSR-16)
     *
     * @param \Psr\SimpleCache\CacheInterface|null $oCache
     *
     * @return \mrcnpdlk\MojePanstwo\Client
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md PSR-16
     */
    public function setCacheInstance(CacheInterface $oCache = null)
    {
        $this->oCache = $oCache;
        $this->setCacheAdapter();

        return $this;
    }

    /**
     * Set Logger handler (PSR-3)
     *
     * @param \Psr\Log\LoggerInterface|null $oLogger
     *
     * @return $this
     */
    public function setLoggerInstance(LoggerInterface $oLogger = null)
    {
        $this->oLogger = $oLogger ?: new NullLogger();
        $this->setCacheAdapter();

        return $this;
    }

}
