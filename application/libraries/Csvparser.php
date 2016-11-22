<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to parses CSV file
 *
 * @access public
 * @package void
 * @subpackage void
 * @category void
 * @author vivek
 * @link void
 */
class Csvparser {

    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }

    /**
     * Get all HR names
     *
     * @param void
     * @return array $hr_names
     */
    public function get_hr_names()
    {
        $file = fopen("data.csv","r");

        $skip_first_record = true;

        $hr_names = [];

        while ( ($data = fgetcsv($file, '', ";")) !== FALSE) {

            if ( $skip_first_record ) {
                $skip_first_record = false;
                continue;
            }

            array_push($hr_names, $data[10], $data[11]);
        }

        fclose($file);

        return array_unique($hr_names);
    }

    /**
     * Get all skills
     *
     * @param void
     * @return array $hr_names
     */
    public function get_skills()
    {
        $file = fopen("data.csv","r");

        $skip_first_record = true;

        $skills = [];

        while ( ($data = fgetcsv($file, '', ";"))  !== FALSE) {

            if ( $skip_first_record ) {
                $skip_first_record = false;
                continue;
            }

            array_push($skills, $data[3], $data[4], $data[5], $data[6], $data[7]);
        }

        fclose($file);

        return array_unique($skills);
    }

    /**
     * Insert Employee Details
     *
     * @param void
     * @return void
     */
    public function insert_employee_details()
    {
        $file = fopen("data.csv","r");

        $skip_first_record = true;

        while ( ($data = fgetcsv($file, '', ";"))  !== FALSE) {

            if ( !$skip_first_record) {
                $this->CI->employee->insert($data[0], $data[1], $data[2], $data[10], $data[11]);
            } else {
                $skip_first_record = false;
            }
        }

        fclose($file);
    }

    /**
     * Insert Employee Stackoverflow Details
     *
     * @param void
     * @return void
     */
    public function insert_employee_stack_details()
    {
        $file = fopen("data.csv","r");

        $skip_first_record = true;

        while ( ($data = fgetcsv($file, '', ";"))  !== FALSE ) {

            if ( !$skip_first_record) {
                $this->CI->stackinfo->insert($data[0], $data[8], $data[9]);
            } else {
                $skip_first_record = false;
            }
        }

        fclose($file);
    }

    /**
     * Insert data into employee_skills lookup table
     *
     * @param void
     * @return void
     */
    public function insert_employee_skills_lookup()
    {
        $file = fopen("data.csv","r");

        $skip_first_record = true;

        $skill_no = [3, 4, 5, 6, 7];

        while ( ($data = fgetcsv($file, '', ";")) !== FALSE) {

            if ( !$skip_first_record ) {
                foreach ($skill_no as $item){
                    if ( $data[$item] != '' ) {
                        $this->CI->employee->insert_employee_skills($data[0], $data[$item]);
                    }
                }
            } else {
                $skip_first_record = false;
            }
        }

        fclose($file);
    }
}
?>