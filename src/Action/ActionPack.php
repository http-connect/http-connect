<?php

namespace HttpConnect\HttpConnect\Action;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use HttpConnect\HttpConnect\Action\Exceptions\ActionNotFoundException;
use HttpConnect\HttpConnect\Action\Exceptions\InvalidActionException;

class ActionPack implements ContainerInterface
{
    /**
     * @var ActionInterface[]
     */
    private $actions = [];

    /**
     * @param ActionInterface[] $actions
     */
    public function __construct(array $actions)
    {
        foreach ($actions as $id => $action) {
            $id = is_string($id) ? $id : get_class($action);

            if (!$action instanceof ActionInterface) {
                throw $this->createInvalidActionException($id);
            }

            $this->actions[$id] = $action;
        }
    }

    /**
     * @inheritDoc
     * @return ActionInterface
     */
    public function get($id): ActionInterface
    {
        if (!$this->has($id)) {
            throw new ActionNotFoundException(
                "Action \"{$id}\" does not exist in the provided container. " .
                'Make sure you have properly passed it to the container.'
            );
        }

        if (!$this->actions[$id] instanceof ActionInterface) {
            throw $this->createInvalidActionException($id);
        }

        return $this->actions[$id];
    }

    /**
     * @inheritDoc
     */
    public function has($id): bool
    {
        return array_key_exists($id, $this->actions);
    }

    /**
     * @param string $id
     * @return ContainerExceptionInterface
     */
    private function createInvalidActionException(string $id): ContainerExceptionInterface
    {
        $actionInterfaceClass = ActionInterface::class;

        return new InvalidActionException(
            "Action \"{$id}\" does not implement {$actionInterfaceClass}."
        );
    }
}
