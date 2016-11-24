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
    public static $csv_array = [];
    public static $is_first_time = true;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();

        if ( Csvparser::$is_first_time ) {
            Csvparser::$is_first_time = false;

            try {
                $file = fopen("data.csv","r");

                $skip_first_record = true;
                $field_lengths = [10, 20, 20, 50, 50, 50, 50, 50, 11, 20, 2, 2];

                while ( ($data = fgetcsv($file, '', ";")) !== FALSE) {

                    if ( $skip_first_record ) {
                        $skip_first_record = false;
                        continue;
                    }

                    for ( $i = 0; $i < 11; $i++ ) {

                        //Check for required fields
                        if ( in_array($i, [0,1,2,8,9,10,11]) && trim($data[$i]) === '' ) {
                            echo 'All fields are required, except skills';
                            exit;
                        }

                        //Check for length of the fields
                        if ( strlen($data[$i]) > $field_lengths[$i] ) {
                            echo $data[$i] . ' should only be ' . $field_lengths[$i] . 'characters long';
                            exit;
                        }

                        //Strip Html tags and slashes
                        stripslashes($data[$i]);
                        strip_tags($data[$i]);
                    }

                    array_push(Csvparser::$csv_array, $data);
                }

                fclose($file);
            } catch (Exception $ex) {

                $error_msg = 'An error occured while trying to fetch data from the file, near line no. 31-45 in Csvparser.php library : ';
                log_message('error', $error_msg . $ex);
                echo 'An error occured while trying to fetch data from the file. Please try again later';
                exit();
            }

        }
    }

    /**
     * Get all HR names
     *
     * @param void
     * @return array $hr_names
     */
    public function get_hr_names()
    {
        $skip_first_record = true;

        $hr_names = [];

        foreach ( Csvparser::$csv_array as $data ) {

            if ( $skip_first_record ) {
                $skip_first_record = false;
                continue;
            }

            array_push($hr_names, $data[10], $data[11]);
        }

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
        $skip_first_record = true;

        $skills = [];

        foreach ( Csvparser::$csv_array as $data ) {

            if ( $skip_first_record ) {
                $skip_first_record = false;
                continue;
            }

            array_push($skills, $data[3], $data[4], $data[5], $data[6], $data[7]);
        }

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
        $skip_first_record = true;

        foreach ( Csvparser::$csv_array as $data ) {

            if ( !$skip_first_record) {
                $this->CI->employee->insert($data[0], $data[1], $data[2], $data[10], $data[11]);
            } else {
                $skip_first_record = false;
            }
        }

    }

    /**
     * Insert Employee Stackoverflow Details
     *
     * @param void
     * @return void
     */
    public function insert_employee_stack_details()
    {
        $skip_first_record = true;

        foreach ( Csvparser::$csv_array as $data ) {

            if ( !$skip_first_record) {
                $this->CI->stackinfo->insert($data[0], $data[8], $data[9]);
            } else {
                $skip_first_record = false;
            }
        }
    }

    /**
     * Insert data into employee_skills lookup table
     *
     * @param void
     * @return void
     */
    public function insert_employee_skills_lookup()
    {
        $skip_first_record = true;

        $skill_no = [3, 4, 5, 6, 7];

        foreach ( Csvparser::$csv_array as $data ) {

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
    }
}
?>