<?php
// if it's going to need the database, then it's
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'Database.php');

class DatabaseObject
{
    // Common Database Methods
    public static function find_all()
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name);
    }

    public static function find_by_id($id = 0)
    {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=" . $database->escape_value($id) ." LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function search($searchq = "", $table_name = "")
    {
        global $database;
        $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
        $sql  = "SELECT * FROM ".$table_name." WHERE first_name LIKE '%".$searchq."%'";
        $sql .= " OR last_name LIKE '%".$searchq."%'";
        $sql .= " OR business_name LIKE '%".$searchq."%'";
        $sql .= " OR work_location LIKE '%".$searchq."%' ORDER BY first_name ASC";
        $result = static::find_by_sql($sql);
        return $result;
    }

    public static function find_by_sql($sql="")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set))
        {

            $object_array[] = static::instantiate($row);
        }

        return $object_array;
    }

    private static function instantiate($record)
    {
        // Could check that $record exists and is an array
        $class_name = get_called_class();
        $object = new $class_name;

        //echo $class_name;

        // More dynamic, short-form approach:
        foreach ($record as $attribute => $value)
        {
            //if(in_array($attribute, $object::$db_fields))
            if($object->has_attribute($attribute))
            {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute)
    {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value.
        $object_vars = get_object_vars($this);
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }
}

?>