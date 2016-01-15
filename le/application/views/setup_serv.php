

    <?php $this->load->view('partials/admin_menu'); ?>



    <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
    <?php if ($posts):  ?>

    <div class="row">
    <div class="span6">
        <h3>servery rozproszone moodle </h3>
        <table class="table table-striped">
<!--<table border="1">-->
            <tr>
                <td ><b>id</b></td>
                <td ><b>nazwa serwera</b></td>
                <td ><b>opis</b></td>
                <td ><b></b></td>


            </tr>     

            <!-- Dla każdego wpisu wykonujemy pętlę -->
            
                <?php 
                $segment =$this->uri->segment(3);
                foreach ($posts as $p): ?>
            <tr>
                <td> <?php echo nl2br(htmlspecialchars($p['id'])); ?></td>
                <td> <?php echo nl2br(htmlspecialchars($p['name'])); ?></td>
                <td> <?php echo nl2br(htmlspecialchars($p['tech_des'])); ?></td>
                <td> <?php echo "<a href=" .site_url('setup'). "/del_srv/" .$p['id']. "/><i class=icon-trash></i></a>&nbsp;" ?> 
                    <?php echo "<a href=" .site_url('setup'). "/edit_serv/".$p['id']."><i class=icon-edit></i></a>" ?> 
                </td>

                </td>
            </tr>

             
    
        <?php 
        if(($p['id'])==$segment) {
            $server_        =   $p['name'];
            $server_opis    =   $p['tech_des'];
            $url            =   $p['url'];
            $id             =   $p['id'];
        }
        
        endforeach; ?>

        </table>
    </div>

    <?php else: ?>


    <div class="well">
        Brak wpisów w bazie danych.
    </div>
    <?php endif; ?>
    

    <div class="span5">
        <label class="control-label" for="VALID">dodaj nową encje</label>

        <?php echo form_open("setup/add_serv/"); ?>
        --nazwa
        <input type="text" class="span5" id="jednostka" name="server_" value="<?php echo @set_value('server_',$server_); ?>" >
        --opis
        <input type="text" class="span5" id="jednostka" name="server_opis" value="<?php echo @set_value('server_opis',$server_opis); ?>" >
        --url
         <input type="text" class="span5" id="jednostka" name="url" value="<?php echo @set_value('url',$url); ?>">
        
        <input type="hidden" class="span5" id="jednostka" name="id" value="<?php echo @set_value('id',$id); ?>">
        
        <?php
         echo form_submit("setup/add_serv/edit", 'dodaj', 'class="btn"');
        echo form_close();
        ?>

    </div>
    </div>



    



