<!DOCTYPE html>
<html lang="pl">
    <head>
    <meta charset="utf-8">
    <!--<base href="<?php echo base_url(); ?>"> -->
    <title>ZZWT E-learn</title>
    <meta name="author" content="CodeIgniter.org.pl">
    <link rel="stylesheet" href="/le/assets/css/bootstrap.css" >
    <link rel="stylesheet" href="/le/assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/le/assets/css/bootstrap-datetimepicker.min.css" >
    </head>
    <body>    
    <script type="text/javascript" src="/le/assets/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/le/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/le/assets/js/bootstrap-datetimepicker.min.js"></script> 
<?php 
    
   

?><style>
            body {
                background-image: url(/le/assets/img/03.jpg);
                background-repeat: no-repeat;
                background-position: top;
                width: 1200px;
                margin-left: auto;
                margin-right: auto;
                background-color: #3B3B3B;
                
            }
            .container
            {
                 position: relative;
                 left: 75px;
                 top: 100px;
                 width: 940px;
                 min-height: 800px;
                 border: 0px solid red;
                background-color: WHITE; 
            }
                .menu
            {
                position: relative;
                top: 51px;
                width: 500px;
                left: 300px;
                font-size: 15px;
            }
            .form
            {
                top: 10px;
                width: 1199px;
                height: 80px;
                text-align: right;
                font-size: 15px;
            }
            .form1{
                position: relative;
                float: left;
                top: 30px;
                left: 910px;
            }
               .mini1
            {
                position: relative;
                top: 85px;
                width: 1170px;
                text-align: right; 
                font-size: 10px;
            }
		#box-link { 
		position: absolute; 
		width: 400px; 
		height: 110px; 
		}	
                #fott {
                position: relative;    
                    top: 90px;
                    text-align: right;
                    width: 750px;
                }
                .menu_
            {
                position: relative;
               height: 80px;
            }
     </style>

     
     
     
<a id="box-link" href="/le/index.php/posts/index/";></a>
<div class="form" >          

<div class="form1">
    <?php $this->load->view('partials/search'); ?>
    </div>

</div>
     
     
<div class="menu" >   
    
    <a href='/le/index.php/posts/index/'><img src="/le/assets/img/domek.png"></a>
    
    
    
     <!--   <a href="<?php echo site_url('posts/index'); ?>" class="btn btn-inverse">Lista </a> -->
            
            <a href="<?php echo site_url('setup/a_dmins'); ?>" class="btn btn-inverse">Admin setup </a>
              <?php if ($this->session->userdata('user_id')): ?>
            <a href="<?php echo site_url('users/logout'); ?>" class="btn btn-inverse">Wyloguj </a>
              <?php else: ?>
           <a href="<?php echo site_url('posts/search_index/'); ?>" class="btn btn-inverse">Szukaj </a>
              <?php endif; ?>
        
</div>

     
                 <div class="mini1">
            Witaj <b><?php echo $this->session->userdata('imie_nazwisko'); ?></b> znalazłeś się na stronie...
            </div>

     
    <div class="container">
      <!-- Jeśli istnieją komunikaty o blędach walidacji, wyświetl je. -->
      <?php if (validation_errors()): ?>      
          <?php echo validation_errors(); ?>
      <?php endif; ?>
      
      <!-- Jeśli istnieje zmienna flashdata o nazwie 'error' wyświetl ją. -->
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-error">
          <a class="close" data-dismiss="alert" href="#">×</a>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>

      <!-- Jeśli istnieje zmienna flashdata o nazwie 'success' wyświetl ją. -->
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
          <a class="close" data-dismiss="alert" href="#">×</a>
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; 
      
      
    //------------LOGOWANIE
    //------------LOGOWANIE
    //------------LOGOWANIE
    //pobiera dane z LDAP i ładuje do ccokie

           //pobiera dane z LDAP i ładuje do ccokie

//kasuje cookie
$this->session->set_userdata('frazacoo','');

      
      $uzytkownik = array( 
        'username'  =>   'robert',
        'email'     =>   'bsd@interia.pl',
        'logowaie'  =>   TRUE
     );
      //$this->session->set_userdata($uzytkownik);
      $this->session->set_userdata();
      
      //var_dump($this->session->all_userdata('item'));        
      //echo $this->session->userdata('imie_nazwisko') ."<br>";
      //echo $this->session->userdata('mail') ."<br>";
      
              
      //$this->session->sess_destroy();
      
      $nazwy = $this->db->query("SELECT * FROM `kategorie_nazwy_` ");
        foreach ($nazwy->result() as $row)
        {
        $nazwy_[$row->id] = $row->nazwa;;
        };
    //------------LOGOWANIE
    //------------LOGOWANIE
    //------------LOGOWANIE
        ?>
