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

        try {
            $data = array(
                'name' => $hr_initials,
            );

            $this->db->insert('hr', $data);
        } catch (Exception $ex) {
            $error_msg = 'An error occured while trying to insert data into database, near line no. 31-35 in Employee.php model : ';
            log_message('error', $error_msg . $ex);
            show_error('An error occured while trying to insert data into database. Please try again later', '', $heading = 'An Error Was Encountered');
            exit();
        }

    }

    /**
     * Get hr id
     *
     * @param string $hr_initials
     * @return void
     */
    public function get_hr_id($hr_initials) {

        try {
            $this->db->where('name', $hr_initials);
            $query = $this->db->get('hr');

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