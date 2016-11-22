<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Parses the csv data,then inserts in database
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class ParseCsvController extends CI_Controller {

    /**
     * Parses CSV file and inserts data into database
     *
     * @param void
     * @return void
     */
    public function parse() {

        //Note start time to calculate total time taken in parsing and storing data
        $start_time = time();

        $this->load->library('csvparser');

        //Get a list of all HRs
        $hr_names = $this->csvparser->get_hr_names();

        $this->load->model('hr');

        //Insert HR name's list($hr_names) in the 'hr' table
        foreach ($hr_names as $value) {
            $this->hr->insert($value);
        }

        //Get all the skills(only unique skills, case-sensitive i.e., 'Php' and 'php' are treated as two skills
        $skills = $this->csvparser->get_skills();

        $this->load->model('skills');

        //Insert all the skills($skills) in the 'skill' table
        foreach ($skills as $value) {
            $this->skills->insert($value);
        }


        $this->load->model('employee');

        //Insert employee details in 'employee' table
        $this->csvparser->insert_employee_details();

        $this->load->model('stackinfo');

        //Insert employee's stackoverflow details in 'employee_stackinfo' table
        $this->csvparser->insert_employee_stack_details();

        //Insert data in 'employee_skills' table
        $this->csvparser->insert_employee_skills_lookup();

        //Note end time to calculate total time taken in parsing and storing data
        $end_time = time();

        echo 'Data inserted successfully in ';
        echo $end_time - $start_time;
        echo ' seconds';
    }
}
