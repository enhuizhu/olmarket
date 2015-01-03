<?php
/**
* db quotes
**/
if(!function_exists("dbQuotes")){
  function dbQuotes($value){
   global $wpdb;
   return "'".($value)."'";
  }
}

/**
* dataModel.php
* all the function related to database will come here
**/
class carouselModel{
	public $db;
  public $error;
	function __construct(){
        global $wpdb;
		$this->db = $wpdb;
	}

  /**
  * function to check if the table exsit
  **/
  public function isTableExsit($table){
    $sql="show tables like '$table'";
    $result = $this->db->get_results($sql);
    return empty($result)?false:true;
  }

  /**
  * function to create the carousel table
  **/
  public function initCarouselTable(){
    if($this->isTableExsit("carousel")) return true;
    $sql="CREATE TABLE carousel(
         carousel_id int(2) AUTO_INCREMENT,
         pic_name varchar(100),
         description TEXT,
         PRIMARY KEY (carousel_id)
      );";
    return $this->db->query($sql);
  }

  /**
  * function to add new image
  **/
  public function addNewImage($var){

        if(!$this->initCarouselTable()){
            $this->error = "create carousel table fail";
            return false;
        }
        
        $picName = $this->uploadImage();

        if (!$picName) {
           return false;
        }

        $sql  = "insert into carousel (pic_name,description) values (";
        $sql .= dbQuotes($picName).",";
        $sql .= dbQuotes($var["description"]);
        $sql .= ")";
        //echo $sql;
        if($this->db->query($sql)){
           return true;
        }else{
           $this->error = "sql error";
           return false;
        }
  }

  /**
  * function to upload image
  **/
  public function uploadImage(){
      $targetDir = dirname(__FILE__)."/uploads/";
      $fileName = basename($_FILES["carouselImg"]["name"]);
      $uploadPath = $targetDir."/original/".$fileName;
      $thumbPath = $targetDir."/screenshort/".$fileName;
      if (move_uploaded_file($_FILES["carouselImg"]["tmp_name"], $uploadPath)) {
        $this->createThumb($uploadPath,$thumbPath);
        return $fileName;  
      } else {
        $this->error = "file upload error";
        return false;
      }
  }

  /**
  * function to create pic thumb
  **/
  public function createThumb($source_image_path,$thumbnail_image_path){
    
    define('THUMBNAIL_IMAGE_MAX_WIDTH', 140);
    define('THUMBNAIL_IMAGE_MAX_HEIGHT', 161);

    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } else {
        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
  }


  public function getCarouselData(){
       $sql = "select * from carousel";
       return $this->db->get_results($sql);
  }

  /**
  * function to update the carousel
  **/
  public function updateCarousel($var){
      $sql = "update carousel set description=".dbQuotes($var["description"]); 
      $sql .=" where carousel_id=".dbQuotes($var["carouselId"]);    
      //die(var_dump($sql));
      return $this->db->query($sql);
  }

  
  /**
  * function to update the carousel
  **/
  public function deleteCarousel($var){
      $sql ="select * from carousel where carousel_id=".dbQuotes($var["carouselId"]);
      $result = $this->db->get_row($sql);
      $picName = $result->pic_name;
      
      $sql = "delete from carousel";
      $sql .=" where carousel_id=".dbQuotes($var["carouselId"]);    
      //die(var_dump($sql));
      if($this->db->query($sql)){
        $targetDir = dirname(__FILE__)."/uploads/";
        $originalFile = $targetDir."original/".$picName;
        $screenshort = $targetDir."screenshort/".$picName;
        unlink($originalFile);
        unlink($screenshort);
        return true;
      }else{
        return false;
      }
  }     

}
