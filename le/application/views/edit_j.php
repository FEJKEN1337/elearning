<div class="row">
  
  <?php    $this->load->view('partials/admin_menu'); ?>
    
    
    
        <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
        <?php if ($posts): ?>

        
        <div class="span6">
                <h3>Jednostki aktywne w systemie </h3>
        <table class="table table-striped">
<!--<table border="1">-->
    <tr>
        <td ><b>id</b></td>
        <td ><b>nazwa jednostki</b></td>
         <td ><b>mail</b></td>
         <td ><b>status</b></td>
    
    

    </tr>     
    
          <!-- Dla każdego wpisu wykonujemy pętlę -->
            <?php foreach ($posts as $p): ?>
      <tr>
      <td><?php echo nl2br(htmlspecialchars($p['id'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['nazwisko'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['email'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['status'])); ?></td>
      
     
  </td>
      
   
</tr>
	
         <?php endforeach; ?>

  </table>
            </div>
        
                <?php else: ?>
        
        
            <div class="well">
                Brak wpisów w bazie danych.
            </div>
        <?php endif; ?>
    






<div class="span6">
                    
                       
		          	<label class="control-label" for="VALID">imię</label>
        
<?php echo form_open("setup/add_jednostke/"); ?>
                                <input type="text" class="span6" id="jednostka" name="jednostka" value="" >
                                	<label class="control-label" for="VALID">nazwisko</label>
                                <input type="text" class="span6" id="jednostka" name="jednostka" value="" >
                                <label class="control-label" for="VALID">status</label>
                                <input type="text" class="span6" id="jednostka" name="jednostka" value="" >
                                
    <?php 
    echo form_submit('posts/add_os_odpowiezialna/', 'dodaj', 'class="btn"');
    echo form_close();
     ?>
	        	

</div></div>





