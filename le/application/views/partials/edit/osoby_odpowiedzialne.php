<?php
$data3 = $this->db->query("SELECT * FROM `osoba_dopow_corel_kurs` "
        . "WHERE `id_kursu` = $ID ");

$user_nazwisko = $this->db->query("SELECT *, `osoba_dopow_corel_kurs`.id as `id_wpisu` "
        . "FROM `osoba_dopow_corel_kurs` left join `admins_` ON `osoba_dopow_corel_kurs`.id_osoby=`admins_`.id ");



//<!--      <b>odoba odpowiedzialna za szkolenie</b>  <b>odoba odpowiedzialna za szkolenie</b>  -->
?>

<b>osoba odpowiedzialna za szkolenie (status 1)</b>

<div class="row">
    <div class="span7">




        <table class="table table-condensed" border="0">
        <?php
        if ($user_nazwisko->num_rows() > 0) {

            foreach ($user_nazwisko->result() as $row) {
                //echo "<tr><td>".$row->nazwisko."</td><td>".$row->body."</td><td>".$row->data_kursu."</td>></tr>" ;
           
                
                if ((($row->status)==1) && ($row->id_kursu==$ID)){
                
                echo "<tr><td><small>" . $row->imie . " ". $row->nazwisko ." </small></td>"
                . "<td><small><a href='/le/index.php/setup/del_os_odpowiedzialna_form/$row->id_wpisu/$ID'>usuń z kategorii </a></small></td>"
                . "</tr>";
                }
                
            }
        }
        ?>
        </table>
    </div>
    
    <div class="span5">
        
        <?php
            echo form_open("setup/add_os_odpowiedzialna/" . $ID);
                    $lista_adminow = $this->db->query("SELECT * FROM `admins_` ");
            echo "<select name=\"id_usera\" id=\"id_usera\" size=\"3\">";

        if ($lista_adminow->num_rows() > 0) {
            foreach ($lista_adminow->result() as $row) {


                if (($row->status) == 1) {
                   echo "<option  value=$row->id >" . $row->imie ." ". $row->nazwisko." ". $row->email  . "</option>";

                    
                };
            }

            echo '</select>';
        }
     //   echo form_submit("setup/add_os_odpowiedzialna/". $ID . "dodaj, class=btn");
        echo form_submit('setup/add_os_odpowiedzialna/'.$ID , 'dodaj', 'class="btn"');
        echo form_close();
        ?>

        

    </div>

</div>
<!--END   odoba odpowiedzialna za szkolenie -->











<!--START      administrator kursu</b> -->
<b>administrator kursu (status 2)</b>

<div class="row">
    <div class="span7">


                <table class="table table-condensed" border="0">
        <?php
        if ($user_nazwisko->num_rows() > 0) {

            foreach ($user_nazwisko->result() as $row) {
                //echo "<tr><td>".$row->nazwisko."</td><td>".$row->body."</td><td>".$row->data_kursu."</td>></tr>" ;
           
                
                if ((($row->status)==2) && ($row->id_kursu==$ID)){
                
                echo "<tr><td><small>" . $row->imie . " ". $row->nazwisko ." </small></td>"
                . "<td><small><a href='/le/index.php/setup/del_os_odpowiedzialna_form/$row->id_wpisu/$ID'>usuń z kategorii </a></small></td>"
                . "</tr>";
                }
                
            }
        }
        ?>
        </table>
    </div>
    
    <div class="span5">
    
        
        
         <?php
            echo form_open("setup/add_os_odpowiedzialna/" . $ID);
                    $lista_adminow = $this->db->query("SELECT * FROM `admins_` ");
            echo "<select name=\"id_usera\" id=\"id_usera\" size=\"3\">";

        if ($lista_adminow->num_rows() > 0) {
            foreach ($lista_adminow->result() as $row) {


                if (($row->status) == 2) {
                   echo "<option  value=$row->id >" . $row->imie ." ". $row->nazwisko." ". $row->email  . "</option>";

                    
                };
            }

            echo '</select>';
        }
     //   echo form_submit("setup/add_os_odpowiedzialna/". $ID . "dodaj, class=btn");
        echo form_submit('setup/add_os_odpowiedzialna/'.$ID , 'dodaj', 'class="btn"');
        echo form_close();
        ?>


    </div>

</div>
<!--END  administartor kursu> -->




    