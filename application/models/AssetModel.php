<?php

Class AssetModel extends CI_Model {

    public function get_assets($asset_id = null)
    {

        if ($asset_id != null)
        {    
            $result = $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($asset_id))->get('assets');

        }else{

            $result = $this->mongo_db->order_by(array('_id' => 'ASC'))->get('assets');
        }
        
        return $result;
        
    }

    public function get_monitor($name)
    {

        $result = $this->mongo_db->where('description',$name)->get('assets');
        return $result;
        
    }

    public function get_snmp_assets($asset_id = null)
    {

        if ($asset_id != null)
        {    
            $result = $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($asset_id))->get('snmp_assets');

        }else{

            $result = $this->mongo_db->order_by(array('_id' => 'ASC'))->get('snmp_assets');
        }
        
        return $result;
        
    }

}