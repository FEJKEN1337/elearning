
  
  <?php    $this->load->view('partials/admin_menu'); ?>
    
    
    
        <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
        <?php if ($posts): ?>

        <div class="row">
        <div class="span12">
                <h3>Artykóly menu</h3>
        <table class="table table-striped">
<!--<table border="1">-->
    <tr>
        <td ><b>id</b></td>
        <td ><b>tytuł</b></td>
         <td ><b>treść</b></td>
         <td ><b>status</b></td>
         <td ></td>
    
    

    </tr>     
    
          <!-- Dla każdego wpisu wykonujemy pętlę -->
            <?php foreach ($posts as $p): ?>
      <tr>
      <td><?php echo nl2br(htmlspecialchars($p['id'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['temat'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['tresc'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['aktywny'])); ?></td>
      <td> 
      <?php  echo "<a href=".site_url('setup')."/del_art/".$p['id']."><i class=icon-trash></i></a><br><br>"; ?>
      
      <?php echo "<a href=" .site_url('setup'). "/s_artykul?id=".$p['id']."><i class=icon-edit></i></a>" ?> 
     
       <?php

       if (isset($_GET["id"])){
       
           if ($_GET["id"] == $p['id']){
           $tresc['temat']=     $p['temat'];
           $tresc['tresc']=     $p['tresc'];
           $tresc['aktywny']=   $p['aktywny'];
           $tresc['id']=   $p['id'];
       
       };    
       }; //if ($_GET["id"] == $p['id']){
       ?>
          
          
      </td>
      
  </td>
      
   
</tr>
	
         <?php endforeach; ?>

  </table>
            
        
                <?php else: ?>
        
        
            <div class="well">
                Brak wpisów w bazie danych.
            </div>
        <?php endif; ?>
    </div>
        </div>    
<div class="row">    


<div class="span5">

    <?php
    
    ?>
    
    <?php echo form_open("setup/add_art/"); ?>

    <label class="control-label" for="VALID">tytuł</label>
    <textarea type="text" class="span12" id="imie" name="temat" value=""><?php if(isset($tresc['temat'])) {echo $tresc['temat'];};?> </textarea>
    
    <label class="control-label" for="VALID">treść</label>
    <textarea type="text" class="span12" id="mail" name="tresc" value="" cols='50' rows="10" ><?php if(isset($tresc['tresc'])) {echo $tresc['tresc'];};?></textarea>
    <label class="control-label" for="VALID">status:: /1 aktywny   </label>
    <select name="status" class="span4">
        <option value="0"> 0 </option>
        <option value="1"> 1</option>
    </select>
    
    <input type="hidden" name="id_art" value="<?php if(isset($tresc['id'])) {echo $tresc['id'];};?>">
    
    
    <br><br>


                                
                                
                                
                                
                                
                                
    <?php 
    echo form_submit('setup/add_art/', 'dodaj', 'class="btn"');
    echo form_close();
     ?>
	        	

</div>
            </div>

        <?php
       // phpinfo();
        ?>