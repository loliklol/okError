# okError
Инструкция по запуску

Клонируем репозиторий.
для старта выполняем  docker build -t okerror .

запускаем: docker run --name okerror -d -p 24000:80 okerror

тестим с хоста curl localhost:24000/ok,curl localhost:24000/error итоговый вывод curl localhost:24000,

Проверка работы скрипта: docker exec okerror php script.php logs/app.log
