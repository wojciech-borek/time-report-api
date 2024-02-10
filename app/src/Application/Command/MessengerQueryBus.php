<?php


namespace App\Application\Command;


use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $messageBus) {
        $this->messageBus = $messageBus;
    }


    public function handle(CommandInterface $message)
    {
        return $this->handleQuery($message);
    }

}