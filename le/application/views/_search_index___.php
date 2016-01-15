
    <h2>ZZWT w Krakowie E-LERNING Wyszukiwarka</h2>
    <p>Witaj <b><?php echo $this->session->userdata('imie_nazwisko');  ?>
        </b> znalazłeś się na stronir trata tata trata tata itd...</p>
    <?php
//formularz search
    $this->load->view('partials/search');
    ?>

    <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
    <?php 
    
    
    if ($results): ?>

    
    
    <style>
            .tab-pane { 
                margin-top: 0px;
                margin-left: 14px};

            .nav-tabs {
                margin-top: 0px;
                margin-left: 0px;
                border-radius:0px 1px 0 0;
                
            }
                    .nav {
                        margin-bottom: 5px;
           
            
                    }    
                   
            
            
            
            
            
        </style>
    
    

        <?php foreach ($results as $data): ?>

            

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><B><?php echo nl2br(htmlspecialchars($data->TEMAT)); ?></B></a></li>
        <li><a href="#tab2" data-toggle="tab""><i class="icon-font"></i></a> </li>
    </ul>
    <div class="tab-content">
        
        
        
        <div class="tab-pane active" id="tab1">
            
            <?php echo nl2br(htmlspecialchars($data->DES))."<br>"; ?>
            <?php echo nl2br(htmlspecialchars($data->TEMAT)); ?>
        </div>
        
        <div class="tab-pane" id="tab2">
            
            <?php echo nl2br(htmlspecialchars($data->DES))." "; ?>
            <?php echo nl2br(htmlspecialchars($data->TEMAT))." "; ?>
            <?php echo nl2br(htmlspecialchars($data->DES))." "; ?>
            <?php echo nl2br(htmlspecialchars($data->TEMAT)); ?>
            
        </div>
</div>
        

    
    <br>
            
                <div class="tab-pane">

                    <i class="icon-time"></i> 5h
                    <i class="icon-info-sign"></i><?php echo nl2br(htmlspecialchars($data->ID)); ?>
                    <i class="icon-lock"></i>
                    <?php echo "<a href=" . site_url('posts/edit/' . $data->ID) . "><i class=icon-edit></i></a>  "; ?>
                </div>
                
            
    <br><br><br>
            
            
        <?php endforeach; ?>

        <p>
<?php echo $links; ?>
</p>
      
    <?php endif; ?>


