<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gets and displays the employee details
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class HomeController extends CI_Controller {

    /**
     * Display Employee details
     *
     * @param void
     * @return void
     */
    public function show() {

        $this->load->model('employee');

        //Get employee details, except employee skills
        $data['employee_details'] = $this->employee->get_employee_details();

        //Get employee skills
        $data['employee_skills'] = $this->employee->get_employee_skills();

        $this->load->view('show_employee_data',$data);
    }
}
