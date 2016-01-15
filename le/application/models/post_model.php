<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{
	// Nazwa tabeli, z której będziemy korzystać w modelu
	public $table = 'kursy_';
	
	/**
	 * Zwraca wpisy z podanego przedziału
	 *
	 * @access	public
	 * @param	int Limit
	 * @param	int Offset
	 * @return	mixed
	 */
	public function get_all()
	{
$this->db->select('*');
$this->db->from('kursy_');
$query = $this->db->get();
return $result = $query->result_array();


        }

        
        //wyszukuje ciągu w tablicy
public function get_search($fraza)
	{

$this->db->select('*');
$this->db->from('kursy_');
$this->db->like('DES',$fraza3,'both');
$query = $this->db->get();
return $result = $query->result_array();

        }
        
        

	/**
	 * Zwraca łączną liczbę wszystkich wpisów w tabeli
	 *
	 * @access	public
	 * @return	int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->table);
	}

	/**
	 * Zwraca wpisy o podanym numerze Id
	 *
	 * @access	public
	 * @param	int Numer Id wpisu
	 * @return	mixed
	 */
	public function KOSZ_get($id)
	{
		return $this->db->where('ID', $id)->get($this->table)->row_array();
	}

	/**
	 * Dodaje wpis do tabeli
	 *
	 * @access	public
	 * @param	array Dane do dodania
	 * @return	bool
	 */
	public function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/**
	 * Aktualizuje wpis w tabeli
	 *
	 * @access	public
	 * @param	int	Numer Id
	 * @param	array Dane do zaktualizowania
	 * @return	bool
	 */
	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update($this->table, $data);
	}
        
     
        public function get_all_art() {
        $this->db->select('*');
        $this->db->from('artykoly');
        $this->db->where('aktywny' , 1);
        $query = $this->db->get();
        
        return $result = $query->result_array();
 
        }
        
        

        
}



class Chmura_tagow extends CI_Model {
    
     public function show($pag) {
        
         if (!(stristr($_SERVER["QUERY_STRING"], "per_page=", true))) //pomiń przewijanie
           {

            
         $pytak = $this->db->query("SELECT * FROM `e_learn`.`chmura_tagow` WHERE `tag`= '$pag' " );
         
                
            if ( $pytak->num_rows() >0)  //czy istnieje tag
                {
                $this->db->query("UPDATE `e_learn`.`chmura_tagow` SET `licznik`= licznik +1 WHERE `tag`= '$pag'");
                    }  
                        else{
                            $this->db->query("INSERT INTO `e_learn`.`chmura_tagow` ( `licznik`, `tag`) VALUES ( '0', '$pag')");
                        }//czy istnieje tag END
         
           }//pomiń przewijanie END
    }
    
       public function wyswietl_top_tag() {
           
           $wyswietl_top_tag=$this->db->query("SELECT * FROM `chmura_tagow` ORDER BY `chmura_tagow`.`licznik` DESC LIMIT 10");
           return $wyswietl_top_tag;
       }
    

} // class Szukaj END




class KOSZ_Anty_form_flod extends CI_Model {

    private $ip;
    private $get_timestamp_ip;
    
    public function __construct(){
  
    }
    public function test_flood($pag){
        // JEŚLI IMPUT JEST start
        if ($pag=="") {    
            $this->session->set_flashdata('error', 'szukana fraza jest pusta');
            redirect('/posts/search_index');
                }
        // JEŚLI IMPUT JEST pusty  END


        $ip=ip2long($_SERVER["REMOTE_ADDR"]);     
        $this->db->query("INSERT INTO `e_learn`.`adm_ip_gosci` (`ip`) VALUES ($ip) ON DUPLICATE KEY UPDATE `licznik`= `licznik` +1");
        $get_timestamp_ip = $this->db->query("SELECT `time` FROM `adm_ip_gosci` WHERE `ip`=".$ip );
        
        $timestamp_ip=$get_timestamp_ip->row();
        
        $data_now = new DateTime('NOW');
        $data_last =new DateTime($timestamp_ip->time) ;
        
        var_dump($data_last)."---".var_dump($data_now);
        
        // $a=   $data_now->diff($data_last) ;
        //echo $a->format('%s')."ddddd";
        
        
        }
    
        
    }





/* End of file user_model.php */
/* Location: ./application/models/user_model.php */