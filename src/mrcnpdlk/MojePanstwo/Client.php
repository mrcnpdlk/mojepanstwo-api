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

    public function __construct(string $apiUrl = 'https://api-v3.mojepanstwo.pl/dane/')
    {
        $this->sApiUrl = $apiUrl;
    }

    private function curlRequest(string $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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

    public function request(string $context, int $id = null, QueryBuilder $oParams = null)
    {
        $tPath = [
            rtrim($this->sApiUrl, '/'),
            trim($context, '/'),
        ];
        if (!is_null($id)) {
            $tPath[] = $id;
        }
        if (!is_null($oParams)) {
            $tPath[] = '?' . $oParams->getQuery();
        }
        $url = implode('/', $tPath);

        return $this->oCacheAdapter->useCache(
            function () use ($url) {
                return $this->curlRequest($url);
            },
            [$url],
            60
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
