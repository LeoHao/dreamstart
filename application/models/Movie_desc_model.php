<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: LeoHao
 * Date: 15/7/28
 * Time: 下午3:47
 */
class Movie_desc_model extends CI_Model
{
    /**
     * 初始化基本字段
     */
    var  $id = '';
    var  $movie_id = '';
    var  $directors_id = '';
    var  $original_title = '';
    var  $aka = '';
    var  $alt = '';
    var  $rating = '';
    var  $writer_id = '';
    var  $casts_id = '';
    var  $countries = '';
    var  $language = '';
    var  $pubdates = '';
    var  $durations = '';
    var  $year = '';
    var  $image_path = '';
    var  $summary = '';
    var  $created_at = '';
    var  $updated_at = '';

    //database name beans
    const __DATABASE= 'beans';

    //table name movies
    const __TABLE= 'moviedesc';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert movie data
     */
    public function insertMovieData()
    {
        $this->db->insert(self::__TABLE, $this);
    }
}