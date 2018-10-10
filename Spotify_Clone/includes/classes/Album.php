<?php 
	/**
	* Class for Album creation
	*/
	class Album 
	{	
		private $con;
		private $id;
		private $title;
		private $artistId;
		private $genre;
		private $artworkPath;

		public function __construct($con , $id){
				$this -> con = $con;
				$this -> id = $id;

				$albumrQuery = mysqli_query($this -> con,"SELECT * FROM albums where id =  '$this->id'");
				$album = mysqli_fetch_array($albumrQuery);

				$this->title = $album['title'];
				$this->artistId = $album['artist'];
				$this->genre = $album['genre'];
				$this->artworkPath = $album['artworkPath'];
				
				
			}
		public function getTitle(){
			
			return $this->title;
		}

		public function getArtworkPath(){
			
			return $this->artworkPath;
		}

		public function getGenre(){
			
			return $this->genre;
		}

		public function getArtist(){
			
			return new Artist($this->con,$this->artistId);
		}

		public function getNumberOfSongs(){
			
			$NumberSongs = mysqli_query($this -> con,"SELECT id FROM songs where album =  '$this->id'");
			return mysqli_num_rows($NumberSongs);
		}
		
		public function getSongIds(){
			
			$songIds = mysqli_query($this -> con,"SELECT id FROM songs where album =  '$this->id' ORDER BY albumOrder ASC");
			$array = array();
			while ($row = mysqli_fetch_array($songIds)) {
				array_push($array, $row['id']);
			}
			return $array;
		}
		
		
	}
?>