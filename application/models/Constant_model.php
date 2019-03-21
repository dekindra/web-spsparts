<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Constant_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    // Query Data from Table with Order;
    public function getDataAll($table, $order_column, $order_type)
    {
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataRow($table)
    {
        $query = $this->db->get("$table");
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoin($table, $column, $table1, $column1, $order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinWhere($table, $column, $table1, $column1, $field , $valuefield ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinWhereRow($table, $column, $table1, $column1, $field , $valuefield ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns;
    public function getDataOneColumn($table, $col1_name, $col1_value)
    {
        $this->db->where("$col1_name", $col1_value);

        $query = $this->db->get("$table");
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns;
    public function getDataOneColumnRowArray($table, $col1_name, $col1_value)
    {
        $this->db->where("$col1_name", $col1_value);

        $query = $this->db->get("$table");
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneColumnResult($table, $col1_name, $col1_value)
    {
        $this->db->where("$col1_name", $col1_value);

        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table By two columns;
    public function getDataTwoColumn($table, $col1_name, $col1_value, $col2_name, $col2_value)
    {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name", $col2_value);

        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table By two columns;
    public function getDataTwoColumnRow($table, $col1_name, $col1_value, $col2_name, $col2_value)
    {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name", $col2_value);

        $query = $this->db->get("$table");
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinTwoWhere($table, $column, $table1, $column1, $field , $valuefield, $field1 , $valuefield1 ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->where("$field1", "$valuefield1");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinOneWhereRowArray($table, $column, $table1, $column1, $field , $valuefield ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinTwoWhereRowArray($table, $column, $table1, $column1, $field , $valuefield, $field1 , $valuefield1 ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->where("$field1", "$valuefield1");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinTwoOneOrWhere($table, $column, $table1, $column1, $field , $valuefield, $field1 , $valuefield1 , $field2 , $valuefield2 , $field3 , $valuefield3 ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->where("$field1", "$valuefield1");
        $this->db->or_where("$field2", "$valuefield2");
        $this->db->where("$field3", "$valuefield3");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataOneJoinOneOrWhere($table, $column, $table1, $column1, $field , $valuefield, $field1 , $valuefield1 ,$order_column, $order_type)
    {   
        $this->db->join("$table1", "$table.$column = $table1.$column1");
        $this->db->where("$field", "$valuefield");
        $this->db->or_where("$field1", "$valuefield1");
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns and Sort;
    public function getDataOneColumnSortColumn($table, $col1_name, $col1_value, $sort_column, $sort_type)
    {
        $this->db->where("$col1_name", $col1_value);

        $this->db->order_by("$sort_column", "$sort_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns and Sort;
    public function getDataTwoColumnSortColumn($table, $col1_name, $col1_value, $col2_name, $col2_value, $sort_column, $sort_type)
    {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name", $col2_value);

        $this->db->order_by("$sort_column", "$sort_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Not Equal To;
    public function twoColumnNotEqual($table, $col1_name, $col1_value, $col2_name, $col2_value)
    {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name != ", $col2_value);

        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }


//----------------------------------------CRUD----------------------------------------------------------------

    // Insert Data to Any Table;
    public function insertData($table, $data)
    {
        return $this->db->insert("$table", $data);
    }

    // Insert Data to Any Table and get the last id;
    public function insertDataReturnLastId($table, $data)
    {
        $this->db->insert("$table", $data);

        return $this->db->insert_id();
    }

    // Update Data to Any Table;
    public function updateData($table, $data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update("$table", $data);

        return true;
    }

    // Delete Data from Any Table;
    public function deleteData($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete("$table");

        return true;
    }

    // Update Data to Any Table;
    public function updateDataDinamis($table, $data, $id, $id1)
    {
        $this->db->where("$id", $id1);
        $this->db->update("$table", $data);

        return true;
    }

    public function updateDataDinamisTwoWhere($table, $data, $id, $id1, $id2, $id3)
    {
        $this->db->where("$id", $id1);
        $this->db->where("$id2", $id3);
        $this->db->update("$table", $data);

        return true;
    }

     public function UpdateDataReturnLastId($table, $data, $id, $id1)
    {
        $this->db->where("$id", $id1);
        $this->db->update("$table", $data);

        return $this->db->insert_id();
    }

    // Delete Data from Any Table;
    public function deleteDataDinamis($table, $id, $id1)
    {
        $this->db->where("$id", $id1);
        $this->db->delete("$table");

        return true;
    }

    public function deleteByColumn($table, $col_name, $col_value)
    {
        $this->db->where("$col_name", $col_value);
        $this->db->delete("$table");

        return true;
    }

}
