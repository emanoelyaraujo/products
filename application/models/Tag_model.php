<?php

defined("BASEPATH") or exit("Ação não permitida.");

class Tag_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * findAll - lista todos as tags
     *
     * @param  int $id
     * @return object
     */
    public function findAll($id = null)
    {
        $this->db->select()
            ->from('tag')
            ->order_by('name');

        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        return is_null($id) ? $this->db->get()->result() : $this->db->get()->row();
    }

    /**
     * register - registra uma tag
     *
     * @param  mixed $post
     * @return int
     */
    public function register($post)
    {
        $this->db->insert('tag', $post);

        return $this->db->insert_id();
    }

    /**
     * update - atualiza uma tag
     *
     * @param  int $id
     * @param  mixed $post
     * @return int
     */
    public function update($id, $post)
    {
        return $this->db->where('id', $id)->update('tag', $post);
    }

    /**
     * delete - deleta uma tag
     *
     * @param  int $id
     * @return int
     */
    public function delete($id)
    {
        $this->db->where('id', $id)->delete('tag');

        return $this->db->affected_rows();
    }
}
