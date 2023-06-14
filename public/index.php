<?php

// Imports
require_once __DIR__.'/../includes/autoload.php';
use MVC\AdminRouter;
use Controllers\AdminController;
use Controllers\SellersController;

// Instances
$adminRouter = new AdminRouter();

// Admin Panel URL
$adminRouter->get('/admin', [AdminController::class, 'admin']);

// GET RealEstates URL's
$adminRouter->get('/admin/realestates/create', [AdminController::class, 'create']);
$adminRouter->get('/admin/realestates/update', [AdminController::class, 'update']);

// POST RealEstates URL's
$adminRouter->post('/admin/realestates/create', [AdminController::class, 'create']);
$adminRouter->post('/admin/realestates/update', [AdminController::class, 'update']);
$adminRouter->post('/admin/realestates/delete', [AdminController::class, 'delete']);

// GET Sellers URL's
$adminRouter->get('/admin/sellers/create', [SellersController::class, 'create']);
$adminRouter->get('/admin/sellers/update', [SellersController::class, 'update']);

// POST Sellers URL's
$adminRouter->post('/admin/sellers/create', [SellersController::class, 'create']);
$adminRouter->post('/admin/sellers/update', [SellersController::class, 'update']);
$adminRouter->post('/admin/sellers/delete', [SellersController::class, 'delete']);

// Check Valid URL's
$adminRouter->checkPaths();
