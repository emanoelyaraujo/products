<?php

defined("BASEPATH") or exit("Ação não permitida.");

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRelatorio()
    {
        $this->db->select('pt.tag_id, t.name, COUNT(tag_id) as qtd')
            ->from('product_tag AS pt')
            ->join('tag AS t', 't.id  = pt.tag_id', 'inner')
            ->group_by('tag_id');

        return $this->db->get()->result();
    }

    public function getProdutos($idTag)
    {
        $this->db->select('p.name')
            ->from('product_tag AS pt')
            ->join('product AS p', 'pt.product_id = p.id', 'INNER')
            ->where('pt.tag_id', $idTag);

        return $this->db->get()->result();
    }

    public function count($table)
    {
        if ($table == 'product' || $table == 'tag') {
            $this->db->select('COUNT(id)')
                ->from($table);

            return $this->db->get()->row('COUNT(id)');
        } else {
            $this->db->select('count(distinct(product_id))', false)
                ->from('product_tag');

            return $this->db->get()->row('count(distinct(product_id))');
        }
    }
}
