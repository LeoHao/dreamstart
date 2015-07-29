<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);
/**
 * Created by PhpStorm.
 * User: LeoHao
 * Date: 15/7/25
 * Time: 下午4:27
 */
class GetTopMovie extends CI_Controller{

    // top movie list url
    const TOP_MOVIE_API = 'https://api.douban.com/v2/movie/top250?';

    // this is movie detail url
    const MOVIE_DETAIL_URL = 'http://movie.douban.com/subject/';

    /**
     * 构造器
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        for($count=0; $count<=200;$count=$count+50) {
            $this->_get_contents_for_page(self::TOP_MOVIE_API.'&start='.$count.'&count=50');
            $this->_disposeMovieData();
        }
    }

    /**
     * get content for page
     *
     * @param $url page url
     *
     * @http://movie.douban.com/nowplaying/beijing
     */
    private function _get_contents_for_page($url)
    {
        $this->get_contents_page = null;
        $this->get_contents_page = json_decode(file_get_contents($url));
    }

    /**
     * dispose movie data
     *
     * @return void
     */
    private function _disposeMovieData() {
        $this->load->model('movies', 'movies_model', TRUE);
        $this->load->model('genres', 'genres_model', TRUE);
        foreach ($this->get_contents_page->subjects as $top_index => $movie_detail) {
            $this->movies_model->douban_id = $movie_detail->id;
            var_dump($this->movies_model);die;
            if (!$this->movies_model->isExistMovie()) {
                $genres_id = array();
                foreach ($movie_detail->genres as $simple_genres) {
                    $this->genres_model->name = $simple_genres;
                    if ($exist_genres = $this->genres_model->isExistGenres()) {
                        array_push($genres_id, $exist_genres->id);
                    } else {
                        $insert_id = $this->genres_model->insertGenresData();
                        array_push($genres_id, $insert_id);
                    }
                }
                $this->movies_model->section = 'top';
                $this->movies_model->name = $movie_detail->title;
                $this->movies_model->genres_id = implode(',', $genres_id);
                $this->movies_model->created_at = date('Y-m-d H:i:s', time());
                $this->movies_model->insertMovieData();
            }
        }
        sleep(60);
    }
}