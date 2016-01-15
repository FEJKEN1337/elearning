fffffffffffffffffffffffffffffffffffffffffffffffffffff
<?php
            //pobiera dane z LDAP i ładuje do ccokie
            $loginIIS =   explode("\\", $_SERVER['LOGON_USER'],2 );
                $LDP = new myLDAP('r.smoter@krakow.ron.int', 'smocuR_') ;
                $LDP1 = $LDP->search("userPrincipalName=$loginIIS[1]@$loginIIS[0]*" ) ;
                $cook = array(
                    'ipphone'       =>  $LDP1[0]["ipphone"],
                    'mail'          =>  $LDP1[0]["mail"],
                    'imie_nazwisko' =>  $LDP1[0]["cn"],
                    'jednostka'     =>  $LDP1[0]["company"]
                    );

            $this->session->set_userdata($cook);
           //pobiera dane z LDAP i ładuje do ccokie

//kasuje cookie
$this->session->set_userdata('frazacoo','');




//formularz search

                
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
        }
      
      else {
          
          for ($x=1; $x<=4; $x++) {

          echo "<h4>"
                  . "Aktualizacja zasad "
                  . "</h4>"
                  . "<b><em>23 wrzesień 2014</em></b><br>"
                  . "W najbliższych dniach nastąpi aktualizacja zasad korzystania z platformy, przez co wszyscy użytkownicy będą musieli je na nowo zaakceptować.
                     Korzystając z portalu zdobędziesz nowe umiejętności, podniesiesz swoje kwalifikacje, poznasz nowe sposoby nauczania. Dzięki platformie będziesz miał stały dostęp do pełnej bazy kursów o każdej porze, a swoją wiedzę zweryfikujesz w testach na koniec szkolenia.
                     <br><br>";
          };
      }          
                
     ?>         

