<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Pondok Baliku</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/main/app.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?= base_url('assets/css/shared/iconly.css'); ?>">

</head>

<body>
<div id="app">

    <?= $this->include('layouts/admin/sidebar'); ?>
    <div id="main">
        <?= $this->include('layouts/admin/header'); ?>
    </div>
    <?= $this->renderSection('page-content'); ?>

    <script src="<?= base_url('assets/js/app.js'); ?>"></script>

    <script src="<?= base_url('assets/js/pages/dashboard.js'); ?>"></script>
</body>

</html>
