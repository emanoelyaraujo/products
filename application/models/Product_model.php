<?php

defined("BASEPATH") or exit("Ação não permitida.");

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * findAll - lista todos os Produtos
     *
     * @param  int $id
     * @return object
     */
    public function findAll($id = null)
    {
        $this->db->select()
            ->from('product')
            ->order_by('name');

        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        return is_null($id) ? $this->db->get()->result() : $this->db->get()->row();
    }

    /**
     * getTags - lista todas as tags para
     * preencher a lista de checkbox
     *
     * @return object
     */
    public function getTags()
    {
        $this->db->select()
            ->from('tag')
            ->order_by('id');

        return $this->db->get()->result();
    }

    /**
     * getTagsByProduct
     *
     * @param  id $product_id
     * @return object
     */
    public function getTagsByProduct($product_id)
    {
        $this->db->select('tag_id')
            ->from('product_tag')
            ->where('product_id', $product_id)
            ->order_by('tag_id');

        return $this->db->get()->result_array();
    }

    /**
     * register - insere o produto
     *
     * @param  mixed $post
     * @param  string $name
     * @return bool
     */
    public function register($post, $name)
    {
        $this->db->trans_start();

        $array = [];
        $this->db->insert('product', $name);

        $id = $this->db->insert_id();

        foreach ($post['tag'] as $key => $t) {
            $array = [
                'product_id' => $id,
                'tag_id' => $t
            ];

            $this->db->insert('product_tag', $array);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * update - atualiza produto
     *
     * @param  int $id
     * @param  array $post
     * @param  string $name
     * @return void
     */
    public function update($id, $post, $name)
    {
        $this->db->trans_start();

        $this->db->where('id', $id)->update('product', $name);

        $array = [];

        $this->db->where('product_id', $id)->delete('product_tag');

        foreach ($post['tag'] as $t) {

            $array = [
                'product_id' => $id,
                'tag_id' => $t
            ];

            $this->db->insert('product_tag', $array);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * delete - deleta produto
     *
     * @param  int $id
     * @return int
     */
    public function delete($id)
    {
        $this->db->where('id', $id)->delete('product');

        return $this->db->affected_rows();
    }
}
