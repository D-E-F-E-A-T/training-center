<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerQ2hxcNV\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerQ2hxcNV/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerQ2hxcNV.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerQ2hxcNV\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerQ2hxcNV\App_KernelDevDebugContainer([
    'container.build_hash' => 'Q2hxcNV',
    'container.build_id' => '2711726a',
    'container.build_time' => 1578256776,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerQ2hxcNV');
