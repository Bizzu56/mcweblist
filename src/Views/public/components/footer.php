<footer>
  <div class="footer-content">
    <h3>MCWebList</h3>
    <p>&copy; 2024 MCWebList. Tous droits réservés.</p>
    <div class="audio-player">
      <audio id="audioPlayer" src="./assets/song/Minecraft.mp3"></audio>
      <button id="playPause">play</button>
    </div>
  </div>
</footer>

<script>
  document.getElementById('playPause').addEventListener('click', function() {
    var audioPlayer = document.getElementById('audioPlayer');
    if (audioPlayer.paused) {
      audioPlayer.play();
      this.textContent = 'stop';
    } else {
      audioPlayer.pause();
      this.textContent = 'play';
    }
  });
</script>
