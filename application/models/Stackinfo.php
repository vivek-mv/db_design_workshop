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

        $data = array(
            'emp_id' => $this->employee->get_employee_id($emp_id),
            'stack_id' => $stack_id,
            'nickname' => $nickname
        );

        $this->db->insert('employee_stackinfo', $data);
    }
}
?>