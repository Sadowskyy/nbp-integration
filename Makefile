up:
	docker compose up -d
build:
	docker compose build
down:
	docker compose down --remove-orphans
stop:
	docker compose stop
test:
	bin/phpunit