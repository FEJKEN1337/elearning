<div class="page-header">
    <h1>Edytuj wpis: <?php echo $ID; ?></h1>
</div>


<b>kategorie kursu</b>


<?php
//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA
$nazwy = $this->db->query("SELECT * FROM `kategorie_nazwy_` ");
foreach ($nazwy->result() as $row) {
    $nazwy_[$row->id] = $row->nazwa;
    ;
};
$nazwy_[0] = '';
;
//zmienia ID na nazwe !!!! WYRZUĆĆ Z TEGO MIEJSCA

$data2 = $this->db->query("SELECT * FROM `kategorie_` WHERE `ID_KURSU` = $ID ");
?>

<table class="table table-condensed">
    <?php
    if ($data2->num_rows() > 0) {

        foreach ($data2->result() as $row) {
            //echo "<tr><td>".$row->nazwisko."</td><td>".$row->body."</td><td>".$row->data_kursu."</td>></tr>" ;
            echo "<tr><td><small>" . $nazwy_[$row->Level1] . "</small></td>"
            . "<td><small>" . $nazwy_[$row->Level2] . "</small></td>"
            . "<td><small>" . $nazwy_[$row->Level3] . "</small></td>"
            . "<td><small><a href='/le/index.php/setup/delete_cat/$row->id/$ID'>usuń z kategorii " . $row->id . "</a></small></td>"
            . "</tr>";
        }
    }
    ?>
</table>
<br>

<?php
$data_form = $this->db->query("SELECT * FROM `kategorie_nazwy_`");
echo form_open("setup/edit_catt/" . $ID);
echo "<div class=\"row\">";


echo "<div class='span3'>"
 . "<select name='level1' size='5'>";
foreach ($data_form->result() as $row) {
    if ($row->Level == 1) {
        echo "<option value=" . $row->id . ">" . $row->nazwa . "</option>";
    }
}

echo "</select></div>"
 . "<div class='span3'>"
 . "<select name='level2' size='5'>";
foreach ($data_form->result() as $row) {
    if ($row->Level == 2) {
        echo "<option  value=" . $row->id . "> " . $row->nazwa . "</option>";
    }
}

echo "</select></div>"
 . "<div class='span3'>"
 . "<select name='level3' size='5'>";
foreach ($data_form->result() as $row) {
    if ($row->Level == 3) {
        echo "<option  value=" . $row->id . ">" . $row->nazwa . "</option>";
    }
}

echo "</select></div>"
 . "<div class='span3'>";

echo form_submit('post/edit_catt', 'dodaj', 'class="btn"');
echo form_close();


echo "</div></div>";
?>    



<?php
//osoby odpowiedzialne
include_once '/partials/edit/osoby_odpowiedzialne.php';
//END osoby odpowiedzialne 



// JEDNOSTKA WOSJKOWA  
include_once '/partials/edit/identyfikator_jednostki.php';
// END  JEDNOSTKA WOSJKOWA  
?>




<br>


<div class="row">
    <div class="span12">
        <!-- Otwieramy formularz -->
<?php echo form_open('posts/edit/' . $ID, array('class' => 'form-horizontal')); ?>
        <fieldset>
            <div class="control-group <?php echo form_error('TEMAT') ? 'error' : ''; ?>">
                <label class="control-label" for="TEMAT">temat kursu</label>
                <div class="controls">
                    <input type="text" class="span10" id="title" name="TEMAT" value="<?php echo set_value('TEMAT', $TEMAT); ?>">
                </div>
            </div>



            <div class="control-group <?php echo form_error('DES') ? 'error' : ''; ?>">
                <label class="control-label" for="DES">opis kursu</label>
                <div class="controls">
                    <input type="text" class="span10" id="title" name="DES" value="<?php echo set_value('DES', $DES); ?>">
                </div>
            </div>



            <div class="control-group <?php echo form_error('OPIS') ? 'error' : ''; ?>">
                <label class="control-label" for="OPIS">wiedza i umiejetności wymagane od uczestnika kursu </label>
                <div class="controls">
                    <input type="text" class="span10" id="OPIS" name="OPIS" value="<?php echo set_value('OPIS', $OPIS); ?>">
                </div>
            </div>



            <div class="row">
                
               
                <div class="span6">
                    <!-- czas rozpoczęcia funkcjonowania szkolenia ----------------------------->            

                    <div id="datetimepicker3" class="control-group">
                        <label class="control-label" for="DATA_BEGIN"> czas rozpoczęcia funkcjonowania szkolenia</label> 
                        
                            <input data-format="dd-MM-yyyy" type="text" id="DATA_BEGIN" name="DATA_BEGIN" value="<?php echo set_value('DATA_BEGIN', $DATA_BEGIN); ?>"></input>
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                            </span>
                        </div>
                    </div>
                
                
                
      
                    
                    <script type="text/javascript">
                        $(function() {
                            $('#datetimepicker3').datetimepicker({
                                pickTime: false
                            });
                        });
                    </script> 

                </div>
               
                
                    
                    
                    <!--END czas rozpoczęcia funkcjonowania szkolenia --------------------------->            
                <div class="span6">
                    <!-- START czas trwania szkolenia (godz) ----------------------------->            

                    <div class="control-group <?php echo form_error('LNG_TIME') ? 'error' : ''; ?>">
                        <label class="control-label" for="LNG_TIME">czas trwania szkolenia (godz) </label>
                        <div class="controls">
                            <input type="text" class="span2" id="LNG_TIME" name="LNG_TIME" value="<?php echo set_value('LNG_TIME', $LNG_TIME); ?>">
                        </div>
                    </div>

                    <!-- END czas trwania szkolenia (godz) ----------------------------->            
                </div>    </div>    







            <div class="control-group <?php echo form_error('VALID') ? 'error' : ''; ?>">
                <label class="control-label" for="VALID">sposób zakwalifikowania się na szkolenia</label>
                <div class="controls">
                    <input type="text" class="span10" id="VALID" name="VALID" value="<?php echo set_value('VALID', $VALID); ?>">
                </div>

            </div>





            <div class="control-group <?php echo form_error('ID_PLATFORM') ? 'error' : ''; ?>">
                <label class="control-label" for="ID_PLATFORM">identyfikator platformy</label>
                <div class="controls">
                    <input type="radio"  value="1" name="ID_PLATFORM" <?php if ((set_value('ID_PLATFORM', $ID_PLATFORM)) == 1) {
            echo "checked";
        }; ?>>MIL-WAN 
                    <input type="radio"  value="2" name="ID_PLATFORM" <?php if ((set_value('ID_PLATFORM', $ID_PLATFORM)) == 2) {
            echo "checked";
        }; ?>>INTER -MON 
                    <input type="radio"  value="3" name="ID_PLATFORM" <?php if ((set_value('ID_PLATFORM', $ID_PLATFORM)) == 3) {
            echo "checked";
        }; ?>> SJO LODZ 
                </div>


            </div>





            <!--start czas zakończenia/altualizacji funkcjonowania szkolenia-->

            <div class="row">
                <div class="span6">
                    <div id="datetimepicker5" class="control-group">
                        <label class="control-label" for="DATA_END"> czas zakończenia/altualizacji funkcjonowania szkolenia</label> 
                        <div class="controls">
                            <input data-format="dd-MM-yyyy" type="text" id="DATA_END" name="DATA_END" value="<?php echo set_value('DATA_END', $DATA_END); ?>"></input>
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                            </span>
                        </div></div>
                    <script type="text/javascript">
                        $(function() {
                            $('#datetimepicker5').datetimepicker({
                                pickTime: false
                            });
                        });
                    </script> 

                    <!--END czas zakończenia/altualizacji funkcjonowania szkolenia-->      

                </div><div class="span6">


                    <div id="datetimepicker4" class="control-group">
                        <label class="control-label" for="DATA_BEGIN"> czas rozpoczęcia funkcjonowania szkolenia</label> 
                        <div class="controls">
                            <input data-format="dd-MM-yyyy" type="text" id="DATA_BEGIN" name="DATA_BEGIN" value="<?php echo set_value('DATA_BEGIN', $DATA_BEGIN); ?>"></input>
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                            </span>
                        </div></div>
                    <script type="text/javascript">
                        $(function() {
                            $('#datetimepicker4').datetimepicker({
                                pickTime: false
                            });
                        });
                    </script> 
                </div>
            </div>




            <!--czy szkolenie jest aktywne-->

            <div class="control-group <?php echo form_error('VISIBLE') ? 'error' : ''; ?>">
                <label class="control-label" for="VISIBLE">czy szkolenie jest aktywne</label>
                <div class="controls">
                    <input type="radio"  value="0" name="VISIBLE" <?php if ((set_value('VISIBLE', $VISIBLE)) == 0) {
            echo "checked";
        }; ?>>AKTYWNE
                    <input type="radio"  value="1" name="VISIBLE" <?php if ((set_value('VISIBLE', $VISIBLE)) == 1) {
            echo "checked";
        }; ?>>NIE AKTYWNE
                </div>
            </div>
            <!--END czy szkolenie jest aktywne-->                            



            <div class="control-group <?php echo form_error('ID_LEVEL3') ? 'error' : ''; ?>">
                <label class="control-label" for="ID_LEVEL3">identyfikator grupy</label>
                <div class="controls">
                    <input type="text" class="span10" id="ID_LEVEL3" name="ID_LEVEL3" value="<?php echo set_value('ID_LEVEL3', $ID_LEVEL3); ?>">
                </div>
            </div>









            <div class="control-group <?php echo form_error('TAG') ? 'error' : ''; ?>">
                <label class="control-label" for="TAG">Tagi dla wyszukiwarki szkolenia</label>
                <div class="controls">
                    <input type="text" class="span10" id="TAG" name="TAG" value="<?php echo set_value('TAG', $TAG); ?>">
                </div>
            </div>





            <div class="control-group <?php echo form_error('LINK') ? 'error' : ''; ?>">
                <label class="control-label" for="LINK">Link do Kursu na platformie</label>
                <div class="controls">
                    <input type="text" class="span10" id="LINK" name="LINK" value="<?php echo set_value('LINK', $LINK); ?>">
                </div>
            </div>

            <div class="control-group <?php echo form_error('ID_KURSU') ? 'error' : ''; ?>">
                <label class="control-label" for="ID_KURSU">Identyfikator kursu na platformie</label>
                <div class="controls">
                    <input type="text" class="span10" id="ID_KURSU" name="ID_KURSU" value="<?php echo set_value('ID_KURSU', $ID_KURSU); ?>">
                </div>
            </div>




            <div class="control-group <?php echo form_error('TECHNOLOGIE') ? 'error' : ''; ?>">
                <label class="control-label" for="TECHNOLOGIE">Jakie technologie są uzyte w kursie</label>
                <div class="controls">
                    <input type="text" class="span10" id="Technologie" name="TECHNOLOGIE" value="<?php echo set_value('TECHNOLOGIE', $TECHNOLOGIE); ?>">
                </div>
            </div>



            <div class="control-group <?php echo form_error('COURSE_LEVEL') ? 'error' : ''; ?>">
                <label class="control-label" for="COURSE_LEVEL">Poziom Kursu {Level0, Level1, Level1+,Level2,Level3</label>
                <div class="controls">
                    <input type="text" class="span10" id="COURSE_LEVEL" name="COURSE_LEVEL" value="<?php echo set_value('COURSE_LEVEL', $COURSE_LEVEL); ?>">
                </div>
            </div>


            <div class="control-group <?php echo form_error('AV') ? 'error' : ''; ?>">
                <label class="control-label" for="AV">Dostępność (czy dostępny dla wszystkich)</label>
                <div class="controls">
                    <input type="text" class="span10" id="AV" name="AV" value="<?php echo set_value('AV', $AV); ?>">
                </div>
            </div>






            <div class="form-actions">
                <a class="btn" href="<?php echo site_url('posts'); ?>">Anuluj</a>
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>




            </div>
        </fieldset>
        <!-- Zamykamy formularz -->
<?php echo form_close(); ?>
    </div>
</div>






