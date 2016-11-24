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

        try {
            $data = array(
                'name' => $skill_name,
            );

            $this->db->insert('skill', $data);
        } catch (Exception $ex) {
            $error_msg = 'An error occured while trying to insert data into database, near line no. 31-35 in Employee.php model : ';
            log_message('error', $error_msg . $ex);
            show_error('An error occured while trying to insert data into database. Please try again later', '', $heading = 'An Error Was Encountered');
            exit();
        }

    }

    /**
     * Get skill id
     *
     * @param string $skill_name
     * @return integer
     */
    public function get_skill_id($skill_name) {

        try {
            $this->db->where('name', $skill_name);
            $query = $this->db->get('skill');
            
            return $query->result()[0]->id;
        } catch (Exception $ex) {
            $error_msg = 'An error occured while trying to get data from database, near line no. 31-35 in Employee.php model : ';
            log_message('error', $error_msg . $ex);
            show_error('An error occured while trying to get data from database. Please try again later', '', $heading = 'An Error Was Encountered');
            exit();
        }
    }
}
?>