<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: LeoHao
 * Date: 15/7/28
 * Time: 下午3:47
 */
class Movies extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id = '';
    var  $name = '';
    var  $genres_id = '';
    var  $section = '';
    var  $created_at = '';
    var  $updated_at = '';
    var  $douban_id = '';

    //database name beans
    const __DATABASE= 'beans';

    //table name movies
    const __TABLE= 'movies';

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

    /**
     * is exist movie
     *
     * @return bool
     */
    public function isExistMovie()
    {
        $where_data = array(
            'douban_id' => $this->douban_id,
        );
        $query = $this->db->get_where(self::__TABLE, $where_data, 1);
        $result = $query->result();
        if(count($result))
        {
            return true;
        }
        return false;
    }
}