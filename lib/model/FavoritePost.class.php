<?php
class FavoritePost extends DomainObject implements Serializable {

	static function getFieldNames() {
    return array('postID','path','title');
   }
	
	public function serialize() {
	return serialize(
		array("postID" => $this->__get('postID'),
				"path" => $this->__get('path'),
				"title" => $this->__get('title')
			)
	);
	}
	
	public function unserialize($data) {
	$data = unserialize($data);	
	$this->__set("postID", $data['postID']);
	$this->__set("path", $data['path']);
	$this->__set("title", $data['title']);
	
	}
	
}

?>