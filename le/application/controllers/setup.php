<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    // W tej tablicy przechowujemy nazwy metod, do których ma dostęp jedynie zalogowany użytkownik
    public $restricted = array('add', 'edit');

    public function __construct() {
        parent::__construct();
        // Ładujemy bibilotekę sesji
        $this->load->library('session');

        // Sprawdzamy, czy obecnie wywoływana metoda znajduje się w tablicy $resricted
        if (in_array($this->uri->rsegment(2), $this->restricted)) {
            // Sprawdzamy, czy użytkownik jest zalogowany poprzez sprawdzenie istnienia zmiennej sesyjnej 'user_id'.
            // Ta zmienna jest ustawiana tylko w momencie poprawnego zalogowania.
            if (!$this->session->userdata('user_id')) {
                // Wyświetlamy stonę błędu, ale równie dobrze możemy zwrócic inny komunikat,
                // np. taki, który informuje o konieczności zalogowania do aplikacji lub 
                // przekierować użytkownika do strony logowania.
                //	show_404();

                $this->load->library('form_validation');
            }
        }
        // Ładujemy bibliotekę walidacji formularza
        $this->load->library('form_validation');
        // Określamy jakie tagi będą otaczać komunikat błędu walidacji. 
        // To kwestia stricte kosmetyczna - dostosowanie wyglądu do Twitter Bootstrap.
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');

        // Ładujemy model
        $this->load->model('setup_model');
    }

    public function index() {


        $data['posts'] = $this->setup_model->get_all(10, $this->uri->rsegment(3));

        $this->load->view('partials/header');
        $this->load->view('setup_index', $data);
        $this->load->view('partials/footer');
    }

    public function a_dmins() {

        $data['posts'] = $this->setup_model->get_all_admin();


        $this->load->view('partials/header');
        $this->load->view('setup_admins', $data);
        $this->load->view('partials/footer');
    }

    public function get_all_cours() {  //pobiera wszystkie kursy (Panel ADMINA)
        $data['posts'] = $this->setup_model->get_all_cours();


        $this->load->view('partials/header');
        $this->load->view('setup_admins_get_all_cours', $data);
        $this->load->view('partials/footer');
    }

    public function edit_cat() {  //pobiera wszystkie kursy (Panel ADMINA)
        $data['posts'] = $this->setup_model->edit_cat();


        $this->load->view('partials/header');
        $this->load->view('setup_edit_cat', $data);
        $this->load->view('partials/footer');
    }

    public function add_cat() {

        echo $this->input->post('jednostka_wojskowa');
        echo $this->input->post('kategoria');

        $data['nazwa'] = $this->input->post('jednostka_wojskowa');
        $data['Level'] = $this->input->post('kategoria');

        // Wysyłamy tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
        $this->setup_model->add_cat($data);
        redirect('/setup/edit_cat');
    }

    public function del_cat($id_) {

        $jednostka = $this->input->post('jednostka');
        $query = $this->db->query("DELETE FROM `e_learn`.`kategorie_nazwy_` WHERE `kategorie_nazwy_`.`id` = $id_");
        redirect('setup/edit_cat');
    }

    public function edit_jw() {  //pobiera wszystkie jednodtki wojskowe
        $data['posts'] = $this->setup_model->get_all_jw();


        $this->load->view('partials/header');
        $this->load->view('setup_jw', $data);
        $this->load->view('partials/footer');
    }

    public function add_jw() {  //dodaj jednostkę do bazy wszystkie jednostki
        $jednostka = $this->input->post('jednostka');
        if ($jednostka) {

            $query = $this->db->query("INSERT INTO `e_learn`.`jednostki_wo` (`id`, `tag`) VALUES (NULL, '$jednostka' )");
        };
        redirect('/setup/edit_jw');
    }

    public function del_jw($id_jw) {  //dodaj jednostkę do bazy wszystkie jednostki
        $query = $this->db->query("DELETE FROM `e_learn`.`jednostki_wo` WHERE `jednostki_wo`.`id` = $id_jw");

        redirect('/setup/edit_jw');
    }

    public function add_user() {

        echo $a1 = $this->input->post('imie');
        echo $a2 = $this->input->post('nazwisko');
        echo $a3 = $this->input->post('status');
        echo $a4 = $this->input->post('mail');

        $data['nazwa'] = $this->input->post('jednostka_wojskowa');
        $data['Level'] = $this->input->post('kategoria');

        $query = $this->db->query("INSERT INTO `e_learn`.`admins_` (`id`, `imie`, `nazwisko`, `email`, `status`) VALUES (NULL, '$a1', '$a2', '$a4', '$a3')");
        redirect('/setup/a_dmins');
    }

    public function del_user($id_) {

        $this->session->set_flashdata('error', 'Użytkownik został usunięty.');

        $jednostka = $this->input->post('jednostka');
        $query = $this->db->query("DELETE FROM `e_learn`.`admins_` WHERE `admins_`.`id` = $id_ ");


        redirect('setup/a_dmins');
    }

    public function edit_serv() {  //pobiera spis serwerów
        
        $data['posts'] = $this->setup_model->get_all_serv();
        $this->load->view('partials/header');
        $this->load->view('setup_serv', $data);
        $this->load->view('partials/footer');
        
    }
    
    
    

    public function add_serv() {  //pobiera spis serwerów

        $data['posts'] = $this->setup_model->get_all_serv();
        $this->form_validation->set_rules('server_', 'SERVER', 'required|trim');
        $this->form_validation->set_rules('server_opis', 'OPIS SERWERA', 'required|trim');
        $this->form_validation->set_rules('url', 'URL SERVERA', 'required|trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        
        
        
        
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('partials/header');
            $this->load->view('setup_serv', $data);
            $this->load->view('partials/footer');
        } else {

            $a1 = $this->input->post('server_');
            $a2 = $this->input->post('server_opis');
            $a3 = $this->input->post('url');
    
            
            if ($this->input->post('id')) {
            
            
            $query = $this->db->query("UPDATE `e_learn`.`servery_` "
                    . "SET `name` = '$a1', `tech_des` = '$a2', `url` = '$a3' "
                    . "WHERE `servery_`.`id` = ".$this->input->post('id')."; ");
            }
            else {
               $query = $this->db->query("INSERT INTO `e_learn`.`servery_` "
                       . "(`id`, `name`, `des`, `tech_des`, `url`, `reg`, `id_admin`) "
                       . "VALUES (NULL, '$a1', '', '$a2', '$a3', '', NULL);");
            };
            redirect('/setup/edit_serv');
        }
    }

    
    public function del_srv($id_) {

        $query = $this->db->query("DELETE FROM `e_learn`.`servery_` WHERE `servery_`.`id` = $id_");
        redirect('/setup/edit_serv');
    }

    
    
    
    
    
    
    public function  nowy_kurs($add){
        
        
        if (empty($add)) {
        $this->session->set_flashdata('error', 'Czy napewno chcesz dodać nowy wpis do bazy ? <a href="nowy_kurs/add">TAK >> </a>');
        redirect("setup/get_all_cours");
        };
        
        
        
        
        
        $sql = "INSERT INTO `e_learn`.`kursy_` (`ID`, `TEMAT`, `DES`, `OPIS`, `KFALIFIKACJE`, `LNG_TIME`, `ID_USER`, `VALID`, `ID_PLATFORM`, `DATA_BEGIN`, "
                . "`DATA_END`, `VISIBLE`, `ID_LEVEL3`, `ID_JW`, `TAG`, `ID_ADM`, `LINK`, `ID_KURSU`, `TECHNOLOGIE`, `COURSE_LEVEL`, `AV`) "
                . "VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '');";
        $this->db->query($sql);
        
        $sql = "SELECT `ID` FROM `kursy_` order by `ID` desc limit 1";
        $id  = $this->db->query($sql)       ;
        
        
        foreach ($id->result() as $row) {
            echo $row->ID ;        
        };
        
        
        $this->session->set_flashdata('success', 'Nowy kurs dodany !');
        
        
        
        redirect("/posts/edit/".$row->ID);
    }
    
    
    
    
    public function s_artykul() {

        $data['posts'] = $this->setup_model->get_all_art();


        $this->load->view('partials/header');
        $this->load->view('setup_artyk', $data);
        $this->load->view('partials/footer');
    }
    
    
    
    public function add_art() {

        echo $a1 = $this->input->post('temat');
        echo $a2 = $this->input->post('tresc');
        echo $a3 = $this->input->post('status');
        echo $a4 = $this->input->post('id_art');
        
        
        if ($a4 >0) {
                $query =  "UPDATE `e_learn`.`artykoly` SET `tresc` = '$a2', `temat` = '$a1', `aktywny`=$a3  WHERE `artykoly`.`id` = $a4";
        }
        else {
                $query = "INSERT INTO `e_learn`.`artykoly` (`id`, `temat`, `tresc`, `aktywny`) VALUES (NULL, '$a1', '$a2', '$a3');";
        }
 
        //echo $query;
       $this->db->query($query);
       redirect('/setup/s_artykul');
        
    }
    
    
    
        public function del_art($id_) {

        $query = $this->db->query("DELETE FROM `e_learn`.`artykoly` WHERE `artykoly`.`id` = $id_");
       redirect('/setup/s_artykul');
    }
    


/* End of file posts.php */
/* Location: ./application/controllers/posts.php */




public function edit($id)
	{
		// Ustalamy reguły walidacji
		$this->form_validation->set_rules('DES', 'DES', 'required|trim');
		$this->form_validation->set_rules('OPIS', 'OPIS', 'required|trim');
                $this->form_validation->set_rules('LNG_TIME', 'LNG_TIME', 'required|trim');


                
		// Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
		if ($this->form_validation->run() == FALSE)
		{
			// Pobieramy dane z modelu po zmiennej $id
			$data = $this->setup_model->get($id);
                         
			// Przypisujemy otrzymane dane do widoku
			// Ewentualne błędy walidacji zostaną przekazane automatycznie
			$this->load->view('partials/header');
                        $this->load->view('setup_edit', $data);
			$this->load->view('partials/footer');
                        
                        
		}
		else
		{
		        $data['TEMAT'] = $this->input->post('TEMAT');
                        $data['DES'] = $this->input->post('DES');
                        $data['OPIS'] = $this->input->post('OPIS');
                        $data['KFALIFIKACJE'] = $this->input->post('KFALIFIKACJE');
                        $data['LNG_TIME'] = $this->input->post('LNG_TIME');
                        $data['ID_USER'] = $this->input->post('ID_USER');
                        $data['DATA_BEGIN'] = $this->input->post('DATA_BEGIN');
                        $data['VALID'] = $this->input->post('VALID');
                        $data['ID_PLATFORM'] = $this->input->post('ID_PLATFORM');
                        $data['DATA_END'] = $this->input->post('DATA_END');
                        $data['VISIBLE'] = $this->input->post('VISIBLE');

			// Wysyłamyzmienną $id i tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
			if ($this->post_model->update($id, $data))
		                                        {
                            var_dump($data);
                            // Ustawiamy zmienną flashadata o nazwie success i przypisujemy do niej komunikat o powodzeniu dodania wpisu.
				$this->session->set_flashdata('success', 'Wpis został zaktualizowany.');
				// Przekierowujemy użytkownika pod adres http://localhost/blogtutorial/index.php/posts	
				redirect('posts');			
			}
			else
			{
				// Ustawiamy zmienną flashadata o nazwie error i przypisujemy do niej komunikat o błędzie.
				$this->session->set_flashdata('error', 'Wystąpił błąd i wpis nie mógł zostac zaktualizowany.');
				// Przekierowujemy użytkownika pod adres edycji wpisu http://localhost/blogtutorial/index.php/posts/edit/numer_id_wpisu	
				redirect('posts/edit/'. $id);
			}
		}
	}
        
        
        
        
        // USUWA TEMAT DO KATEGORI 1/2/3
        	public function delete_cat($id,$id_kursu)
                { 
                
                $query = $this->db->query("DELETE FROM `e_learn`.`kategorie_` WHERE `kategorie_`.`id` = $id ");           
                redirect('setup/edit/'.$id_kursu);                 
               
                }
        
        // DODAJE TEMAT DO KATEGORI 1/2/3
        	public function edit_catt($id)
                { 
                    echo $id." ----<br>";
                    echo $a1=$this->input->post('level1');
                    echo $a2=$this->input->post('level2');
                    echo $a3=$this->input->post('level3');
              
            
            
                $query = $this->db->query("INSERT INTO `e_learn`.`kategorie_` (`ID_KURSU`,`Level1`, `Level2`, `Level3`) VALUES ('$id', '$a1', '$a2', '$a3');");           
        echo $query;
                 redirect('setup/edit/'.$id);                 
                
                }
        
                
        // ** formularz /setup/edit                
        // ** formularz /setup/edit
    
                // USUWA osobe odpowiedzialna za kurs
                public function del_os_odpowiedzialna_form($id_tabeli_kurs_osoba,$ID_aktywnego_kursu)

                { 
                // $id_osoba= $this->input->post('os_odpowiedzialna');
                $query = $this->db->query("DELETE FROM `e_learn`.`osoba_dopow_corel_kurs` WHERE `osoba_dopow_corel_kurs`.`id` = $id_tabeli_kurs_osoba");           
                redirect('setup/edit/'.$ID_aktywnego_kursu);                 
                }
                // END usuwa osobe odpowiedzialna za kus


                public function  add_os_odpowiedzialna($id_){
        
                $user_id = $this->input->post('id_usera');
                $sql = "INSERT INTO `e_learn`.`osoba_dopow_corel_kurs` (`id`, `id_kursu`, `id_osoby`) VALUES (NULL, $id_, $user_id );";
                $this->db->query($sql);
        
                $this->session->set_flashdata('success', 'Wpis został dodany.');
                redirect("setup/edit/".$id_);
                }
    
        // ** formularz /setup/edit ->END
        // ** formularz /setup/edit ->END

  
        
        
        }