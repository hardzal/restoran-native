<?php

namespace app\config;

class Utilities
{

    private $page_per_records = 9;
    private $fileName;

    public function __construct()
    { }

    public static function setMessage($message, $type)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function getMessage()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show" role="alert"> Data Mahasiswa 
            <strong>' . $_SESSION['flash']['message'] . '</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            unset($_SESSION['flash']);
        }
    }

    public function paginate()
    { }

    public function upload($_file)
    {
        $image_allowed = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp');

        if (isset($_file) && !empty($_file)) {
            $fileName = $_file['name'];
            $fileTmpName = $_file['tmp_name'];
            // $fileType = $_FILES[$name]['type'];
            $fileSize = $_file['size'];
            $fileError = $_file['error'];

            $fileExtension = explode('.', $fileName);

            $fileActualType = strtolower(end($fileExtension));

            if ($fileError == 0) {
                if (in_array($fileActualType, $image_allowed)) {
                    if ($fileSize < 5000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualType;

                        $fileDestination = './public/assets/images/' . $fileNameNew;

                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $this->setFileName($fileNameNew);
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function setFileName($name)
    {
        $this->fileName = $name;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function exporting()
    { }

    public function importing()
    { }
}
