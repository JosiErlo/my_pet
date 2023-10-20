
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif;?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif;?>
<?php
    echo "Email do usuário:". session('email');
    echo "<br>";
    echo "Data e hora login:". session('data_login');
    echo "<hr>";
    echo "Data e hora cadastro:". session('data_cad');
    echo "<br>";
    echo lang('App.welcome', [], session('user_locale'));
?>

<a href="/language/en/">English</a> | <a href="/language/pt-BR/">Português</a>

