<?php
// if it's going to need the database, then it's
// probably smart to require it before we start.
require_once('Database.php');
require_once('DatabaseObject.php');

class User extends DatabaseObject
{
    protected static $table_name = "user";
    protected static $db_fields = array('id', 'username', 'first_name', 'insertion', 'last_name', 'telephone', 'password', 'admin', 'img_filename', 'img_size', 'img_type');

    public $id, $username, $password, $first_name, $last_name, $insertion, 
           $telephone, $admin, $img_filename, $img_size, $img_type;

    public function full_name()
    {
        if(isset($this->first_name) && isset($this->last_name))
        {
            return $this->first_name . " " . $this->last_name;
        }
        else
        {
            return "";
        }
    }

    public static function authenticate($username = "", $password = "")
    {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM user ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    private function has_attribute($attribute)
    {
        // get_object_vars return an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = $this->attributes();
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    protected function attributes()
    {
        //return an array of attribute keys and their values
        $attributes = array();
        foreach (self::$db_fields as $field)
        {
            if(property_exists($this, $field))
            {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->attributes() as $key => $value)
        {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();

        $sql = "INSERT INTO ". self::$table_name ." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        if($database->query($sql))
        {
            $this->id = $database->insert_id();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update()
    {
        global $database;
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-qoutes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();

        $attribute_pairs = array();
        foreach ($attributes as $key => $value)
        {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE ". self::$table_name ." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);

        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete()
    {
        global $database;
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM ". self::$table_name;
        $sql .= " WHERE id=". $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

}


?>
