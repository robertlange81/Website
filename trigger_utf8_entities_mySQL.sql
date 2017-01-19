CREATE TRIGGER 'trigger_create_post_entities' BEFORE INSERT ON 'wp_posts'
FOR EACH ROW
BEGIN
	SET NEW.post_content = 	replace( 
                replace( 
                    replace(
                        replace( 
                            replace( 
                                replace( 
                                    replace(New.post_content,
                                            'Ã¼','&uuml;'),
                                    		'Ã¤','&auml;'),
                                			'Ã¶','&ouml;'),
                            				'ÃŸ','&szlig;'),
                        					'Ãœ','&Uuml;'),
                    						'Ã„','&Auml;'),
                							'Ã–','&Ouml;');
END