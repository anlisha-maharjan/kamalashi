<?php

class Gallerymedia_model extends MY_Model
{

    public $table = 'tbl_gallery_media';
    public $id = '', $gallery_id = '', $media = '', $type = '', $title = '', $caption = '';

    public function __construct()
    {
        parent::__construct();
    }

}