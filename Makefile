don:
	@sed -i '/SAIL_XDEBUG_MODE/s/\=.*/=develop,debug/' .env
	@./vendor/bin/sail up -d laravel.test

doff:
	@sed -i '/SAIL_XDEBUG_MODE/s/\=.*/=develop/' .env
	@./vendor/bin/sail up -d laravel.test

up:
	@./vendor/bin/sail up -d

stop:
	@./vendor/bin/sail stop
