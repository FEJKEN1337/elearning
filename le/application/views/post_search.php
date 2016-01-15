<?php
                
 if ($posts->num_rows() > 0)
{
    foreach ($posts->result() as $row)
   {
        ?>
     
              <div class="row">
                <div class="span12">
                    <td><h4><?php echo nl2br(htmlspecialchars($row->TEMAT)); ?></h4></td>
                </div>    
            </div>   
       
       <?php
       //echo "<a href=\"/le/index.php/posts/index/.$row->TEMAT.\">".$row->TEMAT." </a><br>";
       echo $row->DES." <br>";
       echo $row->OPIS."<br>";
       
       ?>
           <div class="row">
                <div class="span10">
                    <a href=<?php echo   site_url('posts/show_a/' . $row->ID) ?>>wiecej</a>
                    <i class="icon-time"></i> 5h
                    <i class="icon-info-sign"></i><?php //echo nl2br(htmlspecialchars($data->ID)); ?>
                    <i class="icon-lock"></i>
                    
                </div>
                <div class="span2">
                    <?php echo "<a href=" . site_url('posts/edit/' . $row->ID) . "><i class=icon-edit></i></a>  "; ?>
                    
                </div>    
            </div>  
   
           <?php
       
              echo "<br>";   
       
       
        }
echo $links;
        }
        
                
     ?>  
