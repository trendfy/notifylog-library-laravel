<?php

namespace NotifyLog\Laravel;


class Configuration
{
    /**
     * Remote endpoint to send data.
     *
     * @var string
     */
    protected $url = 'https://app.notifylog.com/api/v1/event';

    /**
     * Authentication key.
     *
     * @var string
     */
    protected $accountToken;

    /**
     * @var string
     */
    protected $version = '0.0.1';

    /**
     * @var string
     */
    protected $platform = 'PHP-Laravel';


    /**
     * Environment constructor.
     *
     * @param null|string $accountToken
     * @throws \InvalidArgumentException
     */
    public function __construct($accountToken = null)
    {
        if (!is_null($accountToken) && !empty($accountToken)) {
            $this->setAccountToken($accountToken);
        }
    }


    /**
     * Set ingestion url.
     *
     * @param string $value
     * @return Configuration
     */
    public function setUrl($value): Configuration
    {
        $value = trim($value);

        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid URL');
        }

        $this->url = $value;
        return $this;
    }

    /**
     * Get ingestion endpoint.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Verify if api key is well formed.
     *
     * @param $value
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setAccountToken($value): Configuration
    {
        $value = trim($value);

        if (empty($value)) {
            throw new \InvalidArgumentException('Account Token cannot be empty');
        }

        $this->accountToken = $value;
        return $this;
    }

    /**
     * Get current API key.
     *
     * @return string
     */
    public function getAccountToken(): string
    {
        return $this->accountToken;
    }

    /**
     * Get the package version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Set the package version.
     *
     * @param string $value
     * @return $this
     */
    public function setVersion($value): Configuration
    {
        $this->version = $value;
        return $this;
    }

    /**
     * Get the package platform.
     *
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * Set the package platform.
     *
     * @param string $value
     * @return $this
     */
    public function setPlatform($value): Configuration
    {
        $this->platform = $value;
        return $this;
    }
}
