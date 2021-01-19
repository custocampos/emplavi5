<?php
// Sessão
session_start();
if(isset($_SESSION['mensagem'])){ ?>	

<script>
	// Mensagem
	window.onload = function() {
		  M.toast({html: '<?php echo $_SESSION['mensagem']; ?>', classes: 'red darken-1 rounded'});
	};
</script>

<?php
session_unset();
};

?>

<?php
if(isset($_SESSION['mensagem2'])){ ?>	

<script>
	// Mensagem
	window.onload = function() {
		  M.toast({html: '<?php echo $_SESSION['mensagem2']; ?>', classes: 'teal darken-1 rounded'});
	};
</script>

<?php
session_unset();
};


?>