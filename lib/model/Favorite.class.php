<?php
class FavoriteImage extends DomainObject/*  implements Serializable */{
	//private $id, $path, $title, $countryName;
	
	static function getFieldNames() {
    return array('imageID','path','title');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
	
	// public function serialize() {
	// return serialize(
		// array("id" => $this->id,
				// "path" => $this->path,
				// "title" => $this->title,
				// "countryName" => $this->countryName
			// )
	// );
	// }
	
	// public function unserialize($data) {
	// $data = unserialize($data);	
	// $this->id = $data['id'];
	// $this->path = $data['path'];
	// $this->title = $data['title'];
	// $this->countryName = $data['countryName'];
	
	// }

	// function __construct($id, $path, $title, $countryName) {
	// $this->setId($id);
	// $this->setPath($path);
	// $this->setTitle($title);
	// $this->setCountryName($countryName);
	// }
	
	// function setId($id) {
	// $this->id = $id;
	// }
	
	// function setPath($path) {
	// $this->path = $path;
	// }
	
	// function setTitle($title) {
	// $this->title = $title;
	// }
	
	// function setCountryName($countryName) {
	// $this->countryName = $countryName;
	// }
	
	// function getId() {
	// return $this->id;
	// }
	
	// function getPath() {
	// return $this->path;
	// }
	
	// function getTitle() {
	// return $this->title;
	// }
	
	// function getCountryName() {
	// return $this->countryName;
	// }
}

class FavoritePost extends DomainObject {
	static function getFieldNames() {
    return array('postID','path','title');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
}




?>