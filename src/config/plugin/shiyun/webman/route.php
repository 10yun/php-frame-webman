<?php

declare(strict_types=1);

use shiyun\bootstrap\AnnotationBootstrap;

use shiyun\route\RouteAnnotationHandle;

if (!AnnotationBootstrap::isIgnoreProcess()) {
    RouteAnnotationHandle::createRoute();
}
