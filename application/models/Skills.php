<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Skills Model
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class Skills extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * Insert skill data
     *
     * @param string $skill_name
     * @return void
     */
    public function insert($skill_name) {

        $data = array(
            'name' => $skill_name,
        );

        $this->db->insert('skill', $data);
    }

    /**
     * Get skill id
     *
     * @param string $skill_name
     * @return integer
     */
    public function get_skill_id($skill_name) {

        $this->db->where('name', $skill_name);
        $query = $this->db->get('skill');
        return $query->result()[0]->id;
    }

}
?>