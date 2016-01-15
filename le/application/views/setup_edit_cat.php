<?php    $this->load->view('partials/admin_menu'); ?>
    
    
    
    <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
        <?php if ($posts): ?>

        <div class="row">
        <div class="span10">
                
        <table class="table table-condensed" >
<!--<table border="1">-->
    <tr>
        <td >Level <b>1</b></td>
        <td >Level <b>2</b></td>
        <td >Level <b>3</b></td>
    
    

    </tr>     
    
          <!-- Dla każdego wpisu wykonujemy pętlę -->
            
      <tr>
        
        <td>
            <?php
        foreach ($posts as $p):        
                if  ( $p['Level']=='1')   
                    { 
                    //echo nl2br(htmlspecialchars($p['id']))."-";
                    echo "<a href=".site_url('setup')."/del_cat/".$p['id']."><i class=icon-trash></i></a> :: ";
                    echo nl2br(htmlspecialchars($p["nazwa"]))."<br>";
                    }; 
                    endforeach;?>
        </td>
        
        <td><?php
        foreach ($posts as $p):        
                if  ( $p['Level']=='2')   { 
                    //echo nl2br(htmlspecialchars($p['id']))."-";
                    echo "<a href=".site_url('setup')."/del_cat/".$p['id']."><i class=icon-trash></i></a> :: ";
                    echo nl2br(htmlspecialchars($p['nazwa']))."<br>";
                }; 
                    endforeach;?>
        </td>
        
        <td><?php
        foreach ($posts as $p):        
                if  ( $p['Level']=='3')   { 
                    //echo nl2br(htmlspecialchars($p['id']))."-";
                    echo "<a href=".site_url('setup')."/del_cat/".$p['id']."><i class=icon-trash></i></a> :: ";
                    echo nl2br(htmlspecialchars($p['nazwa']))."<br>";
                }; 
                    endforeach;?>
        </td>
        <td>-</td>
      </tr>
  </table>
            
            
            <br><br><br>
            
        <?php echo form_open('setup/add_cat'); 

         echo form_input('jednostka_wojskowa', $this->input->post('jednostka_wojskowa'));?>
        <select name="kategoria" >Level
        <option value="1"> Level 1 </option>
        <option value="2"> Level 2 </option>
        <option value="3"> Level 3 </option>
   </select>
    
    <?php 
    echo form_submit('setup/add_cat/', 'dodaj','class="btn"');
    echo form_close();?>
            
            
            </div>
        
                <?php else: ?>
        
        
            <div class="well">
                Brak wpisów w bazie danych.
            </div>
        <?php endif; ?>
    

</div>