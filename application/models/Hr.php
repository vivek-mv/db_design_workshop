<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * HR Model
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class Hr extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * Insert HR data
     *
     * @param string $hr_initials
     * @return void
     */
    public function insert($hr_initials) {

        $data = array(
            'name' => $hr_initials,
        );

        $this->db->insert('hr', $data);
    }

    /**
     * Get hr id
     *
     * @param string $hr_initials
     * @return void
     */
    public function get_hr_id($hr_initials) {

        $this->db->where('name', $hr_initials);
        $query = $this->db->get('hr');

        return $query->result()[0]->id;
    }

}
?>