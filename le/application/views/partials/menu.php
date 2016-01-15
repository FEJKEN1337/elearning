<?php

//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA
$nazwy = $this->db->query("SELECT * FROM `kategorie_nazwy_` ");
foreach ($nazwy->result() as $row)
    {
     $nazwy_[$row->id] = $row->nazwa;;
    };
$nazwy_[0] = '';;
//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA



//pierwszy select
$data_init = $this->db->query("SELECT * FROM `kategorie_`GROUP BY `Level1`  ORDER BY `Level1`,`Level2`,`Level3` limit 1 ");
$row_init =  $data_init ->first_row();


if (!($this->input->get('l_1'))) 
    {$init_1 = $row_init->Level1;}
    else ($init_1 = ($this->input->get('l_1'))) ;


if (!($this->input->get('l_2'))) 
    {$init_2 = $row_init->Level2;}
    else ($init_2 = ($this->input->get('l_2'))) ;


if (!($this->input->get('l_3'))) 
    {$init_3 = $row_init->Level3;}
    else ($init_3 = ($this->input->get('l_3'))) ;

    
    

$data3 = $this->db->query("SELECT * FROM `kategorie_`GROUP BY `Level1`  ORDER BY `Level1`,`Level2`,`Level3` ");


//drugi select
$sql1 = "SELECT * FROM `kategorie_` WHERE `Level1` = ".$init_1 ." GROUP BY `Level2` ORDER BY `Level2` ";
$sql1_= $this->db->query($sql1);

//tzreci select
$sql3 = "SELECT * FROM `kategorie_` WHERE `Level1` = ".$init_1 ."  AND `Level2` = ".$init_2."  GROUP BY `Level3` ORDER BY `Level3` ";
$sql3_= $this->db->query($sql3);


?>


<script type="text/javascript">
function changed1()
{
document.getElementById("l_2").selectedIndex = -1;
document.getElementById("l_3").selectedIndex = -1;
document.formul1.submit();
}


function changed2()
{
document.getElementById("l_3").selectedIndex = -1;
document.formul1.submit();
}
</script>



<form name="formul1" id="formul1">
        <select name="l_1" id="l_1" onchange="changed1()" size="1">
        <option value=""> wybierz kategorię</option>
            <?php
            foreach ($data3->result() as $row) {
            
            echo "<option ";
            if (($row->Level1) == ($this->input->get('l_1'))) {echo " selected " ;};
            echo " value=".$row->Level1.">". $nazwy_[$row->Level1] ."</option>" ;        
        }
        
        ?>
        </select>

        <select name="l_2" id="l_2" onchange="changed2()"  size="1" <?php if (! $this->input->get('l_1')){ echo "style='visibility: hidden' ";}?>>
            <option value=""> wybierz kategorię</option>
            <?php
            foreach ($sql1_->result() as $row) {
            
            echo "<option ";
            if (($row->Level2) == ($this->input->get('l_2'))) {echo " selected " ;};
            echo " value=".$row->Level2.">". $nazwy_[$row->Level2]  ."</option>" ;        
            
            } ?>
    }
            
        </select>
  
    <select name="l_3" id="l_3" onchange="this.form.submit()" size="1" <?php if (! $this->input->get('l_2')){ echo "style='visibility: hidden' ";}?> >
            <option value=""> wybierz kategorię</option>
<?php


    foreach ($sql3_->result() as $row) {
            echo "<option ";
            if (($row->Level3) == ($this->input->get('l_3'))) {echo " selected " ;};
            echo " value=".$row->Level3.">". $nazwy_[$row->Level3]  ."</option>" ;        
    }
    ?>
        </select>

    
    
</form>


<?php
// echo $this->input->get('l_1')."<br>";
// echo $this->input->get('l_2')."<br>";
// echo $this->input->get('l_3')."<br>";
?>