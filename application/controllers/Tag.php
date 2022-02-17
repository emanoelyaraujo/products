<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tag extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('Tag_model', 'model');
    }

    public function index()
    {
        $this->load->view('tags/list', [
            'action' => 'list',
            'tags' => $this->model->findAll()
        ]);
    }

    public function form($id)
    {
        $this->load->view('tags/form', [
            'action' => $this->uri->segment(2),
            'tag' => $this->model->findAll($id)
        ]);
    }

    public function register()
    {
        $this->form_validation->set_rules("name", "nome", "trim|required|is_unique[product.name]|max_length[50]");

        if ($this->form_validation->run() != FALSE) {
            $tag = $this->model->register($this->input->post());

            if ($tag) {
                $this->session->set_flashdata("success", "Produto cadastrado!");
            } else {
                $this->session->set_flashdata("error", "Falha ao cadastrar produto.");
            }
            redirect("Tag");
        } else {
            $this->msgErro();
        }

        redirect('Tag/create');
    }

    public function update()
    {
        $post = $this->input->post();
        $id = $this->input->post('id');
        unset($post['id']);

        $this->form_validation->set_rules("name", "nome", "trim|required|max_length[50]");

        if ($this->form_validation->run() != FALSE) {
            $affectedRows = $this->model->update($id, $post);

            if ($affectedRows > 0) {
                $this->session->set_flashdata("success", "Produto atualizado!");
            } else {
                $this->session->set_flashdata("error", "Falha ao atualizar produto.");
            }

            redirect("Tag");
        } else {
            $this->msgErro();
        }

        redirect("Tag/update/$id");
    }

    public function delete()
    {
        $affectedRows = $this->model->delete($this->input->post('id'));

        if ($affectedRows > 0) {
            $this->session->set_flashdata("success", "Produto excluído!");
        } else {
            $this->session->set_flashdata("error", "Falha ao excluir produto.");
        }

        redirect("Tag");
    }

    public function msgErro()
    {
        $errorArray = $this->form_validation->error_array();

        foreach ($errorArray as $index => $e) {
            $this->session->set_flashdata($index, "<small class='text-danger'>$e</small>");
        }
    }
}
