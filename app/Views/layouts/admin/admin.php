<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('content-title'); ?> | Pondok Baliku</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/main/app.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?= base_url('assets/css/shared/iconly.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
<div id="app">

    <?= $this->include('layouts/admin/sidebar'); ?>
    <div id="main">
        <?= $this->include('layouts/admin/header'); ?>

        <div class="page-content">
            <?= $this->renderSection('content-body'); ?>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 © Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('assets/js/app.js'); ?>"></script>

    <script src="<?= base_url('assets/js/pages/dashboard.js'); ?>"></script>
    <script>
        $(".nominal").inputmask({
            alias : "currency",
            groupSeparator: ",",
            prefix: "",
            placeholder: "",
            allowPlus: false,
            allowMinus: false,
            rightAlign: false,
            digits: 0,
            removeMaskOnSubmit: true,
        });

        $("a.image-zoom").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
    </script>

    <script>
        function render_errors(element, errors) {
            var keys = Object.keys(errors);

            $(element).html('');
            $(element).removeClass('d-none');

            var html = '<ul style="margin: 0">';

            for (const key of keys) {
                html += '<li>' + errors[key] + '</li>';
            }

            html += '</ul>';

            $(element).html(html);
        }
    </script>

    <?= $this->renderSection('content-script'); ?>
</body>

</html>
