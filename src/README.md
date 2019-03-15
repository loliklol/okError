# okError
Инструкция по запуску 
1) Клонируем репозиторий.
2) docker build -t okerror .
3) docker run --name okerror -d -p 24000:80 okerror                                                                                           --name имя контейнера
    -d запуск в фоне
    -p 24000:80  проброс 80 порта контейнера на 24000 хоста

тестим с хоста curl localhost:24000/ok,curl localhost:24000/error итоговый вывод curl localhost:24000,

Проверка работы скрипта: docker exec okerror php script.php logs/app.log
