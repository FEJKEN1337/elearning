<?php $this->load->view('partials/admin_menu'); ?>



<!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
<?php if ($posts): ?>

    <div class="row">
        <div class="span12">

            <table class="table table-condensed" >
    <!--<table border="1">-->
                <tr>
                    <td ><b>id</b></td>
                    <td ><b>DES</b></td>
                    <td></td>

                </tr>     

                <!-- Dla każdego wpisu wykonujemy pętlę -->
                <?php foreach ($posts as $p): ?>
                    <tr>
                        <td><?php echo nl2br(htmlspecialchars($p['ID'])); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($p['DES'])); ?></td>


                        <td>          <?php echo "<a href=" . site_url('setup/edit/' . $p['ID']) . "><i class=icon-edit></i></a>  "; ?> </td>

                    </tr>

                <?php endforeach; ?>

            </table>
        </div>

    </div>

<?php else: ?>

    <div class="well">
        Brak wpisów w bazie danych.
    </div>
<?php endif; ?>
    







