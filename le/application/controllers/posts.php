<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller
{
	// W tej tablicy przechowujemy nazwy metod, do których ma dostęp jedynie zalogowany użytkownik
	public $restricted = array('add', 'edit');

	public function __construct()
	{
		parent::__construct();
		// Ładujemy bibilotekę sesji
		$this->load->library('session');

		// Sprawdzamy, czy obecnie wywoływana metoda znajduje się w tablicy $resricted
		if (in_array($this->uri->rsegment(2), $this->restricted))
		{
			// Sprawdzamy, czy użytkownik jest zalogowany poprzez sprawdzenie istnienia zmiennej sesyjnej 'user_id'.
			// Ta zmienna jest ustawiana tylko w momencie poprawnego zalogowania.
			if ( ! $this->session->userdata('user_id'))
			{
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
		$this->load->model('post_model');
                
                //wyszukiwarka wyszukiwarka wyszukiwarka 
                $this->load->helper("url");
               // $this->load->model("Countries");
                $this->load->library("pagination");
                
	}

        
        public function record_count($search) {


        $this->db->where("DES LIKE \"%$search%\" ");
        return $this->db->count_all_results('kursy_');
        
        
    }

    public function fetch_countries($limit, $start,$search) {


        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('kursy_');
        $this->db->like('DES', $search, 'both');

        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } return false;
    }
        
   
        
        
	public function index()
                
	{
	         
            $data['posts'] = $this->post_model->get_all_art();
            
            
           
            
                $this->load->view('partials/header');
             
                $this->load->view('post_index',$data);
		$this->load->view('partials/footer');
                
               
               
	}

        
        
        
        	public function search_index()
                
	{

                   
                    
$abc=FALSE; 
$szpieg = "" ;  //pomoc do searcha       

    $where  = $this->input->get('l_1');
    if (   (!($where==null))   &&   (!(is_numeric($where))))  {    $abc=TRUE; }
    
    $where1 = $this->input->get('l_2');
    if (   (!($where1==null))   &&   (!(is_numeric($where1))))  {  $abc=TRUE; } 

    $where2 = $this->input->get('l_3');
    if (   (!($where2==null))   &&   (!(is_numeric($where2))))  {  $abc=TRUE; } 

    if ($abc==TRUE){
    $this->session->set_flashdata('error', 'bład danych wejściowych');
    redirect('/posts/search_index') ;
    };



            if( ($where>0) && (empty($where1)) && (empty($where2))  ) {
                  $sql = "SELECT DES, TEMAT, OPIS, kursy_.ID FROM `kategorie_`, `kursy_`where kategorie_.ID_KURSU = kursy_.ID \n"
                    . " AND kategorie_.Level1 = \"$where\"\n"
                    . " ORDER BY DES\n"
                    . " ";             
            };        
            
            
            

            if( (($where>0)) && ($where1>0) && (empty($where2))  ) {
                  $sql = "SELECT DES, TEMAT, OPIS, kursy_.ID FROM `kategorie_`, `kursy_`where kategorie_.ID_KURSU = kursy_.ID \n"
                    . " AND kategorie_.Level1 = \"$where\"\n"
                    . " AND kategorie_.Level2 = \"$where1\"\n"
                    . " ORDER BY DES\n"
                    . " ";             
            };    
            
            if( (($where>0)) && ($where1>0) && ($where2>0)  ) {
                  $sql = "SELECT DES, TEMAT, OPIS, kursy_.ID FROM `kategorie_`, `kursy_`where kategorie_.ID_KURSU = kursy_.ID \n"
                    . " AND kategorie_.Level1 = \"$where\"\n"
                    . " AND kategorie_.Level2 = \"$where1\"\n"
                    . " AND kategorie_.Level3 = \"$where2\"\n"
                    . " ORDER BY DES\n"
                    . " ";             
            };    
            
            if (empty($sql)) {
                $sql = "SELECT DES, TEMAT, OPIS, kursy_.ID FROM `kategorie_`, `kursy_`where kategorie_.ID_KURSU = kursy_.ID \n LIMIT 0";
                $szpieg = 1 ;
            }

            

    ## PAGINACJA START ##########################################################################          

    if(isset($_REQUEST["l_1"])) { $str  =  "l_1=".$_REQUEST["l_1"] ;};
    if(isset($_REQUEST["l_2"])) { $str .= "&l_2=".$_REQUEST["l_2"] ;};
    if(isset($_REQUEST["l_3"])) { $str .= "&l_3=".$_REQUEST["l_3"] ;};
          
            
            $page= (@$_REQUEST["per_page"]) ;
           
            if  ($szpieg == 1) 
                {
            $sql_finish=$sql;        
            
                } 
                elseif(!(@$_REQUEST["per_page"])) {
            $sql_finish = $sql."LIMIT 0,3";
                }
                else {
            $sql_finish = $sql."LIMIT ".$page.",3";
                }
            

            $data['posts'] = $this->db->query($sql_finish);
            $data['posts']->num_rows; //liczba wierszy
            
           
                    
            
        $config = array();
        $config["base_url"] = base_url() . "index.php/posts/search_index?".@$str;
             
        $config["page_query_string"]= TRUE;
        
        $config["total_rows"] = $data['posts']->num_rows;
        $config["per_page"] = 2;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        
        $data["links"] = $this->pagination->create_links();
            
  
  
############################################################################          
               
		
                $this->load->view('partials/header');
                $this->load->view('partials/menu');
                $this->load->view('post_search', $data);
		$this->load->view('partials/footer');
	}
        
        
        
                	public function search_()
	{
##!--------------------------------
    $pag1=$this->input->get('search');
    
    if (empty($pag1))
		{
                        $this->session->set_flashdata('error', 'Wystąpił błąd: niepoprawne dane wyszukiwania');
			redirect('posts/search_index');
		}
         elseif (strlen($pag1)< 3){
             $this->session->set_flashdata('error', 'Wystąpił błąd: za krótki ciąg znaków');
			redirect('posts/search_index');
         };
             
         
##!--------------------------------    
    $pag2 = strip_quotes($pag1); //security
    $pag3 = htmlspecialchars($pag2); //security
    $pag = $this->db->escape_like_str($pag3); //security
##!--------------------------------    

Posts::anty_flood();

### chmura tagów
    $Tagi= new Chmura_tagow;
    $Tagi->show($pag);                       
    $data["tag_top"] = $Tagi->wyswietl_top_tag(); 
### chmura tagów END
    
        
        $config = array();
        $config["base_url"] = base_url() . "index.php/posts/search_?search=".$pag;
        
        $config["page_query_string"]= TRUE;
        $config["total_rows"] = $this->record_count($pag);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        
           $page= (@$_REQUEST["per_page"]) ;


        
        $data["results"] = $this->fetch_countries($config["per_page"], $page, $pag);
        $data["links"] = $this->pagination->create_links();
                
                $this->load->view('partials/header');
                $this->load->view('search_index', $data);
		$this->load->view('partials/footer');
            
        }
        
        
        
	public function _KOSZ_add()
	{	
            
		// Ustalamy reguły walidacji
                // liczba_uczestnikow
		$this->form_validation->set_rules('title', 'Tytuł', 'required|trim');
		$this->form_validation->set_rules('liczba_dni', 'liczba_dni', 'required|trim');
                $this->form_validation->set_rules('liczba_uczestnikow', 'liczba_uczestnikow', 'required|trim');
                $this->form_validation->set_rules('body', 'Treść', 'required|trim');
		$this->form_validation->set_rules('data_start', 'data_start', 'required|trim');
                
                
		// Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
		if ($this->form_validation->run() == FALSE)
		{
			// Wyświetlamy widoki - ewentualne błędy walidacji zostaną przekazane automatycznie
			$this->load->view('partials/header');
			$this->load->view('post_add');
			$this->load->view('partials/footer');
		}
		else
		{
			// Przypisujemy zmienne POST z formularza do tablicy $data
			$data['TEMAT'] = $this->input->post('TEMAT');
                        $data['DES'] = $this->input->post('DES');
                        $data['OPIS'] = $this->input->post('OPIS');
                        $data['DATA_BEGIN'] = $this->input->post('DATA_BEGIN');
                        
                        
                        
                         // Ustawiamy zmienną $data['user_id'] na identyfikator zalogowanego użytkownika, 
			// który przechowujemy w sesji (ustawiany jest w momencie logowania). 
			$data['user_id'] = $this->session->userdata('user_id');
			// Wysyłamy tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
			if ($this->post_model->add($data))
			
                            
                            {
				// Ustawiamy zmienną flashadata o nazwie success i przypisujemy do niej komunikat o powodzeniu dodania wpisu.
				$this->session->set_flashdata('success', 'Wpis został dodany.');				
			}
			else
			{
				// Ustawiamy zmienną flashadata o nazwie error i przypisujemy do niej komunikat o błędzie.
				$this->session->set_flashdata('error', 'Wystąpił błąd i wpis nie mógł zostać dodany.');
			}
			// Przekierowujemy użytkownika pod adres http://localhost/blogtutorial/index.php/posts


	redirect('posts');
		}
	}

        
        // START SEARCH
        // START SEARCH 
        	public function search() // poszukuje jesli niema wpisu w formularz
	{
                    
                    $this->form_validation->set_rules('search', 'search', 'required|trim');
                  
                    if ($this->form_validation->run() == FALSE)
                    {
                
                $data["results"] ='';
                $this->load->view('partials/header');
                $this->load->view('search_index', $data);
		$this->load->view('partials/footer');
                
                    }
                    else {
                        $this->session->set_userdata('frazacoo', $this->input->post('search'));
                        redirect('posts/search_');
                    };
                    
        }
        //END SEARCH 
        //END SEARCH 
        

        
        
        


## kopiuje do setup.php
        public function KOSZ_edit($id)
	{
		// Ustalamy reguły walidacji
		$this->form_validation->set_rules('DES', 'DES', 'required|trim');
		$this->form_validation->set_rules('OPIS', 'OPIS', 'required|trim');
                $this->form_validation->set_rules('LNG_TIME', 'LNG_TIME', 'required|trim');


                
		// Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
		if ($this->form_validation->run() == FALSE)
		{
			// Pobieramy dane z modelu po zmiennej $id
			$data = $this->post_model->get($id);
                         
			// Przypisujemy otrzymane dane do widoku
			// Ewentualne błędy walidacji zostaną przekazane automatycznie
			$this->load->view('partials/header');
                        $this->load->view('post_edit', $data);
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
## kopiuje do setup.php UPUPUPUPUPUPUPUPUPUP

        
        
                          
                
                // END USUWA TEMAT DO KATEGORI 1/2/3
             
                // dodaje osobę odpowiedzilna za kurs
                
                public function _KOSZ_add_os_odpowiedzialna($id_kursu)
                { 
                
                echo "$id_kursu";
                echo "---";
                $id_osoba= $this->input->post('os_odpowiedzialna');
                 
                
                    
               
                $query = $this->db->query("INSERT INTO `e_learn`.`osoba_dopow_corel_kurs` (`id`, `id_kursu`, `id_osoby`) VALUES (NULL, '$id_kursu', '$id_osoba');");           
                 redirect('posts/edit/'.$id_kursu);   

                }
                // END dodaje osobę odpowiedzilna za kurs
                
                
                
                
                
                
                // dodaje jednostkę odpowiedzilna za kurs
                public function _KOSZ_add_jednostka_odpowiedzialna($id_kursu)
                { 
                
                echo "$id_kursu";
                echo "---";
                $id_osoba= $this->input->post('os_odpowiedzialna');
               
                $query = $this->db->query("INSERT INTO `e_learn`.`osoba_dopow_corel_kurs` (`id`, `id_kursu`, `id_osoby`) VALUES (NULL, '$id_kursu', '$id_osoba');");           
                 redirect('posts/edit/'.$id_kursu);   

                }
                
                          
                public function _KOSZ_add_id_jw($id_kursu) {

                $id_jw = $this->input->post('jednostka_wojskowa');
                $query = $this->db->query("UPDATE `e_learn`.`kursy_` SET `ID_PLATFORM` = $id_jw WHERE `kursy_`.`ID` = $id_kursu ");
                redirect('posts/edit/' . $id_kursu);
                }
                
                
                //wyświetl wszystkie szczegóły kursu OK_
                public function show_a($id_kursu) {

                
                $data['posts'] = $this->db->query("SELECT * FROM `kursy_` WHERE `ID` = $id_kursu " );
                $data['kategorie'] = $this->db->query("SELECT * FROM `kategorie_` where ID_KURSU = $id_kursu");                
                
                
                $this->load->view('partials/header');
                //$this->load->view('partials/menu');
                $this->load->view('post_show_art', $data);
		$this->load->view('partials/footer');

                }

                
                
// zabezpieczenie antyflood                 
public function anty_flood() {
                //----------------------
require_once 'HTTP/FloodControl.php';
try {
    $ip = HTTP_FloodControl::getUserIP();
} catch (HTTP_FloodControl_Exception $e) {
    die($e);
}
try {
    $fc = new HTTP_FloodControl();
    $fc->setContainer('MDB', array(
        'dsn' => 'mysql://root:abd@1234@localhost/e_learn',
        'table' => 'fc_logs',
        'autooptimize' => true
    ));
    $limits = array(
        6 => 6
    );
    if (!$fc->check($limits, $ip)) {
        $this->session->set_flashdata('error', 'Too many requests. Please try later.');
        redirect('posts/index');
        //die('Too many requests. Please try later.');
    }
} catch (HTTP_FloodControl_Exception $e) {
    die($e);
}
//----------------------
                }
                
                
}


/* End of file posts.php */
/* Location: ./application/controllers/posts.php */