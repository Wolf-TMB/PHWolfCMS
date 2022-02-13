<?php

return array(
	'RENDER_DIR' => 'views', # Директория шаблонизатора
	'RENDER_DEFAULT_DIR' => 'web', # Основная директория шаблонов
	'RENDER_EMAIL_TEMPLATES_DIR' => 'email', # Шаблоны почтовых писем
	'RENDER_BLOCKS_DIR' => 'blocks', # Директория блоков, в данном случае /views/web/blocks/, в общем случае /views/%DIR%/blocks/
	'RENDER_LAYOUTS_DIR' => 'layouts', # Директория слоёв, в данном случае /views/web/layouts/, в общем случае /views/%DIR%/layouts/
	'RENDER_TEMPLATES_DIR' => 'templates', # Директория шаблонов, в данном случае /views/web/templates/, в общем случае /views/%DIR%/templates/
	'RENDER_MAX_ITERATION' => '25', # Максимальная вложенность при рендере шаблона, для прерывания бесконенчых петель
);
