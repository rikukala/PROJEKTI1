<?php echo $this->Html->script('json2'); ?>
<?php echo $this->Html->script('spine'); ?>
<?php echo $this->Html->script('controllers/map'); ?>
<?php echo $this->Html->script('models/poll'); ?>
<?php echo $this->Html->script('models/question'); ?>
<!--  Gettext -->
<?php echo $this->Html->script('Gettext'); ?>
<?php $locale = Configure::read('Config.language'); ?>
<link rel="gettext" type="application/x-po" href="<?php echo ($this->webroot . 'js/locale/' . $locale . '/LC_MESSAGES/js-default.po'); ?>"/>
<!-- /Gettext -->
<?php echo $this->Html->script('answerApp'); ?>

<script>
var markerIconPath = "<?php echo $this->Html->url('/markericons/'); ?>";
var overlayPath = "<?php echo $this->Html->url('/overlayimages/'); ?>";
var publicAnswersPath = "<?php echo $this->Html->url('/answers/publicanswers.json'); ?>";
var publicAnswerIcon = "<?php echo $this->Html->url('/img/public_answer.png'); ?>";
var answerIcon = "<?php echo $this->Html->url('/img/answer.png'); ?>";


var answerApp;
$( document ).ready(function() {
    var data = <?php echo json_encode($poll); ?>;

    $.template("questionTmpl", $("#questionTmpl"));
    $.template("welcomeTmpl", $("#welcomeTmpl"));
    $.template("publicAnswerTmpl", $("#publicAnswerTmpl"));

    answerApp = AnswerApp.init({
        el: $("body"),
        data: data,
    });  

    // Help toggle
    $( ".help" ).hide();
    $( "#toggleHelp" ).click(function() {
        $( ".help" ).fadeToggle(400, "swing", function() {
            $( "#map" ).qtip("reposition");
            $( ".answer-field" ).qtip("reposition");
        });
        return false;
    });
    $("#noMap").toggle(function(){
            answerApp.map.setPoi(0);
        },function(){
            answerApp.map.setPoi(1);
        });
});
</script>

<div class="answerMenu">
    <?php echo $this->Html->link(
        __('Apua', true),
        '#help',
        array('class' => 'button', 'id' => 'toggleHelp')
    ); ?>
</div>

<div class="help">
    <h2><?php __('Vastausohjeet'); ?></h2>
    <p><?php __('Kyselyyn vastataan joko tekstikenttään tai monivalintaan, sekä mahdolliseen karttavastaukseen.'); ?></p>
    <p><?php __('Monivalinnassa valitse vaihtoehdoista mielestäsi asiaa parhaiten kuvaava vaihtoehto.'); ?></p>
	<p><?php __('Voit myös kirjoittaa oman vaihtoehtosi "Joku, muu mikä?" -tekstikentän sisälle, mikäli kyselyn laatija on sellaisen laittanut.'); ?></p>
    <p><?php __('Joidenkin kysymysten yhteydessä kartalla voi näkyä kysymykseen liittyviä karttamerkkejä, viivoja, alueita sekä karttakuvia.'); ?></p>
    <h2><?php __('Karttaan vastaaminen'); ?></h2>
    <p><?php __('Karttaa voi liikuttaa hiirellä vetämällä ja zoomata hiiren rullalla, mutta oletusarvoisesti se on kyselyn laatijan määräämässä sijannissa.'); ?></p>
    <p><?php __('Kysymyksestä riippuen, karttaan joko ei voi vastata, siihen voi laittaa merkin, useita merkkejä, viivan tai alueen. Nämät kaikki asetetaan klikkaamalla karttaan hiiren ensimmäisellä painikkeella. Kartalla olevaa pistettä voi vetää hiirellä paikasta toiseen ja toisella hiiren painikkeella poistaa. Viivoissa ja alueissa kulmapisteiden välissä olevista pallukoista vetämällä voi luoda uuden kulmapisteen.'); ?></p>
</div>

<script id="welcomeTmpl" type="text/x-jquery-tmpl">
    <h3>
        ${name}
    </h3>
    <div class="welcomeText">
        ${welcome_text}
    </div>
    <div class="answerNav">
        <button type="button" class="start">
            <?php __('Aloita kysely'); ?>
        </button>
    </div>
</script>

<script id="questionTmpl" type="text/x-jquery-tmpl">
    <div class="answerNav">
        <table class="answer"><tr>
            <td><button type="button" class="prevQues" id = "prev"><?php __('edellinen'); ?></button></td>
            <td><div class="info" id="info"><?php __('Kysymys numero'); ?> #</div></td>
            <td><button type="button" class="nextQues"><?php __('seuraava'); ?></button></td>
        </tr></table>
    </div>
    <h3>${text}</h3>
    <div class="answer-field">
        <div class="input">
            {{if type == 1}}
                <textarea name="text" id="texta"></textarea>
            {{else type == 2}}
                <input type="radio" name="text" class="joo"  id="1" value="Kyllä"/><?php __('Kyllä'); ?>
                <input type="radio" name="text" id="2" value="Ei"/><?php __('Ei'); ?>
                <input type="radio" name="text" id="Eos" value="En osaa sanoa"/><?php __('En osaa sanoa'); ?>
            {{else type == 3}}
                ${low_text}
                <input type="radio" name="text" class="1" id="1" value="1"/>
                <input type="radio" name="text" id="2" value="2"/>
                <input type="radio" name="text" id="3" value="3"/>
                <input type="radio" name="text" id="4" value="4"/>
                <input type="radio" name="text" id="5" value="5"/>
                ${high_text}
				<br/>
                <input type="radio" name="text" id="Eos" value="En osaa sanoa"/><?php __('En osaa sanoa'); ?>
            {{else type == 4}}
                ${low_text}
                <input type="radio" name="text" class="1"  id="1" value="1"/>
                <input type="radio" name="text" id="2" value="2"/>
                <input type="radio" name="text" id="3" value="3"/>
                <input type="radio" name="text" id="4" value="4"/>
                <input type="radio" name="text" id="5" value="5"/>
                <input type="radio" name="text" id="6" value="6"/>
                <input type="radio" name="text" id="7" value="7"/>
                ${high_text}
				<br/>
                <input type="radio" name="text" id="Eos" value="En osaa sanoa"/><?php __('En osaa sanoa'); ?>
				<!-- Tämä valitaan jos kysely on monivalinta-->
			{{else type == 5}}
				{{if choice1 != null}}
					${choice1}
					<input type="checkbox" name="text" value="${choice1}"/>
				{{/if}}
				{{if choice2 != null}}
					${choice2}
					<input type="checkbox" name="text" value="${choice2}"/>
				{{/if}}
				{{if choice3 != null}}
					${choice3}
					<input type="checkbox" name="text" value="${choice3}"/>
				{{/if}}
				{{if choice4 != null}}
					${choice4}
					<input type="checkbox" name="text" value="${choice4}"/>
				{{/if}}
				{{if choice5 != null}}
					${choice5}
					<input type="checkbox" name="text" value="${choice5}"/>
				{{/if}}
				{{if choice6 != null}}
					${choice6}
					<input type="checkbox" name="text" value="${choice6}"/>
				{{/if}}
				{{if choice7 != null}}
					${choice7}
					<input type="checkbox" name="text" value="${choice7}"/>
				{{/if}}
				{{if choice8 != null}}
					${choice8}
					<input type="checkbox" name="text" value="${choice8}"/>
				{{/if}}
				{{if otherchoice != 0}}
					Joku muu, mikä?
					<input type="text" class="small" name="other" value=""/>
				{{/if}}
			<!-- Loppuu tähän-->
            {{/if}}
        </div>
    </div>
</script>

<script id="publicAnswerTmpl" type="text/x-jquery-tmpl">
    <div class="publicAnswer">
        ${answer}
    </div>
</script>

<div id="question" class="answer"></div>
<div class="answer">
    <div id="noAnswerCont">
        <input type="checkbox" id="noAnswer" />
        <label><?php __('En halua vastata kartalle'); ?></label>
		 <br/><br/>
		 <a id="noMap" class="button"><?php __('Piilota / näytä POI-kohteet'); ?></a>
    </div>
		<br/>
        <br/>
		<br/>
		<br/>
		<br/>
        <p class="map_note" id="map_note"><?php __('Ohjeteksti'); ?></p>
        <div id="map" class="map">
    </div>
</div>
<form method="POST" 
    action="<?php echo $this->Html->url(array('action' => 'finish')); ?>" 
    id="postForm">
    <input type="hidden" id="dataField" name="data"/>
</form>

<div id="publicAnswers" class="publicAnswers">
    <h3><?php __('Aiemmat vastaukset'); ?></h3>
    <div class="answers">
    </div>
</div>
