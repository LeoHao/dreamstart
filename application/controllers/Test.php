<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }


    /**
     * show page
     */
    public function index()
    {
        $this->load->view('test');
    }
}