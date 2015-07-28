<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: LeoHao
 * Date: 15/7/28
 * Time: 下午3:47
 */
class Genres extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id = '';
    var  $name = '';

    //database name beans
    const __DATABASE = 'beans';

    //table name movies
    const __TABLE= 'genres';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert genres data
     *
     * @return int
     */
    public function insertGenresData()
    {
        $insert_data = array(
            'name' => $this->name
        );
        $this->db->insert(self::__TABLE, $insert_data);
        return $this->db->insert_id();
    }

    /**
     * is exist genres name
     *
     * @return bool
     */
    public function isExistGenres()
    {
        $where_data = array(
            'name' => $this->name,
        );
        $query = $this->db->get_where(self::__TABLE, $where_data, 1);
        $result = $query->result();
        if(count($result))
        {
            return $result[0];
        }
        return false;
    }
}