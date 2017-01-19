
					<h2 class="textglow" id='teaser'>
					<noscript>
					<?php
					
						$teaser = mysql_query("select * from `content` where `theme` = '$theme' and `lang` = '$lang'");
						if(mysql_num_rows($teaser) >=1) {
							while($aktZeile = mysql_fetch_assoc($teaser)){
								echo $aktZeile['headline'];
							}
						} 
					?>
					</noscript>	
								<span id="android">
									 <i>  <? if(!empty($_GET['theme'])){ 
									 				print "{$_GET['theme']} ";
									 			} else {
									 				printf("Home");
									 			} 
									 		?>
									 
									 </i> 
								</span>		
						</h2>			
				</header>