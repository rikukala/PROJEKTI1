<script>
$(document).ready(function() {
    $( document ).ready(function() {
        $('input[title]').qtip({
            show: {
                event: "mouseenter focusin"
            },
            hide: {
                event: "mouseleave focusout"
            },
            position: {
                my: "bottom center",
                at: "top center"
            }
        });
    });
});
</script>

<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('Author');
    echo $this->Form->input('username', array('label' => __('Käyttäjänimi', true), 'autofocus' => 'autofocus'));
	
	echo ("<br><br>");
	
    echo $this->Form->input('pw', array('type'=>'password', 'label' => __('Salasana', true)));
	echo $this->Form->input('passwordRetyped', array('type'=>'password', 'label' => __('Vahvista salasana', true), 'after'=> '<span class="afterInput">' . __('Kirjoitusvirheiden ehkäisemiseksi, syötä salasana molempiin kenttiin.', true) . '</span>'));
	
	echo ("<br><br>");
	
	echo $this->Form->input('email', array('label' => __('Sähköposti', true)));
	
	echo ("<br><br>");
?>

<div class="input text">
    <label for="secter"><?php __('Tunniste'); ?></label>
    <input type="text" name="data[secret]" id="secret" 
        title="<?php __('Tunnisteen saat sivuston ylläpitäjältä'); ?>"/>
    <?php if (!empty($secretWrong)): ?>
        <div class="error-message">
            <?php __('Tunniste ei täsmännyt. Saat tunnisteen sivuston ylläpitäjältä.'); ?>
        </div>
    <?php endif; ?>
</div>

<button type="submit"><?php __('Rekisteröidy'); ?></button>
<?php echo $this->Form->end(); ?>