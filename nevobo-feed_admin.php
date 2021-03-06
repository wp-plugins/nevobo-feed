<?php  
    if($_POST['nevobofeed_hidden'] == 'Y') {  
        //stuur Vereniging
        $nevobofeed_vereniging = $_POST['nevobofeed_vereniging'];
        update_option('nevobofeed_vereniging', $nevobofeed_vereniging);
        //Highlight Color
        $nevobofeed_highlight_color = $_POST['nevobofeed_highlight_color'];
        update_option('nevobofeed_highlight_color', $nevobofeed_highlight_color);
        //Maximale Naamlengte programma
        $nevobofeed_naamlengte_prog = $_POST['nevobofeed_naamlengte_prog'];
        update_option('nevobofeed_naamlengte_prog', $nevobofeed_naamlengte_prog);
        //Maximale Naamlengte uislagen
        $nevobofeed_naamlengte_uitslag = $_POST['nevobofeed_naamlengte_uitslag'];
        update_option('nevobofeed_naamlengte_uitslag', $nevobofeed_naamlengte_uitslag); 
        //Maximale Naamlengte Stand
        $nevobofeed_naamlengte_stand = $_POST['nevobofeed_naamlengte_stand'];
        update_option('nevobofeed_naamlengte_stand', $nevobofeed_naamlengte_stand);
        //image set
        $nevobofeed_image_set = $_POST['nevobofeed_image_set'];
        update_option('nevobofeed_image_set', $nevobofeed_image_set);
        //stuur cache
        $nevobofeed_cache = $_POST['nevobofeed_cache'];
        update_option('nevobofeed_cache', $nevobofeed_cache);
        //stuur Plaats
        $nevobofeed_plaats = $_POST['nevobofeed_plaats'];
        update_option('nevobofeed_plaats', $nevobofeed_plaats);
        //stuur sporthal
        $nevobofeed_sporthal = $_POST['nevobofeed_sporthal'];
        update_option('nevobofeed_sporthal', $nevobofeed_sporthal);
        //stuur aantal bij standen
        $nevobofeed_standen_aantal = $_POST['nevobofeed_standen_aantal'];
        update_option('nevobofeed_standen_aantal', $nevobofeed_standen_aantal);
        //stuur aantal bij uitslagen
        $nevobofeed_uitslagen_aantal = $_POST['nevobofeed_uitslagen_aantal'];
        update_option('nevobofeed_uitslagen_aantal', $nevobofeed_uitslagen_aantal);
        //stuur aantal bij programma
        $nevobofeed_programma_aantal = $_POST['nevobofeed_programma_aantal'];
        update_option('nevobofeed_programma_aantal', $nevobofeed_programma_aantal);
        //stuur ical
        $nevobofeed_ical = $_POST['nevobofeed_ical'];
        update_option('nevobofeed_ical', $nevobofeed_ical);
        //stuur Sets
        $nevobofeed_sets = $_POST['nevobofeed_sets'];
        update_option('nevobofeed_sets', $nevobofeed_sets);
         ?>  
        <div class="updated"><p><strong><?php _e('Wijzigingen zijn opgeslagen' ); ?></strong></p></div>  
        <?php  
    } else {  
        //Normal page display  
        $nevobofeed_vereniging = get_option('nevobofeed_vereniging'); 
        $nevobofeed_highlight_color = get_option('nevobofeed_highlight_color');
        $nevobofeed_image_set = get_option('nevobofeed_image_set');
        $nevobofeed_cache = get_option('nevobofeed_cache');
        $nevobofeed_plaats = get_option('nevobofeed_plaats');
        $nevobofeed_sporthal = get_option('nevobofeed_sporthal');
        $nevobofeed_standen_aantal = get_option('nevobofeed_standen_aantal');
        $nevobofeed_uitslagen_aantal = get_option('nevobofeed_uitslagen_aantal');
        $nevobofeed_programma_aantal = get_option('nevobofeed_programma_aantal');
        $nevobofeed_ical = get_option('nevobofeed_ical');
        $nevobofeed_sets = get_option('nevobofeed_sets');
        $nevobofeed_naamlengte_prog = get_option('nevobofeed_naamlengte_prog');
        $nevobofeed_naamlengte_uitslag = get_option('nevobofeed_naamlengte_uitslag');
        $nevobofeed_naamlengte_stand = get_option('nevobofeed_naamlengte_stand');
    } 
?>
<style type="text/css">

label
{
  width:30%;
  text-align:left;
  float:left;
  font-weight:bold;
}

.input
{
  width:30%;
  text-align:left;
  float:inherit;
  font-weight:bold;
}

  
</style>

<div>  
    <h1>Nevobo-feed Plugin Instellingen</h1>
    <form name="nevobofeed_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="nevobofeed_hidden" value="Y">
        De onderstaande instellingen kunnen per feed worden overschreven door parameters toe te voegen aan de shortcode.  
      <h2>Algemene instellingen</h2>
      <hr />
      <table width="800px" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%"><div class="label">Vereniging</div></td>
            <td width="30%"><input type="text" name="nevobofeed_vereniging" value="<?php echo $nevobofeed_vereniging; ?>" size="20" /></td>
            <td width="41%">(gedeeltelijke) naam van een vereniging om extra te onderscheiden. voorbeeld: Krekkers<br /><br /></td>
        </tr>
          <tr>
            <td width="29%"><div class="label">Highlight Kleur</div></td>
            <td width="30%"><input type="text" name="nevobofeed_highlight_color" value="<?php echo $nevobofeed_highlight_color; ?>" /></td>
            <td width="41%">Geef de highlight kleur op voor de gespecificeerde verenigingsnaam. Bijvoorbeeld #FF0000<br /><br /></td>
          </tr>
          <tr>
            <td width="29%"><div class="label">Afbeelindgen set</div></td>
              <td>
               <select name="nevobofeed_image_set" id="nevobofeed_image_set">
                <option value="grijs" <?php if ($nevobofeed_image_set=="grijs") echo "selected" ?>>Grijs</option>
                <option value="geel" <?php if ($nevobofeed_image_set=="geel") echo "selected" ?>>Geel</option>
                <option value="rood" <?php if ($nevobofeed_image_set=="rood") echo "selected" ?>>Rood</option>
                <option value="lichtblauw" <?php if ($nevobofeed_image_set=="lichtblauw") echo "selected" ?>>Licht Blauw</option>
              </select>
             </td>
            <td width="41%">Kies een afbeeldingen set voor Ical/Sets en Loc<br /><br /></td>
          </tr>
          <tr>
            <td>Cache</td>
            <td><select name="nevobofeed_cache" id="nevobofeed_cache">
              <option value="0" <?php if ($nevobofeed_cache=="0") echo "selected" ?>>Uitgeschakeld</option>
              <option value="15" <?php if ($nevobofeed_cache=="15") echo "selected" ?>>15 minuten</option>
              <option value="30" <?php if ($nevobofeed_cache=="30") echo "selected" ?>>30 minuten</option>
              <option value="45" <?php if ($nevobofeed_cache=="45") echo "selected" ?>>45 minuten</option>
              <option value="60" <?php if ($nevobofeed_cache=="60") echo "selected" ?>>1 uur</option>
              <option value="120" <?php if ($nevobofeed_cache=="120") echo "selected" ?>>2 uur</option>
              <option value="180" <?php if ($nevobofeed_cache=="180") echo "selected" ?>>3 uur</option>
              <option value="300" <?php if ($nevobofeed_cache=="300") echo "selected" ?>>5 uur</option>
            </select></td>
            <td>Cache tijd - Standaard:3 uur<br /><br /></td>
          </tr>
        </table>
      <h2>Stand instellingen</h2> 
    <hr />
        <table width="800px" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%"><div class="label">Maximale verenigingsnaam breedte in pixels (zonder px)</div></td>
            <td width="30%"><input type="text" name="nevobofeed_naamlengte_stand" value="<?php echo $nevobofeed_naamlengte_stand; ?>" /></td>
            <td width="41%">Geef de maximale vereniging naamlengte op in px. De afgekapte naam zal herkenbaar zijn door de ...<br /><br /></td>
          </tr>
          <tr>
            <td width="29%"><div class="label">Aantal regels</div></td>
            <td width="30%"><input type="text" name="nevobofeed_standen_aantal" value="<?php echo $nevobofeed_standen_aantal; ?>" size="2" /></td>
            <td width="41%">Aantal regels in het standoverzicht. standaard: 12<br /><br /></td>
          </tr>
        </table>
      <h2>Programma instellingen</h2>
      <hr />
      <table width="800px" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="29%"><div class="label">Maximale verenigingsnaam breedte in pixels (zonder px)</div></td>
            <td width="30%"><input type="text" name="nevobofeed_naamlengte_prog" value="<?php echo $nevobofeed_naamlengte_prog; ?>" /></td>
            <td width="41%">Geef de maximale vereniging naamlengte op in px. De afgekapte naam zal herkenbaar zijn door de ...<br /><br /></td>
          </tr>
        <tr>
          <td width="29%"><div class="label">Aantal regels</div></td>
          <td width="30%"><input type="text" name="nevobofeed_programma_aantal" value="<?php echo $nevobofeed_programma_aantal; ?>" size="2" /></td>
          <td width="41%">Aantal regels in het programmaoverzicht. standaard: 6<br /><br /></td>
        </tr>
        <tr>
        <td width="29%"><div class="label">
          <div class="label">Sporthal</div>
        </div></td>
        <td width="30%"><select name="nevobofeed_sporthal" id="nevobofeed_sporthal">
          <option value="1" <?php if ($nevobofeed_sporthal=="1") echo "selected" ?>>Tonen</option>
          <option value="" <?php if ($nevobofeed_sporthal=="") echo "selected" ?>>verbergen</option>
        </select></td>
        <td width="41%">Toon de Sporthalnaam.<br /><br /></td>
      </tr>
      <tr>
        <td width="29%"><div class="label">
          <div class="label">Plaats</div>
        </div></td>
        <td width="30%"><select name="nevobofeed_plaats" id="nevobofeed_plaats">
          <option value="1" <?php if ($nevobofeed_plaats=="1") echo "selected" ?>>Tonen</option>
          <option value="" <?php if ($nevobofeed_plaats=="") echo "selected" ?>>verbergen</option>
        </select></td>
        <td width="41%">Toon de plaats.</td>
      </tr>
      <tr>
        <td width="29%"><div class="label">
          <div class="label">iCal Link</div>
        </div></td>
        <td width="30%"><select name="nevobofeed_ical" id="nevobofeed_ical">
          <option value="1" <?php if ($nevobofeed_ical=="1") echo "selected" ?>>Tonen</option>
          <option value="" <?php if ($nevobofeed_ical=="") echo "selected" ?>>verbergen</option>
        </select></td>
        <td width="41%">Toon de iCal link onder het programma<br /><br /></td>
      </tr>
      </table>
      <h2>Uitslagen instellingen</h2>
    <hr />
    <table width="800px" border="0" cellspacing="0" cellpadding="0">
      <tr>
            <td width="29%"><div class="label">Maximale verenigingsnaam breedte in pixels (zonder px)</div></td>
            <td width="30%"><input type="text" name="nevobofeed_naamlengte_uitslag" value="<?php echo $nevobofeed_naamlengte_uitslag; ?>" /></td>
            <td width="41%">Geef de maximale vereniging naamlengte op in px. De afgekapte naam zal herkenbaar zijn door de ...<br /><br /></td>
          </tr>
      <tr>
        <td><span class="label">Aantal regels</span></td>
        <td><input type="text" name="nevobofeed_uitslagen_aantal" value="<?php echo $nevobofeed_uitslagen_aantal; ?>" size="2" /></td>
        <td>Aantal regels in het uitslagenoverzicht. standaard: 6<br /><br /></td>
      </tr>
      <tr>
        <td width="29%"><div class="label">
          <div class="label">Setsstanden (mouse-over)</div>
        </div></td>
        <td width="30%"><select name="nevobofeed_sets" id="nevobofeed_sets">
          <option value="1" <?php if ($nevobofeed_sets=="1") echo "selected" ?>>Tonen</option>
          <option value="" <?php if ($nevobofeed_sets=="") echo "selected" ?>>verbergen</option>
        </select></td>
        <td width="41%">Toon de setstanden pictogram met de setstanden.<br /><br /></td>
      </tr>
    </table>
    <p class="submit">  
<input type="submit" name="Submit" value="<?php _e('Instellingen Opslaan', 'nevobofeed_dom' ) ?>" />  
</p>  
  </form> 
  </p>  
<p style="text-align: left;">Het onderhouden van de plugin kost veel tijd.<br /> Koop een biertje of een kopje koffie voor me!<br />
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SC7YX4S3PA79W">
<input type="image" src="https://www.paypalobjects.com/nl_NL/NL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, de veilige en complete manier van online betalen.">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form>
</div> 
