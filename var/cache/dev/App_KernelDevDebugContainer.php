<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXHU2wxx\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXHU2wxx/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXHU2wxx.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXHU2wxx\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerXHU2wxx\App_KernelDevDebugContainer([
    'container.build_hash' => 'XHU2wxx',
    'container.build_id' => '8a82abcd',
    'container.build_time' => 1577889379,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXHU2wxx');