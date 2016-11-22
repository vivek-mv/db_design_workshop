<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employee Model
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class Employee extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * Insert employee data
     *
     * @param String $emp_id
     * @param String $first_name
     * @param String $last_name
     * @param String $created_by
     * @param String $update_by
     * @return void
     */
    public function insert($emp_id, $first_name, $last_name, $created_by, $update_by) {

        $data = array(
            'emp_id' => $emp_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'created_by' => $this->hr->get_hr_id($created_by),
            'updated_by' => $this->hr->get_hr_id($update_by),
        );

        $this->db->insert('employee', $data);
    }

    /**
     * Get employee id
     *
     * @param String $emp_no
     * @return integer
     */
    public function get_employee_id($emp_no) {

        $this->db->where('emp_id', $emp_no);
        $query = $this->db->get('employee');

        return $query->result()[0]->id;
    }

    /**
     * Insert employee skills
     *
     * @param String $employee_no
     * @param String $skill_name
     * @return void
     */
    public function insert_employee_skills($employee_no, $skill_name) {

        $data = array(
            'emp_id' => $this->get_employee_id($employee_no),
            'skill_id' => $this->skills->get_skill_id($skill_name),
        );

        $this->db->insert('employee_skills', $data);
    }

    /**
     * Get employee details, skills are excluded
     *
     * @param void
     * @return object
     */
    public function get_employee_details() {

        $query = $this->db->query('
                            select e.emp_id, e.first_name, e.last_name, estack.stack_id, estack.nickname, hr.name as created_by, uhr.name as updated_by from employee as e 
                            join hr on hr.id = e.created_by
                            join hr as uhr on uhr.id = e.updated_by
                            join employee_stackinfo as estack on e.id = estack.emp_id'
        );

        return $query->result();
    }

    /**
     * Get employee skills
     *
     * @param void
     * @return object
     */
    public function get_employee_skills() {

        $query = $this->db->query('
                            select e.emp_id, s.name from employee_skills as es 
                            join employee as e on e.id = es.emp_id
                            join skill as s on s.id = es.skill_id 
                            '
        );

        return $query->result();
    }
}
?>