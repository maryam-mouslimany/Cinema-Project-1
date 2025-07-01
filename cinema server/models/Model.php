<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); 
        }

        return $objects; 
    }

    public static function create(mysqli $mysqli, array $data){
        $columns = array_keys($data); 
        $values= array_values($data); 
        $columnsString = implode(", ", $columns);          
        $placeholders = [];
        for ($i=0;$i<count($values);$i+=1){
            $placeholders[]='?';
        }
        $placeholdersString=implode(", ", $placeholders); 
        $table = static::$table;


        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",$table,$columnsString,$placeholdersString);
        $types = '';
        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's'; 
            } 
        }
        $query = $mysqli->prepare($sql);
        $query->bind_param($types,...$values);
        $query->execute();
        return;
    }

    public function update(mysqli $mysqli ,array $data): bool{

        $columns = array_keys($data);
        $values =array_values($data);
        for ($i =0;$i<count($columns);$i++){
            $columns[$i].=' =?';
        }
        $columnsString = implode(", ", $columns);

        $table = static::$table;
        $primary_key = static::$primary_key;

        $values[] = $this->{$primary_key};
        $types='';

        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's'; 
            } 
        }
        $sql = sprintf("UPDATE %s SET %s WHERE %s = ?",$table,$columnsString,$primary_key);
        $query = $mysqli->prepare($sql);
        $query->bind_param($types, ...$values);
        $query->execute();

        return $query->affected_rows > 0;
    }

    public static function delete(mysqli $mysqli, int $id){
        $table = static::$table;
        $primary_key = static::$primary_key;

        $sql=sprintf("Delete from %s where %s = ?",$table,$primary_key );
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();
    }
}