<?php

// Imports
require_once __DIR__.'/../includes/autoload.php';
use MVC\AdminRouter;
use Controllers\AdminController;

// Instances
$adminRouter = new AdminRouter();

// GET URL's
$adminRouter->get('/admin', [AdminController::class, 'admin']);
$adminRouter->get('/admin/realestates/create', [AdminController::class, 'create']);
$adminRouter->get('/admin/realestates/update', [AdminController::class, 'update']);

// POST URL's
$adminRouter->post('/admin/realestates/create', [AdminController::class, 'create']);
$adminRouter->post('/admin/realestates/update', [AdminController::class, 'update']);
$adminRouter->post('/admin/realestates/delete', [AdminController::class, 'delete']);

// Check Valid URL's
$adminRouter->checkPaths();
