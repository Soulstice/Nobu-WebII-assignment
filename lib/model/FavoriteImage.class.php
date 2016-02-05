<?php
class FavoriteImage extends DomainObject implements Serializable {

	static function getFieldNames() {
    return array('imageID','path','title');
   }
	
	public function serialize() {
	return serialize(
		array("imageID" => $this->__get('imageID'),
				"path" => $this->__get('path'),
				"title" => $this->__get('title')
			)
	);
	}
	
	public function unserialize($data) {
	$data = unserialize($data);	
	$this->__set("imageID", $data['imageID']);
	$this->__set("path", $data['path']);
	$this->__set("title", $data['title']);
	
	}
	
}

?>