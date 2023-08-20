<?php helper('auth'); ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?= base_url(); ?>">Malik</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto"> <!-- Menggunakan kelas "ml-auto" di sini -->
            <?php if (in_groups('admin') || in_groups('superuser')) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('room_orders'); ?>">Room Orders</a>
                </li>
            <?php endif; ?>
            <?php if (in_groups('manager') || in_groups('superuser')) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/rooms'); ?>">Rooms</a>
                </li>
            <?php endif; ?>
            <?php if (logged_in()) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= url_to('logout') ?>">Logout</a>
                </li>
            <?php endif; ?>
            <?php if (!(logged_in())) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?> <span class="sr-only">(<?= lang('Auth.current') ?>)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?> <span class="sr-only">(<?= lang('Auth.current') ?>)</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>