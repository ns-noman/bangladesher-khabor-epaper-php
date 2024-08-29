<?php
class DateModel extends CI_Model {

    function DateModel()
    {
        parent::__construct();
		$this->DB2 = $this->load->database('date',true);
    }
    
    
    ///direct query select return single row
	function query_first_row($query)
    {
	    return   $this->DB2->query($query)->first_row('array');
    }
    
    
	
	///one condition single table
	function getlist($table, $item, $where1=null, $order = null, $limit=null,$offset=null)
    {
              //  $this->db->cache_on(); 
			  if($order!=null || $order!='')
		$this->db->order_by($order);
		$this->db->select($item);
		$this->db->from($table);
		$this->db->where($where1);
                if($limit!=null || $limit!='')
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
		
    }	
	
	    
	
	// where_in single table
	function getwherein($table, $item, $where, $con_field=null, $where_in=null, $order = null, $limit=null,$offset=null,$backticks=true)
    {
              //  $this->db->cache_on(); 
		$this->db->order_by($order);
		$this->db->select($item,FALSE);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where_in($con_field, $where_in);
		if($limit!=null)
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
		
    }	
	
 
	
	
		///one condition single table 1 return
	
	function getfirstrow($table, $item="*", $where1=null, $order = null, $limit=null,$offset=null)
    {
		
                $this->db->select($item);
		$this->db->from($table);
                
               if($order !=null && $order != '')
                 $this->db->order_by($order);
                
                if($where1 !=null && $where1 != '')
                    $this->db->where($where1);
                if($limit !=null && $limit != '')
                    $this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->first_row('array');	
		
    }	
	
	
	function getcolumn($table, $item="*", $where1=null, $order = null, $limit=null,$offset=null)
    {
		
		 
		$this->db->select($item);
		$this->db->from($table);
		
		if($where1 !=null && $where1 != '')
        $this->db->where($where1);
        
		if($limit !=null && $limit != '')
        $this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		return  $query->row()->$item;	 
		
    }	
	
	
	
	
	
	///one condition single table
	function getlistrelational($table1, $table2, $item, $where1=null, $whererelation,  $order = null, $limit=null,$offset=null)
    {
             $this->db->select($item)
        ->from($table1)
        ->join($table2, $whererelation, 'left')
        ->order_by($order)
		->limit($limit, $offset);

        $query = $this->db->get();

        return $query->result_array();
		
    }	
	
	    /**
	 * Delete  record
	 *
	 * @param	table
	  * @param	int
	 * @return	bool
	 */
	function delete($table, $where)
	{
		$this->db->where($where);
		 
		$this->db->delete($table);
		if ($this->db->affected_rows() > 0) {
			 
			return TRUE;
		}
		return FALSE;
	}
	
	
 

	function update($table, $where=null, $data=null)
    {
		$this->db->update($table, $data, $where);
		return TRUE;
    }	


function insert($table, $data=null)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
 
  
	
	
		function getupdate($table, $fieldb , $fielda, $where)
	{
		$this->db->set($fieldb, $fielda , FALSE);
		$this->db->where($where);
		$this->db->update($table);
		
		//$this->db->query('UPDATE blog SET TotalComment = TotalComment + 1 WHERE BlogID = ' . $id);
		//$this->db->update('commentsquote', $data, "CommentsquoteID = $id");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	///direct query select
	function query($query)
    {
     
	 
	       return   $this->db->query($query)->result_array();
    
       
		
    }	
	
	
	 
	
	///direct query
	function querywithoutresult($query)
    {
           $this->db->query($query);
     
    }	
	
	  function get_last_id($table_name = '', $field_name)
	{
		$this->db->select_max($field_name);
		$this->db->from($table_name);
		$results = $this->db->get()->row();
		if($results->$field_name == '')
		{
			$last_id = 0;
		}
		else
		{
			$last_id = $results->$field_name;
		}
		return $last_id;
	}
	
	
	
	  
	  function get_siteconfig($key)
	{
		$this->db->select($key);
		$this->db->from('sitesetup');
		$setting = $this->db->get();
		if( $setting->num_rows() > 0){
			$config = $setting->row();
			$value = $config->$key;
		}
		else{
			$value = '';
		}
		return $value;
	}
	
}
?>