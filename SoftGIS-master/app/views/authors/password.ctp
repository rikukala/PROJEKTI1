<!-- Käyttäjähallinta - listaa kaikki käyttäjät -->
 
<?php
	echo $this->element('authors_menu');
?>


<?php
	echo $this->Session->flash('auth');
    echo $this->Form->create('Author');
	echo ("<label class=\"labelfix\">" . __('Muokkaa käyttäjän', true) . " " . $user['Author']['username'] . " " . __('salasanaa', true) . "</label>");
    echo $this->Form->input('password', array('label' => false, 'title' => __('Älä tallenna muokkaamatonta salasanaa!', true)));
?>

<!-- Tallenna muutokset -->
<button type="submit"><?php __('Tallenna muutokset'); ?></button>

<!-- Hylkää muutokset -->
<?php
	echo $this->Html->link(
		__('Peruuta', true),
		array('controller' => 'authors', 'action' => "view"),
		array('class' => 'button cancel')
	);
?>
<?php echo $this->Form->end(); ?>
