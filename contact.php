<?php
$title = 'Bryan Hernandez';
$currentPage = 'contact';
include('./head.php');
include('./navbar.php');
echo('<hr />');
	if (isset($_POST['contact']))
	{
		exec('beep && echo "'. $_SERVER['REMOTE_ADDR'] . ' wants your attention" >> /home/bryan/contacts.txt');
	}
?>
<html>
<body>
    <form method="post" action="?submit=true">
    <p>
        <button name="contact" <?php echo isset($_POST['contact']) ? 'disabled="true"' : ''; ?> >Notify Me</button>
    </p>
    </form>
</body>
<?php
include('./footer.php');
?>
