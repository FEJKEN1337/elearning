<?php 

//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA
$nazwy = $this->db->query("SELECT * FROM `kategorie_nazwy_` ");
foreach ($nazwy->result() as $row)
    {
     $nazwy_[$row->id] = $row->nazwa;;
    };
$nazwy_[0] = '';;
//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA

if ($kategorie->num_rows() > 0)
{
       echo "<div class='row'>"
            . "<div class='span2'><b>kategoria;  </b></div>"
            . "<div class='span7'>";
    
       foreach ($kategorie->result() as $row)
       {
       echo "<a href=" .  site_url('posts/search_index?l_1=' . $row->Level1)."> " . $nazwy_[$row->Level1] . " </a>";
       echo "<a href=" .  site_url('posts/search_index?l_1=' . $row->Level1. '&l_2='. $row->Level2)."> :: " . $nazwy_[$row->Level2] . " </a>";
       echo "<a href=" .  site_url('posts/search_index?l_1=' . $row->Level1. '&l_2='. $row->Level2. '&l_3='. $row->Level3)."> :: " . $nazwy_[$row->Level3] . " </a>";
       
     
       
       echo "<br>";    
       }
       
       echo "<br><br></div></div>";
}


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
<table border="0"  cellspacing="3" cellpadding="5" >
       <?php
       
       echo "<tr><td> <b>ID; </b> </td><td>" .      $row->ID        ." </td></tr>";
       echo "<tr><td> <b>TEMAT; </b></td><td>" .    $row->TEMAT     ."</td></tr>";
       echo "<tr><td> <b>DES; </b></td><td>" .      $row->DES       ."</td></tr>";
       echo "<tr><td> <b>OPIS; </b></td><td>" .     $row->OPIS      ."</td></tr>";
       echo "<tr><td> <b>KFALIFIKACJE; </b></td><td>" .     $row->KFALIFIKACJE."</td></tr>";
       echo "<tr><td></td><td> i co tam jeszce potrzeba :) !!</td></tr>" ;
       
       
       

// ID 	TEMAT 	DES 	OPIS 	KFALIFIKACJE 	LNG_TIME 	ID_USER 	VALID 	ID_PLATFORM 	DATA_BEGIN 	
// DATA_END 	VISIBLE 	ID_LEVEL3 	ID_JW 	TAG 	ID_ADM 	LINK 	ID_KURSU 	TECHNOLOGIE 	COURSE_LEVEL 	AV 

//Level1 Level2 	Level3 
         
       
           
           
           
       
       
              echo "</table><br>";   
       
       
        }
        }

        echo "<a href=".$_SERVER["HTTP_REFERER"].">back</a>"
      
                
     ?>         