<div class="menu_">
<?php

//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA
$nazwy = $this->db->query("SELECT * FROM `kategorie_nazwy_` ");
foreach ($nazwy->result() as $row)
    {
     $nazwy_[$row->id] = $row->nazwa;;
    };
$nazwy_[0] = '';;
//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA


$level1= $this->uri->segment(3);
$level2= $this->uri->segment(4);



echo    "<h4> <a href='/le/index.php/posts/index/'> Home </a> > 
         <a href='/le/index.php/posts/index/$level1'>". $nazwy_[$level1] ."</a> > 
         <a href='/le/index.php/posts/search_index/$level1/$level2'>".$nazwy_[$level2]."</a> > "
        .$nazwy_[$this->uri->segment(5)] ;




echo "<br>";
if (!($this->uri->segment(5))){
    echo "podkategorie  ::";;
    
    
}


$data3 = $this->db->query("SELECT * FROM `kategorie_`GROUP BY `Level1`  ORDER BY `Level1` ");
if ($data3->num_rows() > 0) {
    foreach ($data3->result() as $row) {

        if (!($level1)){
        
            echo " <i class =icon-ok></i> <a href=\"/le/index.php/posts/search_index/$row->Level1\">" . $nazwy_[$row->Level1] . " </a>";
        };
        
    }
}

// sub kategoria LEVEL2
// START jeśli została wybrana kategoria głowna


if ($level1) {
    $sql1 = "SELECT * FROM `kategorie_` WHERE `Level1` = \"$level1\" GROUP BY `Level2` ORDER BY `Level2` ";
    $sql1_= $this->db->query($sql1);
    
    foreach ($sql1_->result() as $row) {

        if (!($level2)){
        echo " <i class =icon-ok></i> <a href=\"/le/index.php/posts/search_index/$level1/$row->Level2\">".$nazwy_[$row->Level2]." </a>";
        }
    }
}
// END  LEVEL 2 jeśli została wybrana kategoria głowna





// sub kategoria LEVEL3
// START jeśli została wybrana kategoria głowna

if ($level2) {
    $sql3 = "SELECT * FROM `kategorie_` WHERE `Level1` = \"$level1\"  AND `Level2` = \"$level2\"  GROUP BY `Level3` ORDER BY `Level3` ";
    $sql3_= $this->db->query($sql3);
    
    foreach ($sql3_->result() as $row) {
        
        if (!($this->uri->segment(5))){
        echo " <i class =icon-ok></i> <a href=\"/le/index.php/posts/search_index/$level1/$row->Level2/$row->Level3\">".$nazwy_[$row->Level3]." </a>";
        }
    }
}
// END jeśli została wybrana kategoria głowna



echo    "</h4>"
        . "</div>";

?>

<!--

