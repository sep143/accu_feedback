<?php
defined('BASEPATH')OR exit('No direct scrip[t access allowed');

class Setting_model extends CI_Model{
    
    /*
     * get all language then list show
     */
    public function getAllLanguage(){
        $sql = "select * from language_survey ";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    public function addLanguage($data){
        $this->db->insert('language_survey', $data);
        return true;
    }
    
    /*
     * get language via id to then update on time ajax 
     */
    public function getLanguageRow($lang_id){
//        $this->db->where('ID', $lang_id);
//        return $data = $this->db->get('language_survey')->row();
        $sql = "select * from language_survey where ID=$lang_id";
        $data = $this->db->query($sql, array($lang_id));
        return $data->row();
    }
    
    /*
     * language update on get ajax then normal to update in database
     */
    public function updateLanguage($id, $data){
        $this->db->where('ID', $id);
        $this->db->update('language_survey', $data);
        return true;
    }
}