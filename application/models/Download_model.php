<?php

class Download_model extends MY_Model
{

    public $table = 'tbl_download';
    public $id = '', $name = '', $updated_by = '', $updated_on = '', $status = '',$publish_date = '',  $category_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    public function rules($id)
    {
        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Title',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'publish_date',
                'label' => 'Publish Date',
                'rules' => 'trim|required',
            )
        );

        return $rules;
    }

    public function getAllData()
    {
        $query = "select d.name,d.id,d.status,c.name as categoryNamefrom tbl_download djoin tbl_category c where c.id = d.categoryId order by d.orderNumber asc";

        return $this->query($query);
    }

    public function get_category(){
        $query = "select slug,name from tbl_category where status = 'Active' and type = '3' order by name asc";

        $results=$this->query($query);
        foreach($results as $result){
            $res[$result->slug] = $result->name;
        }
       return $res;
    }
    public function getSavedMedia($id)
    {
        $query = "select * from `tbl_download_media` dm where dm.`download_id` = $id and module_type = 'download'";

        return $this->query($query);
    }

    public function getAllMedia()
    {
        $sql = "SELECT d.*,dm.download_id, dm.module_type,dm.media,dm.description FROM `tbl_download` d join `tbl_download_media` dm on d.id=dm.download_id where  d.`status` = 'Active' AND dm.`module_type` = 'download'";

        $result = $this->query($sql);

        return $result;
    }
    
    public function getAllMediaByCategory($category_id)
    {
        $sql = "SELECT d.*,dm.download_id, dm.module_type,dm.media,dm.description FROM `tbl_download` d join `tbl_download_media` dm on d.id=dm.download_id where  d.`status` = 'Active' AND dm.`module_type` = 'download' AND d.`category_id` = '" . $category_id . "'";

        $result = $this->query($sql);

        return $result;
    }
    
    
    public function searchDownload($down_category_id){

        $query = "SELECT d.*,dm.download_id, dm.module_type,dm.media,dm.description FROM `tbl_download` d join      
          `tbl_download_media` dm on d.id=dm.download_id JOIN `tbl_category` c ON c.`id` = d.`category_id` WHERE 
          d.`category_id` = '{$down_category_id}' AND d.`status` = 'Active' AND dm.`module_type` = 'download'";

        
        $result = $this->query($query);
        return $result;
    }

    public function searchAll(){
        $query = "SELECT d.*,dm.download_id, dm.module_type,dm.media,dm.description FROM `tbl_download` d join      
          `tbl_download_media` dm on d.id=dm.download_id JOIN `tbl_category` c ON c.`id` = d.`category_id` WHERE 
           d.`status` = 'Active' AND dm.`module_type` = 'download'";

        
        $result = $this->query($query);
        return $result;
    }

}