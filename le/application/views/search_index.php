    <?php
//formularz search
//    $this->load->view('partials/search');
    ?>

    <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
    <?php 
    
    
    
    echo "najczęściej szukane -> ";
    foreach ($tag_top->result() as $data): 
    echo "<a href='/le/index.php/posts/search_?search=".$data->tag."&wyszukaj=szukaj'>".$data->tag."</a> ::  ";
    endforeach; 
    echo "<br><br>";
    
    
    
    
    if ($results): ?>

        <?php foreach ($results as $data): ?>
            <div class="row">
                <div class="span12">
                    <td><h4><?php echo nl2br(htmlspecialchars($data->TEMAT)); ?></h4></td>
                </div>    
            </div>    

            <div class="row">
                <div class="span12">
                    <td><i><?php echo nl2br(htmlspecialchars($data->DES)); ?></i></td>
                </div>    
            </div>    

            <div class="row">
                <div class="span6">
                    <td><?php echo nl2br(htmlspecialchars($data->OPIS)); ?></td>
                </div>    
            </div>    

            <div class="row">
                <div class="span10">
                    <a href=<?php echo site_url('posts/show_a/' . $data->ID); ?>>wiecej</a>
                    <i class="icon-time"></i> 5h
                    <i class="icon-info-sign"></i><?php echo nl2br(htmlspecialchars($data->ID)); ?>
                    <i class="icon-lock"></i>
                </div>
                <div class="span2">
                    <?php echo "<a href=" .site_url('posts/edit/' . $data->ID) . "><i class=icon-edit></i></a>  "; ?>
                </div>    
            </div>    


            
            
        <?php endforeach; ?>

        <p>
<?php echo $links; ?>
</p>
      
    <?php endif; 


 if (!($results)):
     
     echo "brak kursu w wskazanych parametrach";
     endif; 

     ?>








    
