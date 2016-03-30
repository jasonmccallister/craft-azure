<?php

namespace Dukt\Oauth\Guzzle\Subscribers;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Azure extends EventSubscriberInterface
{
    private $config;

    /**
     * Azure constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'request.before_send' => 'onRequestBeforeSend'
        ];
    }

    /**
     * @param Event $event
     */
    public function onRequestBeforeSend(Event $event)
    {
        $accessToken = $this->config['access_token'];
        
        $event['request']->getQuery()->set('token', $accessToken);
    }
}
