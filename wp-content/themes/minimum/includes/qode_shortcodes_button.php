<div id="qode_shortcode_form_wrapper">
<form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
  <div class="input">
		<label>Size</label>
		<select name="size" id="size">
			<option value=""></option>
			<option value="tiny">Tiny</option>
			<option value="small">Small</option>
			<option value="medium">Medium</option>
			<option value="large">Large</option>
		</select>
  </div>
  <div class="input">
    <label>Text</label>
		<input name="text" id="text" value="" />
  </div>
  <div class="input">
    <label>Link</label>
		<input name="link" id="link" value="" />
  </div>
  <div class="input">
    <label>Target</label>
      <select name="target" id="target">
          <option value=""></option>
          <option value="_blank">Blank</option>
		  <option value="_self">Self</option>
		  <option value="_parent">Parent</option>
		  <option value="_top">Top</option>
      </select>
  </div>
  <div class="input">
    <label>Color</label>
		<input name="color" id="color" value="" maxlength="10" size="10" />
  </div>
	<div class="input">
    <label>Background Color</label>
		<input name="background_color" id="background_color" value="" maxlength="10" size="10" />
  </div>
  <div class="input">
    <label>Font style</label>
		<select name="font_style" id="font_style">
				<option value=""></option>
				<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		</select>
  </div>
  <div class="input">
    <label>Font Size</label>
		<input name="font_size" id="font_size" value="" maxlength="10" size="10" />
  </div>
  <div class="input">
    <label>Line height</label>
		<input name="line_height" id="line_height" value="" maxlength="10" size="10" />
  </div>
	<div class="input">
    <label>Font weight</label>
      <select name="font_weight" id="font_weight">
				<option value=""></option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
      </select>
  </div>
  <div class="input">
      <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
  </div>
 
</form>
</div>
<script type="text/javascript">
	colorPicker();
</script>