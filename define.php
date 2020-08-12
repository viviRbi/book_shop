<?php
	
	// ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'public' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	define ('APPLICATION_PATH'	, ROOT_PATH . DS . 'application' . DS);		// Định nghĩa đường dẫn đến thư mục application							
	define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục module							
	define ('BLOCK_PATH'		, APPLICATION_PATH . 'block' . DS);
	define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);	

	define	('ROOT_URL'			, DS . 'book_shop' . DS);
	define	('APPLICATION_URL'	, ROOT_URL . 'application' . DS);
	define	('PUBLIC_URL'		, ROOT_URL . 'public' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
	define ('LIBRARY_URL'		,ROOT_URL . 'libs' . DS);

	// ====================== SINGLE NAME ===========================
	define	('ADMIN_MODULE'			, 'admin');
	define	('VIEW'					, 'views');
	
	define	('DEFAULT_MODULE'		, 'default');
	define	('DEFAULT_CONTROLLER'	, 'index');
	define	('DEFAULT_ACTION'		, 'index');

	define	('PUBLIC_SCRIPT'		, 'scripts'. DS);
	define	('PUBLIC_FILE'			, 'files' . DS);
	define  ('PUBLIC_IMG'			,	PUBLIC_URL . 'files/images');

	// ============define	('DEFAULT_ACTION'		, 'index');========== DATABASE ===========================
	define ('DB_HOST'			, '103.68.68.143');
	define ('DB_USER'			, 'hailan_zdemo');						
	define ('DB_PASS'			, 'VclSCG[jT7g5');						
	define ('DB_NAME'			, 'hailan_zdemo');								

	// ====================== DATABASE TABLE===========================
	define ('TBL_GROUP'			, 'group');
	define ('TBL_BOOK'			, 'book');
	define ('TBL_CART'			, 'cart');
	define ('TBL_USER'			, 'user');

