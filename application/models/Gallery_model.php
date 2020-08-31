<?php

class Gallery_model extends MY_Model {

    public $table = 'tbl_gallery';
    public $id = '', $name = '', $slug = '', $cover = '', $short_description = '', $status = '', $orderNumber = '';

    public function __construct() {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    public function rules($id) {
        $array = array(
            array(
                'field' => 'name',
                'label' => 'Gallery Name',
                'rules' => 'trim|required|unique[tbl_gallery.name.' . $id . ']',
            )
        );

        return $array;
    }

    public function getSavedMedia($id) {
        $query = "select *
                    from `tbl_gallery_media` gm
                    where gm.`gallery_id` = $id";

        return $this->query($query);
    }

    public function getGallery($galleryId) {
        $query = "select
                    g.name as galleryName,
                    gm.*
                    from tbl_gallery g
                    join tbl_gallery_media gm on gm.gallery_id = g.id
                    where g.status = 'Active'
                    and g.id = $galleryId ORDER BY g.id DESC";
        return $this->query($query);
    }

    public function getAllGallery() {
        $query = "SELECT *
                  FROM tbl_gallery
                  WHERE `status`='Active'";

        $result = $this->query($query);

        $finList = array();

        if (isset($result) && !empty($result)) {

            foreach ($result as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }


                    $menuListGen["childList"] = Gallery_Model::getAllMedia($resultval->id);

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

    public function getAllMedia($gallery_id) {
        $sql = "SELECT * FROM tbl_gallery_media g WHERE g.`gallery_id` = $gallery_id";
        $result = $this->query($sql);

        return $result;
    }

}
