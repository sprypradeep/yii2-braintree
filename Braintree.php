<?php
/**
 * @author Pradeep Sharma <pradeep@sprytechies.com>
 */

namespace sprypradeep\braintree;

use yii\base\Component;
use yii\base\InvalidConfigException;

class Braintree extends Component
{
    public $environment;
    public $merchantId;
    public $publicKey;
    public $privateKey;

    private $_prefix = 'Braintree';

    public function init()
    {
        if (!$this->environment) {
            throw new InvalidConfigException('Environment is required');
        }
        if (!$this->merchantId) {
            throw new InvalidConfigException('Merchant ID is required');
        }
        if (!$this->publicKey) {
            throw new InvalidConfigException('Public Key is required');
        }
        if (!$this->privateKey) {
            throw new InvalidConfigException('Private Key is required');
        }

        $this->setupConfig();
    }

    /**
     *v setup a config
     */
    public function setupConfig()
    {
        \Braintree_Configuration::environment($this->environment);
        \Braintree_Configuration::merchantId($this->merchantId);
        \Braintree_Configuration::publicKey($this->publicKey);
        \Braintree_Configuration::privateKey($this->privateKey);
    }

    /**
     * @param $command
     * @param $method
     * @param $values
     * @return mixed
     */
    public function call($command, $method, $values)
    {
        $class = strtr("{class}_{command}", [
            '{class}' => $this->_prefix,
            '{command}' => $command,
        ]);

        return call_user_func(array($class, $method), $values);
    }
} 
