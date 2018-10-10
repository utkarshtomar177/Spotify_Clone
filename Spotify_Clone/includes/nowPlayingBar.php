<?php 
	$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
	$resultArray = array();

	while ($row = mysqli_fetch_array($songQuery)) {
		array_push($resultArray,$row['id']);
	}

	$jsonArray = json_encode($resultArray);
 ?>

<script type="text/javascript">
	$(document).ready(function(){
		currentPlaylist = <?php echo $jsonArray; ?>;
		console.log(currentPlaylist);
		audioElement = new Audio;
		setTrack(currentPlaylist[0],currentPlaylist,false);
		updateVolumeProgressBar(audioElement.audio);

		$(".nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove",function(e){
			e.preventDefault();
		});


		$(".playbackBar .progressBar").mousedown(function(){
			mouseDown = true;
		});

		$(".playbackBar .progressBar").mousemove(function(e){
			if(mouseDown == true){
				timeFromOffset(e,this);
			}
			

		});
		$(".playbackBar .progressBar").mouseup(function(e){
			
			timeFromOffset(e,this);

		});

		$(".volumeBar .progressBar").mousedown(function(){
			mouseDown = true;
		});

		$(".volumeBar .progressBar").mousemove(function(e){
			if(mouseDown == true){
				var percentage = e.offsetX/$(this).width();
				if (percentage >=0 && percentage<=1) {
					
					audioElement.audio.volume = percentage;
				}
			}
			

		});
		$(".volumeBar .progressBar").mouseup(function(e){
			
				var percentage = e.offsetX/$(this).width();
				if (percentage >=0 && percentage<=1) {
					audioElement.audio.volume = percentage;
				}
		});

		$(document).mouseup(function() {
		mouseDown = false;
	});



/*
		$(".playbackBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".playbackBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {
			//Set time of song, depending on position of mouse
			timeFromOffset(e, this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e) {
		timeFromOffset(e, this);
	});

	$(document).mouseup(function() {
		mouseDown = false;
	});
*/



	});


	function timeFromOffset(mouse, progressBar){
		

		var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage / 100);
	audioElement.setTime(seconds);
	}
	 

	function nextSong(){
		if (currentIndex == currentPlaylist.length - 1) {
			

			currentIndex=0;
		}
		else {

			currentIndex++;
		}
	
		var trackToPlay = currentPlaylist[currentIndex];
		setTrack(trackToPlay, currentPlaylist , true);
	}


	function setTrack(trackId, newPlaylist, play){
		$.post("includes/handlers/ajax/getSongJson.php",{songId: trackId},function(data){ 

			currentIndex = currentPlaylist.indexOf(trackId);
			console.log(data);
			var track = JSON.parse(data);
			$(".trackName span").text(track.title);


		$.post("includes/handlers/ajax/getArtistJson.php",{artistId: track.artist},function(data){	
				var artist = JSON.parse(data);
				$(".artistName span").text(artist.name);
				console.log(artist.name);
		});

		$.post("includes/handlers/ajax/getAlbumJson.php",{albumId: track.album},function(data){	
				var album = JSON.parse(data);
				$(".albumLink img").attr("src", album.artworkPath);
				
		});


			audioElement.setTrack(track);
			//audioElement.play();
			playSong();

		}); 
		if(play == true){ 
			audioElement.play();
		}
		
	}

	function playSong(){
		if (audioElement.audio.currentTime==0) {
			$.post("includes/handlers/ajax/updatePlays.php",{songId: audioElement.currentlyPlaying.id});
		}
		else
		{
			console.log("Don't update time ");
		}
		//console.log(audioElement );
		$(".controlButton.play").hide();
		$(".controlButton.pause").show();
		audioElement.play();

	}

	function pauseSong(){
		$(".controlButton.play").show();
		$(".controlButton.pause").hide();
		audioElement.pause();
	}

</script>


<div class="nowPlayingBarContainer">
			<div class="nowPlayingBar">
				<!-- album artwork -->
				<div id="nowPlayingLeft">
					<div class="content">
						<span class="albumLink">
							<img src="" class="albumArtwork" alt="Artwork">
						</span>

						<div class="trackInfo">
							<span class="trackName">
								<span></span>
							</span>

							<span class="artistName">
								<span></span>
							</span>

						</div>
					</div> 
				</div>
				<!-- album artwork end -->


				<!-- start of control buttons division -->
				<div id="nowPlayingCenter">
					<div class="content playerControls">

						<!-- Control Button -->
						<div class="buttons" >

							<button class="controlButton shuffle" title="Shuffle button">
								<img src="images/icons/shuffle.png" alt="Shuffle button">
							</button>

							<button class="controlButton previous" title="Previous button">
								<img src="images/icons/previous.png" alt="Previous button">
							</button>

							<button class="controlButton play" title="Play button" onclick="playSong()">
								<img src="images/icons/play.png" alt="Play button">
							</button>
							<button class="controlButton pause" title="Pause button" onclick="pauseSong()">
								<img src="images/icons/pause.png" alt="Pause button">
							</button>

							<button class="controlButton next" title="Next button">
								<img src="images/icons/next.png" alt="Next button">
							</button>

							<button class="controlButton repeat" title="Repeat button">
								<img src="images/icons/repeat.png" alt="Repeat button">
							</button>
						</div>


						<!-- Playback Progress bar -->
						<div class="playbackBar">
							<span class="progressTime current">0.00</span>
							<div class="progressBar">
								<div class="progressBarBg">
									<div class="progress"></div>			
								</div>
							</div>
							<span class="progressTime remaining">0.00</span>
						</div>
						<!-- End of Playback Bar -->





					</div>
				</div>
				<!-- end of now playing buttons & stuff -->

				<!-- Volume Buttons and stuff -->
				<div id="nowPlayingRight">
						<div class="volumeBar">
							<button class="controlButton volume" title="Volume button">
								<img src="images/icons/volume.png" alt="Volume button">
							</button>

							<div class="progressBar">
								<div class="progressBarBg">
									<div class="progress"></div>			
								</div>
							</div>
						</div>
				</div>
				
			</div>
		</div>