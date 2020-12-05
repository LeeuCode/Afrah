<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('theme.backup');
    }

    public function export()
    {
        backUpCreator();
    }

    public function import()
    {
        $host = "localhost";
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database_name = 'test'; //env('DB_DATABASE');

        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        // Change character set to utf8
        mysqli_set_charset($conn, "utf8");
        
        if (! empty($_FILES)) {
            // Validating SQL file type by extensions
            if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
                "sql"
            ))) {
                $response = array(
                    "type" => "error",
                    "message" => "Invalid File Type"
                );
            } else {
                if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                    move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
                    $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
                }
            }
        }
    }
}
