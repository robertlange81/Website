  
    			<div id="language" class="android_lang_home">
    									<script type="text/javascript" >
    										a = document.cookie;
											langCook = a.substring(a.indexOf("lang")+5,a.indexOf("lang")+7);
											if( (langCook != null && langCook == "en") /* || (lang != null && lang == "en")*/ ){								
											var deButton = "<a onclick='de()'><img id='deu' src='images/german.jpg' alt='deutsch' width='45' height='25' title='deutsch' class='not_chosen' /></a>";
											var enButton = "<a onclick='en()'><img id='eng' src='images/unionJack.jpg' alt='english' width='45' height='25' title='english' class='chosen' /></a>";
											} else {
											var deButton = "<a onclick='de()'><img id='deu' src='images/german.jpg' alt='deutsch' width='45' height='25' title='deutsch' class='chosen' /></a>";
											var enButton = "<a onclick='en()'><img id='eng' src='images/unionJack.jpg' alt='english' width='45' height='25' title='english' class='not_chosen' /></a>";
											}											
											document.write(deButton);
											document.write(enButton);
										</script>
    				<noscript>
    				  <?php
						if($lang == "de") {
    						printf("<a href='/index.php?theme=");print $theme;print("&amp;lang=de'><img src='images/german.jpg' alt='deutsch' width='45' height='25' title='deutsch' class='chosen' /></a>");
    						printf("<a href='/index.php?theme=");print $theme;print("&amp;lang=en'><img src='images/unionJack.jpg' alt='english' width='45' height='25' title='english' class='not_chosen' /></a>");
    					
    					} else {
							printf("<a href='/index.php?theme=");print $theme;print("&amp;lang=de'><img src='images/german.jpg' alt='deutsch' width='45' height='25' title='deutsch' class='not_chosen' /></a>");
    						printf("<a href='/index.php?theme=");print $theme;print("&amp;lang=en'><img src='images/unionJack.jpg' alt='english' width='45' height='25' title='english' class='chosen' /></a>");
    					}
            	  ?>
            	</noscript>
            </div>
            
            <div id="font_size">
             <label style="font-size:65%; color:whitesmoke; vertical-align:baseline;cursor:pointer;" title="minimize font size" onclick="klein()">A</label>
             <label style="font-size:105%; color:whitesmoke; vertical-align:baseline;cursor:pointer;" title="normal font size" onclick="normal()">A</label>
             <label style="font-size:150%; color:whitesmoke; vertical-align:baseline;cursor:pointer;" title="maximize font size" onclick="gross()">A</label>
    			</div>  