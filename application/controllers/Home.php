<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model', 'model');
	}

	public function index()
	{
		$relatorio = $this->model->getRelatorio();

		$this->load->view('home',[
			'relatorio' => $relatorio,
			'countProduto' => $this->model->count('product'),
			'countTag' => $this->model->count('tag'),
			'countProductTag' => $this->model->count('product_tag')
		]);
	}
}
