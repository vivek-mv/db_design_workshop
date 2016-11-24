<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * StackInfo Model
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class Stackinfo extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * Insert stackinfo data
     *
     * @param string $emp_id
     * @param string $stack_id
     * @param string $nickname
     * @return void
     */
    public function insert($emp_id, $stack_id, $nickname) {

        try {
            $data = array(
                'emp_id' => $this->employee->get_employee_id($emp_id),
                'stack_id' => $stack_id,
                'nickname' => $nickname
            );

            $this->db->insert('employee_stackinfo', $data);
        } catch (Exception $ex) {
            $error_msg = 'An error occured while trying to insert data into database, near line no. 31-35 in Employee.php model : ';
            log_message('error', $error_msg . $ex);
            show_error('An error occured while trying to insert data into database. Please try again later', '', $heading = 'An Error Was Encountered');
            exit();
        }
    }
}
?>