<div style=" margin-bottom: -25px;margin-top: 20px;" class="alert alert-success fade in col-lg-12" onclick="this.classList.add('hidden')" id="success-msg-ele">
  <?= h($message) ?>
</div>

<script>
	setTimeout(function(){
		// $("#success-msg-ele").hide('slow');
	},3000)
</script>

