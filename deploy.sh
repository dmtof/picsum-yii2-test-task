#!/bin/bash

export $(grep -v '^#' .env | xargs)

docker compose up -d --build

echo "deploy.sh завершил работу (http://localhost)"