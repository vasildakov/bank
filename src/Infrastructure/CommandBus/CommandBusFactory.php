<?php
declare(strict_types = 1);

namespace Infrastructure\CommandBus;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Container\ContainerLocator;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use Interop\Container\ContainerInterface;

use Application\Service\Ping\PingCommand;
use Application\Handler\PingHandler;

/**
 * Class CommandBusFactory
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 */
class CommandBusFactory
{
    /**
     * @param  ContainerInterface $container
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container)
    {
        $inflector = new InvokeInflector();

        $commandsMapping = [
            PingCommand::class => PingHandler::class
        ];

        $locator = new ContainerLocator($container, $commandsMapping);

        $nameExtractor = new ClassNameExtractor();

        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            $nameExtractor,
            $locator,
            $inflector
        );

        $commandBus = new CommandBus([
            $commandHandlerMiddleware
        ]);

        return $commandBus;
    }
}
