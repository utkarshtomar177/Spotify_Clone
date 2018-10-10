<?php include("includes/header.php") ;
	
	if(isset($_GET['id'])){
		$albumId= $_GET['id'];

	}
	else{
		header("Location: index.php");
	}

$album = new Album($con,$albumId);


$artist = $album->getArtist();





?>

<div class="entityInfo">
	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath();?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist->getName(); ?></p>
		<p><?php echo $album->getNumberOfSongs(); ?> Songs</p>
	</div>

</div>

<div class="tracklistContainer"> 
	<ul class="tracklist">
		<?php 
			$songIdArray = $album->getSongIds();

			foreach ($songIdArray as $songIds ) {
				$albumSong = new Song($con,$songIds);
				$albumArtist = $albumSong-> getArtist();
				$i = 1;
				echo "<li class='tracklistRow'>
						<div class='trackCount'>
						<img class='play' src='images/icons/play-white.png'>
						<span class='trackNumber'>$i</span>
						</div>


						<div class='trackInfo'>
							<span class='trackName'>
								" . $albumSong->getTitle() . "
							</span>

							<span class='artistName'>
								" . $albumArtist->getName() . "
							</span>

						</div>

						<div class='trackOptions'>
							<img class='optionButton' src='images/icons/more.png'>

						</div>
						<div class='trackDuration'>
							<span class='Duration' >" . $albumSong->getDuration() . "</span>

						</div>


				</li>";
				$i = $i+1 ;
			}
		 ?>
	</ul>
</div>
<?php include("includes/footer.php") ?>
			