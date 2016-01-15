<?php
//pobiera jednostki 
$jednostki_wo = $this->db->query("SELECT * FROM `jednostki_wo` ORDER BY `id` DESC ");
//end pobiera jednostki 
?>

<b>identyfikator jednostki wojskowej</b>
<div class="row">

    <div class="span7">

    <?php 
        foreach ($jednostki_wo->result() as $row) {
            if ($row->id == $ID_PLATFORM){
            echo $row->nazwa ;
            break;
            }
            
                }
                
                ?>
        
        
        </table>
    </div>


    

        
<div class="span5"> 
        <?php echo form_open("posts/add_id_jw/" . $ID); ?>
        <select name="jednostka_wojskowa" >
    
<?php
foreach ($jednostki_wo->result() as $row) {
                    echo "<option value=$row->id > ".$row->nazwa . $row->id ."</option>";
                    
                }

?>
</select>
<?php
        echo form_submit("posts/add_id_jw/" . $ID, 'dodaj', 'class="btn"');
        echo form_close();
        ?>
    </div>
    
</div>