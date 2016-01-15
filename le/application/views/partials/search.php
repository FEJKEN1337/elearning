<?php
echo '<form action="'.base_url().'index.php/posts/search_" method="GET" accept-charset="utf-8">';
echo form_input('search', $this->input->post('search'));
echo form_submit('wyszukaj', 'szukaj', 'class="btn btn-inverse"');
echo form_close();

?>


