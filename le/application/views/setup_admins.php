
  
  <?php    $this->load->view('partials/admin_menu'); ?>
    
    
    
        <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
        <?php if ($posts): ?>

        <div class="row">
        <div class="span6">
                <h3>Użytkownicy systemu </h3>
        <table class="table table-striped">
<!--<table border="1">-->
    <tr>
        <td ><b>id</b></td>
        <td ><b>nazwisko</b></td>
         <td ><b>mail</b></td>
         <td ><b>status</b></td>
         <td ></td>
    
    

    </tr>     
    
          <!-- Dla każdego wpisu wykonujemy pętlę -->
            <?php foreach ($posts as $p): ?>
      <tr>
      <td><?php echo nl2br(htmlspecialchars($p['id'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['nazwisko'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['email'])); ?></td>
      <td> <?php echo nl2br(htmlspecialchars($p['status'])); ?></td>
      <td> <?php  echo "<a href=".site_url('setup')."/del_user/".$p['id']."><i class=icon-trash></i></a>"; ?></td>
      
     
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
    



<div class="span5">

    <?php echo form_open("setup/add_user/"); ?>

    <label class="control-label" for="VALID">imię</label>
    <input type="text" class="span4" id="imie" name="imie" value="" >
    <label class="control-label" for="VALID">nazwisko</label>
    <input type="text" class="span4" id="nazwisko" name="nazwisko" value="" >
    <label class="control-label" for="VALID">nazwisko</label>
    <input type="text" class="span4" id="mail" name="mail" value="" >
    <label class="control-label" for="VALID">status:: /3 superadmin /2 admin /1 edytor  </label>
    <select name="status" class="span4">
        <option value="1"> edytor/ odpowiedzialny za szkolenie</option>
        <option value="2"> admin</option>
        <option value="2"> superadmin</option>
    </select>
    <br><br>


                                
                                
                                
                                
                                
                                
    <?php 
    echo form_submit('posts/add_os_odpowiezialna/', 'dodaj', 'class="btn"');
    echo form_close();
     ?>
	        	

</div>
            </div>
