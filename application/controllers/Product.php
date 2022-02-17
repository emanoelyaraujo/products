<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('Product_model', 'model');
    }

    public function index()
    {
        $this->load->view('products/list', [
            'action' => 'list',
            'product' => $this->model->findAll()
        ]);
    }

    public function form($id)
    {
        $this->load->view('products/form', [
            'action' => $this->uri->segment(2),
            'product' => $this->model->findAll($id),
            'tags' => $this->model->getTags()
        ]);
    }

    public function register()
    {
        $post = $this->input->post();

        $name = [
            'name' => $post['name']
        ];

        unset($post['name']);
        unset($post['id']);

        $this->form_validation->set_rules("name", "nome", "trim|required|is_unique[product.name]|max_length[50]");

        if ($this->form_validation->run() != FALSE) {
            $product = $this->model->register($post, $name);

            if ($product > 0) {
                $this->session->set_flashdata("success", "Produto cadastrado!");
            } else {
                $this->session->set_flashdata("error", "Falha ao cadastrar produto.");
            }
            redirect("Product");
        } else {
            $this->msgErro();
        }

        redirect('Product/create');
    }

    public function update()
    {
        $post = $this->input->post();

        $name = [
            'name' => $post['name']
        ];

        $id = $this->input->post('id');
        unset($post['id']);
        unset($post['name']);

        $this->form_validation->set_rules("name", "nome", "trim|required|max_length[50]");

        if ($this->form_validation->run() != FALSE) {
            $affectedRows = $this->model->update($id, $post, $name);

            if ($affectedRows > 0) {
                $this->session->set_flashdata("success", "Produto atualizado!");
            } else {
                $this->session->set_flashdata("error", "Falha ao atualizar produto.");
            }

            redirect("Product");
        } else {
            $this->msgErro();
        }

        redirect("Product/update/$id");
    }

    public function delete()
    {
        $affectedRows = $this->model->delete($this->input->post('id'));

        if ($affectedRows > 0) {
            $this->session->set_flashdata("success", "Produto excluído!");
        } else {
            $this->session->set_flashdata("error", "Falha ao excluir produto.");
        }

        redirect("Product");
    }

    public function msgErro()
    {
        $errorArray = $this->form_validation->error_array();

        foreach ($errorArray as $index => $e) {
            $this->session->set_flashdata($index, "<small class='text-danger'>$e</small>");
        }
    }
}
